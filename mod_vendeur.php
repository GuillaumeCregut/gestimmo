<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mod_vendeur.php  								 *
 * Date création :	03/07/2018										 *
 * Date Modification :	08/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	$_SESSION['Gest_Immo_Ed98']['mod_vendeur']=true;
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/config.inc.php');
	include('include/sql.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	if(isset($_POST['id_vendeur']))
	{
		$idvendeur=intval($_POST['id_vendeur']);
		$tabid=array(':a'=>$idvendeur);
		//$SQLS=$SEL_VENDEUR_FULL="SELECT tel, mail, nom, prenom, adresse FROM vendeur WHERE pk_vendeur=:a";
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		$query=$db->sql_fetch_prepared($tabid,$SEL_VENDEUR_FULL);
		$row=$db->sql_fetchrow($query);
		if(isset($row['nom']))
		{
			$moteur->assign('nom',$row['nom']);
			$moteur->assign('prenom',$row['prenom']);
			$moteur->assign('tel',$row['tel']);
			$moteur->assign('tel2',$row['tel2']);
			$moteur->assign('mail',$row['mail']);
			$moteur->assign('adresse',$row['adresse']);
			$moteur->assign('id_vendeur',$idvendeur);
			$moteur->display($CheminTpl.'mod_vendeur.tpl');
		}
		else
		{
			$moteur->assign('Erreur',"Le vendeur n'existe pas");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//Mauvais POST ou pas de POST
		$moteur->assign('Erreur',"Aucune information fournie");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>