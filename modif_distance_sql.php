<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	modif_distance_sql.php							 *
 * Date création :	30/06/2018										 *
 * Date Modification :	30/06/2018									 *
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
	$SQLS=$MOD_DISTANCES;
	if(isset($_POST['idligne']))
	{
		$TabDistance=$_POST['idligne'];
		if(is_array($TabDistance))
		{
			if(isset($_POST['NomVille']))
			{
				$NomDeVille=$_POST['NomVille'];
				$moteur->assign('NomVille',$NomDeVille);
			}
			//Connexion à la base de données
			$db= new connect_base($serveur,$database,$username,$password);
			//Gestion d'erreur de la connexion BDD
			if(is_null($db->connect_id))
			{
				$moteur->display($CheminTpl.'erreurbdd.tpl');
				die();
			}
			$CompteResulat=0;
			foreach($TabDistance as $key=>$value)
			{
				$tabModif[':a']=$key;
				$tabModif[':b']=$value;
				$Resultat=$db->ExecProc($tabModif,$SQLS);
				$CompteResulat+=$Resultat;
			}
			$moteur->assign('Nbre_Lignes',$CompteResulat);
			$moteur->display($CheminTpl.'modif_distance_sql.tpl');
		}
		else
		{
			//Il n'y a pas de tableau
			$moteur->assign('Erreur','Distances invalides');
			$moteur->display($CheminTpl.'erreur_distance.tpl');
			die();
		}
	}
	else
	{
		//Post invalide
		$moteur->assign('Erreur','Données invalides');
		$moteur->display($CheminTpl.'erreur_distance.tpl');
		die();
	}
?>