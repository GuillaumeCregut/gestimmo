<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	modif_ville.php  								 *
 * Date création :	29/06/2018										 *
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
	//Connexion à la base de données
	$db= new connect_base($serveur,$database,$username,$password);
	//Gestion d'erreur de la connexion BDD
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
		die();
	}
	//on regarde si on a selectionné une ville
	if(isset($_POST['id_ville']))
	{
		//On récupère le nom de la ville
		$Id_Ville=intval($_POST['id_ville']);
		if($Id_Ville==0)
		{
			//Erreur on affiche et on quitte;
			$moteur->assign('Erreur','Erreur de selection de ville');
			$moteur->display($CheminTpl.'erreur_distance.tpl');
			die();
		}
		$SQLS=$SEL_VILLE_NAME."$Id_Ville";
		$query=$db->sql_query($SQLS);
		$row=$db->sql_fetchrow($query);
		$NomVille=$row['nom_ville'];
		$moteur->assign('VilleRef',$Id_Ville);
		$moteur->assign('NomVille',$NomVille);
		//On récupère les distances, sauf pour cette ville
		$SQLS=SEL_TABLEAU_VILLE($Id_Ville);
		$query=$db->sql_query($SQLS);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			if($row['fk_ville1']!=$Id_Ville)
			{
				$TabDist[$i]['Nom_Ville']=$row['nom_ville1'];
				$TabDist[$i]['Pk_Villes']=$row['fk_ville1'];
			}
			else
			{
				$TabDist[$i]['Nom_Ville']=$row['nomville2'];
				$TabDist[$i]['Pk_Villes']=$row['fk_ville2'];
			}
			$TabDist[$i]['id_ligne']=$row['id_ligne'];
			$TabDist[$i]['Distance']=$row['distance'];
			$i++;
		}
		if (isset($TabDist))
			$moteur->assign('TabVille',$TabDist);
		//Liste des villes existantes
		$SQLS=$SEL_VILLE;
		$query=$db->sql_query($SQLS);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			$TabData2[$i]['id_ville']=$row['pk_ville'];
			$TabData2[$i]['nom_ville']=$row['nom_ville'];
			$i++;
		}
		if(isset($TabData2))
			$moteur->assign('TabVilles',$TabData2);
		$moteur->display($CheminTpl.'modif_distance.tpl');
	}
	else
	{
		//On récupère la liste des villes
		$SQLS=$SEL_VILLE;
		$query=$db->sql_query($SQLS);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			$TabData2[$i]['id_ville']=$row['pk_ville'];
			$TabData2[$i]['nom_ville']=$row['nom_ville'];
			$i++;
		}
		if(isset($TabData2))
			$moteur->assign('TabVille',$TabData2);
		$moteur->display($CheminTpl.'modif_ville.tpl');
	}
?>