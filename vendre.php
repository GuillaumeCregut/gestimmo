<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	vendre.php  									 *
 * Date création :	02/07/2018										 *
 * Date Modification :	04/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	$_SESSION['Gest_Immo_Ed98']['Add_vente']=true;
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/sql.inc.php');
	include('include/config.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	if(isset($_POST['id_bien']))
	{
		$id_bien=intval($_POST['id_bien']);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		$SQLS=$SEL_BIEN_VENDRE.$id_bien;
		$query=$db->sql_query($SQLS);
		$row=$db->sql_fetchrow($query);
		if(isset($row['id_bien']))
		{
			$moteur->assign('id_bien',$row['id_bien']);
			$NomVendeur=$row['prenom'].' '.$row['nom'];
			$moteur->assign('NomVendeur',$NomVendeur);
			$moteur->assign('type_bien',$row['nom_bien']);
			$moteur->assign('Etat_bien',$row['nom_etat']);
			$moteur->assign('Surf_Terr',$row['surface_terrain']);
			$moteur->assign('Surf_Hab',$row['surface_habitable']);
			$moteur->assign('Nbre_pieces',$row['Nbre_pieces']);
			$moteur->assign('Ville',$row['nom_ville']);
			$moteur->assign('Adresse',$row['Adresse']);
			$moteur->assign('Prix',$row['prix']);
			$moteur->assign('commission',$row['commission']);
			$Madate=date("Y-m-d");
			$moteur->assign('dateV',$Madate);
			//Selection de l'acheteur
			$SQLS=$SEL_ACHETEUR_VENTE;
			$i=0;
			$query=$db->sql_query($SQLS);
			while($row=$db->sql_fetchrow($query))
			{
				$TabAcheteur[$i]['id_acheteur']=$row['pk_acheteur'];
				$NomAcheteur=$row['prenom'].' '.$row['nom'];
				$TabAcheteur[$i]['nom_acheteur']=$NomAcheteur;
				$i++;
			}
			if(isset($TabAcheteur))
				$moteur->assign('TabAcheteur',$TabAcheteur);
			//Affiche la page
			$moteur->display($CheminTpl.'vendre.tpl');
		}
		else
		{
			//Il n'y a pas de résultat dans la base
			$moteur->assign('Erreur',"Le bien selectionn&eacute; n'existe pas");
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