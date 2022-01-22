<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	index.php  										 *
 * Date création :	24/06/2018										 *
 * Date Modification :	24/06/2018									 *
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
	$Erreur=false;
	//On regarde si on a recu les infos 
	if(isset($_POST['prenom']))
	{
		$Prenom=$_POST['prenom'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['nom']))
	{
		$Nom=$_POST['nom'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['adresse']))
	{
		$Adresse=$_POST['adresse'];
	}
	else
	{
		$Adresse='non renseignée';
	}
	if(isset($_POST['tel']))
	{
		$Tel=$_POST['tel'];
	}
	else
	{
		$Tel=0;
	}
	if(isset($_POST['mail']))
	{
		$Mail=$_POST['mail'];
	}
	else
	{
		$Mail='non renseigné';
	}
	if(isset($_POST['TypeMaison']))
	{
		$Type_Bien=$_POST['TypeMaison'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['etat']))
	{
		$Etat_Bien=$_POST['etat'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['surf_min']))
	{
		$Surf_Min=$_POST['surf_min'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['surf_max']))
	{
		$Surf_Max=$_POST['surf_max'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['prix_min']))
	{
		$Prix_Min=$_POST['prix_min'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['prix_max']))
	{
		$Prix_Max=$_POST['prix_max'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['ville']))
	{
		$Ville=$_POST['ville'];
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['dist_max']))
	{
		$Dist_Max=$_POST['dist_max'];
	}
	else
	{
		$Erreur=true;
	}
	//Si les valeurs sont toutes OK
	if(!$Erreur)
	{
		$TabValeurs=array(':el'=>$Etat_Bien,':tb'=>$Type_Bien,':fv'=>$Ville,':tel'=>$Tel,':mail'=>$Mail,':nom'=>$Nom,':prenom'=>$Prenom,':p_min'=>$Prix_Min,':p_max'=>$Prix_Max,':s_min'=>$Surf_Min,':s_max'=>$Surf_Max,':ad'=>$Adresse,':dist'=>$Dist_Max);
		echo "<pre>";
		print_r($TabValeurs);
		echo "</pre>";
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		$Resultat=$db->ExecProc($TabValeurs,$ADD_ACHETEUR);
	}
	else
	{
		
	}
	$moteur->display($CheminTpl.'add_ach_sql.tpl');
?>