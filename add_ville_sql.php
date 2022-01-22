<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_ville_sql.php  								 *
 * Date création :	30/06/2018										 *
 * Date Modification :	03/07/2018									 *
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
	if(!$_SESSION['Gest_Immo_Ed98']['Add_ville'])
	{
		$moteur->assign('Erreur',"L'ajout &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();
		
	}
	if(isset($_POST['NlleVille']))
	{
		$NomVille=$_POST['NlleVille'];
		if(strlen($NomVille)>0)
		{
			//Connexion à la base de données
			$db= new connect_base($serveur,$database,$username,$password);
			//Gestion d'erreur de la connexion BDD
			if(is_null($db->connect_id))
			{
				$moteur->display($CheminTpl.'erreurbdd.tpl');
				die();
			}
			//On ajoute la ville à la base de données et on récupère son ID
			$TabSQLVille=array(':nomville'=>$NomVille);
			$SQLS=$AddVille;
			$IdNouvelle_Ville=$db->sql_Insert_With_ID($TabSQLVille,$SQLS);
			$IdNouvelle_Ville=intval($IdNouvelle_Ville);
			$Monerreur=$db->sql_Last_Erreur();
			$NumErreur=intval($Monerreur[0]);
			if (($NumErreur!=0) ||($IdNouvelle_Ville==0))
			{
				//Erreur
				$TexteErreur=$Monerreur[2];
				//Mettre la page qui va bien
				$Erreur="Erreur interne : $TexteErreur. La ville n'a pas &eacute;t&eacute; enregistr&eacute;e";
				$moteur->assign('Erreur',$Erreur);
				$LaPage='erreur_add_ville.tpl';
				$moteur->display($CheminTpl.$LaPage);
				die();
			}
			//On récupère le tableau des distances
			if (isset($_POST['idville']))
			{
				if(is_array($_POST['idville']))
				{
					$TabDistances=$_POST['idville'];
					foreach($TabDistances as $key=>$value)
					{
						//Mise en forme et protection des valeurs
						$id_ville=intval($key);
						$distance=intval($value);
						if(($id_ville>0) &&($distance>0))
						{
							//Les valeurs sont OK
							$TabValeurs=array(':vil1'=>$IdNouvelle_Ville,':vil2'=>$id_ville,':dist'=>$distance);
							//On ajoute à la base de données
							$Resultat=$db->ExecProc($TabValeurs,$AddDistance);				
						}
					}
					//On affiche la page
					$moteur->assign('nomVille',$NomVille);
					$LaPage='add_ville_ok.tpl';
				}
				else
				{
					$Erreur="Aucune valeur saisie pour les distances. Seule la ville a &eacute;&eacute; enregistr&eacute;e";
					$moteur->assign('Erreur',$Erreur);
					$LaPage='erreur_add_ville.tpl';
				}
			}
			else
			{
				//Il n'y a pas de POST de distance
				$Erreur="Aucune valeur saisie pour les distances. Seule la ville a &eacute;&eacute; enregistr&eacute;e";
				$moteur->assign('Erreur',$Erreur);
				$LaPage='erreur_add_ville.tpl';
			}
		}
		else
		{
			//Le nom de la ville est invalide
			$Erreur="Le nom de la ville est incorrect. Aucune information enregitr&eacute;e";
			$moteur->assign('Erreur',$Erreur);
			$LaPage='erreur_add_ville.tpl';
		}
	}
	else
	{
		//Il n'y a pas de nouvelle ville (post vide)
		$Erreur="Aucune information transmise. Aucune information enregitr&eacute;e";
		$moteur->assign('Erreur',$Erreur);
		$LaPage='erreur_add_ville.tpl';
	}
	$moteur->display($CheminTpl.$LaPage);
	$_SESSION['Gest_Immo_Ed98']['Add_ville']=false;
?>