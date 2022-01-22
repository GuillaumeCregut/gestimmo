<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_distance.php 								 *
 * Date création :	30/06/2018										 *
 * Date Modification :	01/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/sql.inc.php');
	include('include/config.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	if(isset($_POST['ville']))
	{
		$TabVille=$_POST['ville'];
		if(isset($_POST['distance'])&&isset($_POST['Id_Ville']))
		{
			if(isset($_POST['NomVille']))
			{
				$NomDeVille=$_POST['NomVille'];
				$moteur->assign('NomVille',$NomDeVille);
			}
			$TabDistance=$_POST['distance'];
			$Ref_Ville=$_POST['Id_Ville'];
			//Connexion à la base de données
			$db= new connect_base($serveur,$database,$username,$password);
			//Gestion d'erreur de la connexion BDD
			if(is_null($db->connect_id))
			{
				$moteur->display($CheminTpl.'erreurbdd.tpl');
				die();
			}
			//$AddDistance="CALL P_Add_Distances(:vil1,:vil2,:dist)";
			$SQLS=$AddDistance;
			foreach($TabVille as $key=>$value)
			{
				$Voisine=intval($value);
				$LaDistance=intval($TabDistance[$key]);
				$CompteLigne=0;
				if(($Voisine!=0)&&($LaDistance!=0))
				{
					$Tab_Data=array(':vil1'=> $Ref_Ville,':vil2'=>$Voisine,':dist'=>$LaDistance);
					//echo "<p>Ville $Ref_Ville est distante de $LaDistance km de la ville $Voisine</p>";
					$resultat=$db->ExecProc($Tab_Data,$SQLS);
					$CompteLigne+=$resultat; //A remplacer par résultat.
				}
			}
			$moteur->assign('NbreLignes',$CompteLigne);
			$moteur->display($CheminTpl.'add_distance.tpl');
		}
		else
		{
			//Tableau des distances / villes absent
			$moteur->assign('Erreur','Distances invalides');
			$moteur->display($CheminTpl.'erreur_distance.tpl');
			die();
		}
	}
	else
	{
		//POST incohérent
		$moteur->assign('Erreur','Données invalides');
		$moteur->display($CheminTpl.'erreur_distance.tpl');
		die();
	}
?>