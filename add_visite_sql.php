<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_visite_sql.php								 *
 * Date création :	08/07/2018										 *
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
	include('include/config.inc.php');
	include('include/sql.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	//echo "<pre>";print_r($_POST);echo"</pre>";
	//On vérifie l'anti doublon
	if($_SESSION['Gest_Immo_Ed98']['Add_visite'])
	{
		if(isset($_POST['id_bien']))
		{
			//On récupère les autres valeurs et on ajoute
			$id_bien=intval($_POST['id_bien']);
			$Erreur=false;
			if(isset($_POST['acheteur']))
			{
				$id_acheteur=intval($_POST['acheteur']);
			}
			else
			{
				$Erreur=true;
			}
			if(isset($_POST['ladate']))
			{
				$DateVisite=$_POST['ladate'];
			}
			else
			{
				$DateVisite=date("Y-m-d");;
			}
			if(isset($_POST['commentaire']))
			{
				$LeComm=addslashes($_POST['commentaire']);
			}
			else
			{
				$LeComm='';
			}
			if(!$Erreur)
			{
				//$ADD_VISITE="CALL P_Add_Visite(:client,:bien,:ladate,:lecomm)";
				$tabValeur=array(':client'=>$id_acheteur,':bien'=>$id_bien,':ladate'=>$DateVisite,':lecomm'=>$LeComm);
				//Connexion à la base de données
				$db= new connect_base($serveur,$database,$username,$password);
				if(is_null($db->connect_id))
				{
					$moteur->display($CheminTpl.'erreurbdd.tpl');
					die();
				}
				$Resultat=$db->ExecProc($tabValeur, $ADD_VISITE);
				if($Resultat==1)
				{
					//OK, c'est bon
					$moteur->display($CheminTpl.'add_visite_sql.tpl');
					$_SESSION['Gest_Immo_Ed98']['Add_visite']=false;
				}
				else
				{
					$moteur->assign('Erreur',"l'ajout de la visite n'a put &ecirc;tre r&eacute;alis&eacute;e");
					$moteur->display($CheminTpl.'erreur.tpl');
					die();
				}
			}
			else
			{
				//Erreur : acheteur non valide
				$moteur->assign('Erreur',"L'acheteur n'existe pas");
				$moteur->display($CheminTpl.'erreur.tpl');
				die();
			}
		}
		else
		{
			//POST incoherent
			$moteur->assign('Erreur',"Valeur non valides");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		$moteur->assign('Erreur',"La visite &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;e");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();
	}
?>