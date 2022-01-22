<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	affiche_biens_vendeur.php 						 *
 * Date création :	05/07/2018										 *
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
	//Connexion à la base de données
	$db= new connect_base($serveur,$database,$username,$password);
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
		die();
	}
	//Pas de soucis avec la connexion à la base de données
	if(isset($_POST['id_vendeur']))
	{
		$Id_Vendeur=intval($_POST['id_vendeur']);
		$tabVendeur=array(':a'=>$Id_Vendeur);
		$query=$db->sql_fetch_prepared($tabVendeur,$SEL_BIEN_VENDEUR);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			$TabBiens[$i]['id_bien']=$row['id_bien'];
			$NomVendeur=$row['prenom'].' '.$row['nom'];
			$TabBiens[$i]['NomVendeur']=$NomVendeur;
			$TabBiens[$i]['type_bien']=$row['nom_bien'];
			$TabBiens[$i]['Etat_bien']=$row['nom_etat'];
			$TabBiens[$i]['Surf_Terr']=$row['surface_terrain'];
			$TabBiens[$i]['Surf_Hab']=$row['surface_habitable'];
			$TabBiens[$i]['Nbre_pieces']=$row['Nbre_pieces'];
			$TabBiens[$i]['Ville']=$row['nom_ville'];
			$TabBiens[$i]['Prix']=$row['prix'];
			$TabBiens[$i]['commission']=$row['commission'];
			//calcul du revenu net
			$MaComm=$row['commission'];
			$CommTVA=$MaComm-(($MaComm*$TVA)/100);
			$CommReel=$CommTVA=$MaComm-(($MaComm*$RSI)/100);
			$TabBiens[$i]['revenu']=$CommReel;
			$i++;
		}
		if (isset($TabBiens))
			$moteur->assign('TabBien',$TabBiens);
		$moteur->display($CheminTpl.'affiche_biens.tpl');
	}
	else
	{
		//Il n'y a pas de POST
		$moteur->assign('Erreur',"Aucune information fournie");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
	