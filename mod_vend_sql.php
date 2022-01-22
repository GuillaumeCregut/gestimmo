<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mod_vend_sql.php  								 *
 * Date création :	03/07/2018										 *
 * Date Modification :	08/07/2018									 *
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
	//Vérifier la modification
	if(!$_SESSION['Gest_Immo_Ed98']['mod_vendeur'])
	{
		$moteur->assign('Erreur',"La modification a d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;e");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();	
	}
	//Test du FORM
	if(isset($_POST['IdVendeur']))
	{
		//Récupération des infos
		$IdVendeur=intval($_POST['IdVendeur']);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		if(isset($_POST['prenom']))
		{
			$LePrenom=$_POST['prenom'];
		}
		else
		{
			$LePrenom='';
		}
		if(isset($_POST['nom']))
		{
			$LeNom=$_POST['nom'];
		}
		else
		{
			$LeNom='';
		}
		if(isset($_POST['adresse']))
		{
			$Ladresse=$_POST['adresse'];
		}
		else
		{
			$Ladresse='';
		}
		if(isset($_POST['tel']))
		{
			$LeTel=$_POST['tel'];
		}
		else
		{
			$LeTel='';
		}
		if(isset($_POST['tel2']))
		{
			$LeTel2=$_POST['tel2'];
		}
		else
		{
			$LeTel2='';
		}
		if(isset($_POST['mail']))
		{
			$LeMail=$_POST['mail'];
		}
		else
		{
			$LeMail='';
		}
		//Vérification des entrées obligatoires
		if(($LeNom!='')&&($LePrenom!=''))
		{
			//Requete
			//$MOD_VENDEUR="CALL P_Mod_Vendeur(:a,:b,:c,:d,:e,:f)";//id,tel,mail,nom,prenom,adresse
		//Formatage du tableau de données
			$TabData=array(':a'=>$IdVendeur,':b'=>$LeTel,':c'=>$LeMail,':d'=>$LeNom,':e'=>$LePrenom,':f'=>$Ladresse,':g'=>$LeTel2);
			$Resultat=$db->ExecProc($TabData, $MOD_VENDEUR);
			if($Resultat==1)
			{
				//OK, c'est bon
				$moteur->display($CheminTpl.'mod_vend_sql.tpl');
			}
			else
			{
				$moteur->assign('Erreur',"La modification du vendeur n'a put &ecirc;tre r&eacute;alis&eacute;e");
				$moteur->display($CheminTpl.'erreur.tpl');
				die();
			}
			//On bloque les reload page
			$_SESSION['Gest_Immo_Ed98']['mod_vendeur']=false;
		}
		else
		{
			//Valeurs obligatoires non remplies
			$moteur->assign('Erreur',"Il manque des informations");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		$moteur->assign('Erreur',"Le vendeur n'existe pas");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>