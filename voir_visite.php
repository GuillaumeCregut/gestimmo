<?php
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * 																	 *
	 * Nom de la page :	voir_visite.php									 *
	 * Date création :	10/07/2018										 *
	 * Date Modification :	13/07/2018									 *
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
	include('include/function.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	if((isset($_POST['id_acheteur'])) ||(isset($_POST['id_bien'])))
	{
		$SQLS=$SEL_VUE_VISITE;
		if(isset($_POST['id_acheteur']))
		{
			//On recherche par l'acheteur
			$Id_Rech=intval($_POST['id_acheteur']);
			$SQLS.=$WHERE_VISITE_ACHETEUR;
		}
		else
		{
		//On recherche par le bien
			$Id_Rech=intval($_POST['id_bien']);
			$SQLS.=$WHERE_VISITE_BIEN;
		}
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		//Gestion d'erreur de la connexion BDD
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		$TabValeur=array(':a'=>$Id_Rech);
		$query=$db->sql_fetch_prepared($TabValeur,$SQLS);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			//echo"<pre>";print_r($row);echo"</pre>";
			/*
			[pk_visite] 
			*/
			$tabVisite[$i]['NomPrenom']=$row['prenom'].' '.$row['nom'];
			$LaDate=$row['date_visite'];
			$LaDate=convertDate($LaDate,1);
			$tabVisite[$i]['datevisite']=$LaDate;
			$tabVisite[$i]['typebien']=$row['nom_bien'];
			$tabVisite[$i]['etat']=$row['nom_etat'];
			$tabVisite[$i]['adresse']=$row['adresse'];
			$tabVisite[$i]['ville']=$row['nom_ville'];
			$tabVisite[$i]['NomVendeur']=$row['ven_prenom'].' '.$row['ven_nom'];
			$tabVisite[$i]['Prix']=$row['prix'];
			$tabVisite[$i]['Commission']=$row['commission'];
			$tabVisite[$i]['Commentaire']=nl2br($row['comm']);
			$tabVisite[$i]['id_bien']=$row['fk_bien'];
			$tabVisite[$i]['id_acheteur']=$row['fk_client'];
			$i++;
		}
		if(isset($tabVisite))
			$moteur->assign('TabVisite',$tabVisite);
		$moteur->display($CheminTpl.'voir_visite.tpl');
	}
	else
	{
		  //POST incoherent
		$moteur->assign('Erreur',"Valeur non valides");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>