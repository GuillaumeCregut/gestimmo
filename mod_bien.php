<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mod_bien.php  									 *
 * Date création :	01/07/2018										 *
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
	if(isset($_POST['id_bien']))
	{
		$Id_Bien=intval($_POST['id_bien']);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		//Gestion d'erreur de la connexion BDD
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		if(isset($_POST['prix'])&&isset($_POST['commission'])&&(isset($_POST['Surf'])&&(isset($_POST['Surf_h'])&&(isset($_POST['pieces']))
		{
			//update prix
			$NouveauPrix=intval($_POST['prix']);
			$Commission=intval($_POST['commission']);
			$Surface=intval($_POST['Surf']);
			$Surf_Hab=intval($_POST['Surf_h']);
			$Pieces=intval($_POST['pieces']);
			
			$SQLS=$MOD_PRIX_BIEN;
			//d:surface, e: surf hab, f: Pieces
			$TabValeurs=array(':a'=>$NouveauPrix,':b'=>$Id_Bien,':c'=>$Commission,':d'=>$Surface,':e'=>$Surf_Hab,':f'=>Pieces);
			$Resultat=$db->ExecProc($TabValeurs,$SQLS);
			if($Resultat==1)
			{
				$moteur->assign('PrixMod',"Prix et commission correctement modifi&eacute;s");
			}
		}
		if(isset($_POST['vendue']))
		{
			//Update vente
			$SQLS=$MOD_VENDU_BIEN;
			$TabValeurs=array(':a'=>$Id_Bien);
			$Resultat=$db->ExecProc($TabValeurs,$SQLS);
			if($Resultat==1)
			{
				$moteur->assign('Vente',"Le bien a bien &eacute;t&eacute; retir&eacute;");
			}
		}
		$moteur->display($CheminTpl.'modif_bien.tpl');
	}
	else
	{
		$moteur->assign('Erreur','Identifiant invalide');
		$moteur->display($CheminTpl.'erreur.tpl');
	}
?>