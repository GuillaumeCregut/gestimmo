<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	vente.php  										 *
 * Date création :	02/07/2018										 *
 * Date Modification :	04/07/2018									 *
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
	if(!$_SESSION['Gest_Immo_Ed98']['Add_vente'])
	{
		$moteur->assign('Erreur',"La vente &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;e");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();
		
	}
	if(isset($_POST['id_bien'])&&isset($_POST['acheteur'])&&isset($_POST['pvente'])&&isset($_POST['commission'])&&isset($_POST['ladate']))
	{
		$id_bien=intval($_POST['id_bien']);
		$id_acheteur=intval($_POST['acheteur']);
		$PrixVente=intval($_POST['pvente']);
		$LaCom=intval($_POST['commission']);
		$MaDate=$_POST['ladate'];
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		//On vérifie si les bien et acheteur existent
		$SQLS=$SEL_NBRE_BIEN.$id_bien;
		$query=$db->sql_query($SQLS);
		$row=$db->sql_fetchrow($query);
		$ComtpeBien=$row['nbre'];
		$SQLS=$SEL_NBRE_ACHETEUR.$id_acheteur;
		$query=$db->sql_query($SQLS);
		$row=$db->sql_fetchrow($query);
		$ComtpeAcheteur=$row['nbre'];
		if(($ComtpeAcheteur==1)&($ComtpeBien==1))
		{
			//Insertion dans la table vente des critères
			$TavVente=array(':bien'=>$id_bien,':acheteur'=>$id_acheteur,':prix'=>$PrixVente,':com'=>$LaCom,':datev'=>$MaDate);
			$resultat=$db->ExecProc($TavVente, $ADD_VENTE);
			if($resultat==1)
			{
				$moteur->assign('ResultVente','Vente effectu&eacute;e');
				//On marque le bien comme vendu
				$TabBien=array(':a'=>$id_bien);
				//$resultat=$db->ExecProc($TabBien,$MOD_VENDU_BIEN);
				if($resultat==1)
				{
					$moteur->assign('EtatBien','Le bien a &eacute;t&eacute; retir&eacute; de la vente');
				}
				else
				{
					$moteur->assign('EtatBien',"Erreur : Le bien n'a pas &eacute;t&eacute; retir&eacute; de la vente");
				}
				//On marque l'acheteur comme servi
				$TabAch=array(':a'=>$id_acheteur);
				$resultat=$db->ExecProc($TabAch,$MOD_SERT_ACHETEUR);
				if($resultat==1)
				{
					$moteur->assign('EtatAch',"L'acheteur a bien &eacute;t&eacute; modifi&eacute;");
				}
				else
				{
					$moteur->assign('EtatAch',"L'acheteur n'a pas &eacute;t&eacute; modifi&eacute;");
				}
			}
			else
			{
				$moteur->assign('ResultVente',"Erreur, la vente n'a pas &eacute;t&eacute; enregistr&eacute;e");
			}
			
			$moteur->display($CheminTpl.'vente.tpl');
			$_SESSION['Gest_Immo_Ed98']['Add_vente']=false;
		}
		else
		{
			//Problème : il n'y a pas soit le bien, soit l'acheteur dans la base
			$moteur->assign('Erreur',"L'acheteur ou le bien n'existe pas");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//POST vide
		$moteur->assign('Erreur',"Aucune information fournie");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>