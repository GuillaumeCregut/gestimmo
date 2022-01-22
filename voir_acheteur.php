<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_acheteur.php  								 *
 * Date création :	26/06/2018										 *
 * Date Modification :	27/06/2018									 *
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
	include ('include/sql.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
//Recherche et affiche les acheteurs non servis
	//Connexion à la base de données
	$db= new connect_base($serveur,$database,$username,$password);
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
	}
	else
	{
		$SQLS=$SEL_ACHETEUR_FULL.' WHERE servit=0'; 
		$query=$db->sql_query($SQLS);
		$i=0;
		while($row=$db->sql_fetchrow($query))
		{
			$TabBiens[$i]['id_acheteur']=$row['pk_acheteur'];
			$NomAcheteur=$row['prenom'].' '.$row['nom'];
			$TabBiens[$i]['NOMACHETEUR']=$NomAcheteur;
			$TabBiens[$i]['TYPE_B']=$row['nom_bien'];//
			$TabBiens[$i]['ETAT']=$row['nom_etat'];//
			$TabBiens[$i]['DISTANCE']=$row['dist_max'];
			$TabBiens[$i]['VILLE']=$row['nom_ville'];
			$TabBiens[$i]['MINSURF']=$row['surf_mini'];
			$TabBiens[$i]['MAXSURF']=$row['surf_maxi'];
			$TabBiens[$i]['MINSURF_H']=$row['Surf_Hab_min'];
			$TabBiens[$i]['MAXSURF_H']=$row['Surf_Hab_Max'];
			$TabBiens[$i]['NbrePieces']=$row['Nbre_Pieces'];
			$TabBiens[$i]['MINPRIX']=$row['prix_mini'];
			$TabBiens[$i]['MAXPRIX']=$row['prix_maxi'];
			$i++;
		}
		if (isset($TabBiens))
			$moteur->assign('TabAcheteur',$TabBiens);
		$moteur->display($CheminTpl.'voir_acheteur.tpl');
	}
?>