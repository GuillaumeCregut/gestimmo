<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_visite_client_sql.php						 *
 * Date création :	10/07/2018										 *
 * Date Modification :	10/07/2018									 *
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
	if($_SESSION['Gest_Immo_Ed98']['Add_visite'])
	{
		if(isset($_POST['id_acheteur']))
		{
			$Id_Acheteur=intval($_POST['id_acheteur']);
			$Erreur=false;
			if (isset($_POST['id_bien']))
			{
			  $id_bien=intval($_POST['id_bien']);
			}
			else
			{
			   $Erreur=true;
			}
			if (isset($_POST['ladate']))
			{
			  $MaDate=($_POST['ladate']);
			}
			else
			{
			  $Madate=date("Y-m-d");
			}
			if (isset($_POST['commentaire']))
			{
			  $MonCom=$_POST['commentaire'];
			}
			else
			{
			 $MonCom=''; 
			}
			if(!$Erreur)
			{
			  //On enregistre la visite
			  //$ADD_VISITE="CALL P_Add_Visite(:client,:bien,:ladate,:lecomm)";
				$tabValeur=array(':client'=>$Id_Acheteur,':bien'=>$id_bien,':ladate'=>$MaDate,':lecomm'=> $MonCom);
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
			  //Erreur dans le post
				$moteur->assign('Erreur',"Le bien n'existe pas");
				$moteur->display($CheminTpl.'erreur.tpl');
				die();
			}
		}
		else
		{
		  //POST incohérent
			$moteur->assign('Erreur',"Valeur non valides");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//Deja créee
		$moteur->assign('Erreur',"La visite &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;e");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>