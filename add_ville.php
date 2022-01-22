<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_ville.php 									 *
 * Date création :	29/06/2018										 *
 * Date Modification :	03/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	$_SESSION['Gest_Immo_Ed98']['Add_ville']=true;
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
	}
	else
	{	
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
		$moteur->display($CheminTpl.'add_ville.tpl');
	}
	
?>