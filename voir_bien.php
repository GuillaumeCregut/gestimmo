<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_bien.php  									 *
 * Date création :	01/07/2018										 *
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
	if(isset($_POST['Cle']))
	{
		$Cle=intval($_POST['Cle']);
		$SQLS=$SEL_BIEN_FULL.$Cle;
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		//Gestion d'erreur de la connexion BDD
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		$query=$db->sql_query($SQLS);
		$row=$db->sql_fetchrow($query);
		if (isset($row['id_bien']))
		{
			$Vendeur=$row['prenom'].' '.$row['nom'];
			$moteur->assign('Vendeur',$Vendeur);
			$moteur->assign('id_bien',$row['id_bien']);
			$moteur->assign('ville',$row['nom_ville']);
			$moteur->assign('prix',$row['prix']);
			$moteur->assign('surf',$row['surface_terrain']);
			$moteur->assign('surfh',$row['surface_habitable']);
			$moteur->assign('piece',$row['Nbre_pieces']);
			$moteur->assign('adresse',$row['Adresse']);
			$moteur->assign('etat',$row['nom_etat']);
			$moteur->assign('bien',$row['nom_bien']);
			$moteur->assign('id_vendeur',$row['pk_vendeur']);
			$moteur->assign('commission',$row['commission']);
			//Selectionne le nombre de visites de ce bien
			$db2= new connect_base($serveur,$database,$username,$password);
			//On est sur que la connexion est OK
			$query2=$db2->sql_query($SEL_NBRE_VISITE_BIEN.$Cle);
			$row2=$db2->sql_fetchrow($query2);
			$Nbrevisite=0;
			if(isset($row2['nbre']))
			{
				$Nbrevisite=$row2['nbre'];
			}
			$moteur->assign('NbreVisite',$Nbrevisite);
			$moteur->display($CheminTpl.'voir_bien.tpl');
		}
		else
		{
			//Aucune valeur dans la base
			echo "<p>Il n'y a pas de valeurs</p>";
		}
	}
	else
	{
		//Pas de valeur post
		$moteur->assign('Erreur','Aucune valeur fournie');
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>