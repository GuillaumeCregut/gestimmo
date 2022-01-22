<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	sel_vendeur.php									 *
 * Date création :	03/07/2018										 *
 * Date Modification :	03/07/2018									 *
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
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
		die();
	}
	$SQLS=$SEL_VENDEUR;
	$query=$db->sql_query($SQLS);
	$i=0;
	while($row=$db->sql_fetchrow($query))
	{
		$TabVendeur[$i]['id_vendeur']=$row['pk_vendeur'];
		$NomVendeur=$row['prenom'].' '.$row['nom'];
		$TabVendeur[$i]['nom_vendeur']=$NomVendeur;
		$i++;
	}
	if(isset($TabVendeur))
		$moteur->assign('TabVendeur',$TabVendeur);
	$moteur->display($CheminTpl.'sel_vendeur.tpl');
?>