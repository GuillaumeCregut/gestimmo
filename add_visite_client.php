<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_visite_client.php							 *
 * Date création :	08/07/2018										 *
 * Date Modification :	10/07/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.1Beta												 *
 * Objet et notes :	 beta Test										 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start(); //au cas où !
	$_SESSION['Gest_Immo_Ed98']['Add_visite']=true;
	//Fichier d'insertion
	include('include/db.inc.php');
	include('include/sql.inc.php');
	include('include/config.inc.php');
	//Moteur Template
	include("include/smarty.class.php");
	$CheminTpl='templates/';
	$moteur=new Smarty();
	if(isset($_POST['id_acheteur']))
	{
		$id_acheteur=intval($_POST['id_acheteur']);
		//On récupère les infos du bien
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		if(is_null($db->connect_id))
		{
			$moteur->display($CheminTpl.'erreurbdd.tpl');
			die();
		}
		$SQLS=$SEL_ACHETEUR_TABLE;
		$tabValeur=array(':a'=>$id_acheteur);
		$query=$db->sql_fetch_prepared($tabValeur,$SQLS);
		$row=$db->sql_fetchrow($query);
		//echo"<pre>";print_r($row);echo"</pre>";
		if(isset($row['nom']))
		{
		//Si on a des infos
			$moteur->assign('id_acheteur',$id_acheteur);
			$NomAcheteur=$row['prenom'].' '.$row['nom'];
			$moteur->assign('NomAcheteur',$NomAcheteur);
			$Madate=date("Y-m-d");
			$moteur->assign('dateV',$Madate);
			//On récupère les bien en vente
			$SQLS=$SEL_BIENS_VENTE;
			$query=$db->sql_query($SQLS);
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
			$moteur->display($CheminTpl.'add_visite_client.tpl');
		}
		else
		{
			//Rien dans la base niveau bien
			$moteur->assign('Erreur',"L'acheteur n'existe pas");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//Post Vide
		$moteur->assign('Erreur',"Aucune information disponible");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}
?>