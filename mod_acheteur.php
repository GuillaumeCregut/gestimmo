<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mod_client.php  								 *
 * Date création :	04/07/2018										 *
 * Date Modification :	04/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	$_SESSION['Gest_Immo_Ed98']['Mod_acheteur']=true;
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/config.inc.php');
	include('include/sql.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	//Connexion à la base de données
	$db= new connect_base($serveur,$database,$username,$password);
	//Gestion d'erreur de la connexion BDD
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
		die();
	}
	if(isset($_POST['id_Acheteur']))
	{
		//Récupération des infos du client
		$IdAcheteur=intval($_POST['id_Acheteur']);
		$tab=array(':a'=>$IdAcheteur);
		$query=$db->sql_fetch_prepared($tab,$SEL_ACHETEUR_TABLE);
		$row=$db->sql_fetchrow($query);
		if(isset($row['nom'])&&$row['nom']!='')
		{
			//On affiche l'acheteur
			$moteur->assign('id_acheteur',$IdAcheteur);
			$id_etat=$row['fk_etat_lieux'];
			$id_bien=$row['fk_type_bien'];
			$id_ville=$row['fk_ville'];
			if($row['tel']==0)
				$LeTel='';
			else
				$LeTel=$row['tel'];
			$moteur->assign('tel',$LeTel);
			if($row['tel2']==0)
				$LeTel2='';
			else
				$LeTel2=$row['tel2'];
			$moteur->assign('tel2',$LeTel2);
			if($row['mail']=='non renseigné')
				$LeMail='';
			else
				$LeMail=$row['mail'];
			$moteur->assign('mail',$LeMail);
			$moteur->assign('nom',$row['nom']);
			$moteur->assign('prenom',$row['prenom']);
			$moteur->assign('px_min',$row['prix_mini']);
			$moteur->assign('px_max',$row['prix_maxi']);
			$moteur->assign('s_min',$row['surf_mini']);
			$moteur->assign('s_max',$row['surf_maxi']);
			$moteur->assign('adresse',$row['adresse']);
			$moteur->assign('d_max',$row['dist_max']);
			$moteur->assign('sh_min',$row['Surf_Hab_min']);
			$moteur->assign('sh_max',$row['Surf_Hab_Max']);
			$moteur->assign('pieces',$row['Nbre_Pieces']);
			//Récupération des états
			$SQLS=$SEL_ETAT;
			$query=$db->sql_query($SQLS);
			$i=0;
			while($row=$db->sql_fetchrow($query))
			{
				$IsSelect='';
				if($row['id_etat']==$id_etat)
					$IsSelect='selected';
				$TabData[$i]['id_etat']=$row['id_etat'];
				$TabData[$i]['nom_etat']=$row['nom_etat'];
				$TabData[$i]['isSelect']=$IsSelect;
				$i++;
			}
			if(isset($TabData))
				$moteur->assign('TabEtat',$TabData);
			//Récupération des types de bien
			$SQLS=$SEL_TYPE;
			$query=$db->sql_query($SQLS);
			$i=0;
			while($row=$db->sql_fetchrow($query))
			{
				$IsSelect='';
				if($row['pk_bien']==$id_bien)
					$IsSelect='selected';
				$TabData1[$i]['id_bien']=$row['pk_bien'];
				$TabData1[$i]['nom_bien']=$row['nom_bien'];
				$TabData1[$i]['isSelect']=$IsSelect;
				$i++;
			}
			if(isset($TabData1))
				$moteur->assign('TabBien',$TabData1);
			//Récupération des villes
			$SQLS=$SEL_VILLE;
			$query=$db->sql_query($SQLS);
			$i=0;
			while($row=$db->sql_fetchrow($query))
			{
				$IsSelect='';
				if($row['pk_ville']==$id_ville)
					$IsSelect='selected';
				$TabData2[$i]['id_ville']=$row['pk_ville'];
				$TabData2[$i]['nom_ville']=$row['nom_ville'];
				$TabData2[$i]['isSelect']=$IsSelect;
				$i++;
			}
			if(isset($TabData2))
				$moteur->assign('TabVille',$TabData2);
			$moteur->display($CheminTpl.'mod_client.tpl');
		}
		else
		{
			//Erreur, existe pas
			$moteur->assign('Erreur',"l'acheteur n'existe pas");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//Erreur, post incoherent
		$moteur->assign('Erreur',"Aucune information fournie");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>