<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	rech_bien.php									 *
 * Date création :	05/07/2018										 *
 * Date Modification :	05/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/config.inc.php');
	include('include/sql.inc.php');
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
	//Récupération des villes
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
	//Récupération des types de biens
	$SQLS=$SEL_TYPE;
	$query=$db->sql_query($SQLS);
	$i=0;
	while($row=$db->sql_fetchrow($query))
	{
		$TabData1[$i]['id_bien']=$row['pk_bien'];
		$TabData1[$i]['nom_bien']=$row['nom_bien'];
		$i++;
	}
	if(isset($TabData1))
		$moteur->assign('TabBien',$TabData1);
	//Récupération des états
	$SQLS=$SEL_ETAT;
	$query=$db->sql_query($SQLS);
	$i=0;
	while($row=$db->sql_fetchrow($query))
	{
		$TabData[$i]['id_etat']=$row['id_etat'];
		$TabData[$i]['nom_etat']=$row['nom_etat'];
		$i++;
	}
	if(isset($TabData))
		$moteur->assign('TabEtat',$TabData);
	$moteur->display($CheminTpl.'rech_bien.tpl');
?>