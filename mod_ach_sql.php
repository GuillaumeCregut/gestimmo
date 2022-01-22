<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mod_ach_sql.php  								 *
 * Date création :	04/07/2018										 *
 * Date Modification :	08/07/2018									 *
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
	$Id_Erreur=0;
	$Erreur=false;
	if(isset($_POST['id_acheteur']))
	{
		$id_acheteur=intval($_POST['id_acheteur']);
		//On récupère les autres valeurs
		if(isset($_POST['adresse']))
		{
			if($_POST['adresse']!='')
				$Adresse=$_POST['adresse'];
			else
				$Adresse='non renseignée';
		}
		else
		{
			$Adresse='non renseignée';
		}
		if(isset($_POST['tel']))
		{
			if($_POST['tel']!='')
				$Tel=$_POST['tel'];
			else
				$Tel=0;
		}
		else
		{
			$Tel=0;
		}
		if(isset($_POST['tel2']))
		{
			if($_POST['tel2']!='')
				$Tel2=$_POST['tel2'];
			else
				$Tel2=0;
		}
		else
		{
			$Tel2=0;
		}
		if(isset($_POST['mail']))
		{
			if($_POST['mail']!='')
				$Mail=$_POST['mail'];
			else
				$Mail='non renseigné';
		}
		else
		{
			$Mail='non renseigné';
		}
		if(isset($_POST['TypeMaison']))
		{
			if(settype($_POST['TypeMaison'],"integer"))
				$Type_Bien=intval($_POST['TypeMaison']);
			else
			{
				$Erreur=true;
			}
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=1;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['etat']))
		{
			if(settype($_POST['etat'],"integer"))
				$Etat_Bien=intval($_POST['etat']);
			else
			{
				$Erreur=true;
			}
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=2;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['surf_min']))
		{
			if(settype($_POST['surf_min'],"integer"))
				$Surf_Min=intval($_POST['surf_min']);
			else
			{
				$Erreur=true;
			}
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=3;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['surf_max']))
		{
			if(settype($_POST['surf_max'],"integer"))
				$Surf_Max=intval($_POST['surf_max']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=4;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['prix_min']))
		{
			if(settype($_POST['prix_min'],"integer"))
				$Prix_Min=intval($_POST['prix_min']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=5;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['prix_max']))
		{
			if(settype($_POST['prix_max'],"integer"))
				$Prix_Max=intval($_POST['prix_max']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=6;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['ville']))
		{
			if(settype($_POST['ville'],"integer"))
				$Ville=intval($_POST['ville']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			echo '<p>Erreur Ville</p>';
		}
		if(isset($_POST['dist_max']))
		{
			if(settype($_POST['dist_max'],"integer"))
			{
				$Dist_Max=$_POST['dist_max'];
			}
			else
				$Dist_Max=0;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=7;
			echo '<p>$Id_Erreur</p>';
		}
		//
		if(isset($_POST['surf_min_h']))
		{
			if(settype($_POST['surf_min_h'],"integer"))
				$Surf_Hab_Min=intval($_POST['surf_min_h']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=8;
			echo '<p>$Id_Erreur</p>';
		}
		if(isset($_POST['surf_max_h']))
		{
			if(settype($_POST['surf_max_h'],"integer"))
				$Surf_Hab_Max=intval($_POST['surf_max_h']);
			else
				$Erreur=true;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=9;
		}
		if(isset($_POST['pieces']))
		{
			if(settype($_POST['pieces'],'integer'))
			{
				$Nb_Pieces=$_POST['pieces'];
			}
			else
				$Nb_Pieces=0;
		}
		else
		{
			$Erreur=true;
			$Id_Erreur=10;
		}
		if(!$Erreur)
		{
			//Analyse des entrées
			if ($Prix_Max<$Prix_Min)
			{
				//On inverse les prix
				$Temp=$Prix_Max;
				$Prix_Max=$Prix_Min;
				$Prix_Min=$Temp;
			}
			if ($Surf_Max<$Surf_Min)
			{
				//On inverse les surfaces
				$Temp=$Surf_Max;
				$Surf_Max=$Surf_Min;
				$Surf_Min=$Temp;
			}
			if ($Surf_Hab_Max<$Surf_Hab_Min)
			{
				//On inverse les surfaces
				$Temp=$Surf_Hab_Max;
				$Surf_Hab_Max=$Surf_Hab_Min;
				$Surf_Hab_Min=$Temp;
			}
			//Création du tableau de valeur pour SQL
			$TabValeurs=array(':id'=>$id_acheteur,':etat'=>$Etat_Bien,':bien'=>$Type_Bien,':ville'=>$Ville,':lemail'=>$Mail,':px_min'=>$Prix_Min,':px_max'=>$Prix_Max,':s_min'=>$Surf_Min,':s_max'=>$Surf_Max,':ad'=>$Adresse,':dist'=>$Dist_Max,':sh_min'=>$Surf_Hab_Min,':sh_max'=>$Surf_Hab_Max,':pieces'=>$Nb_Pieces,':tel'=>$Tel,':tel2'=>$Tel2);
			//echo "<pre>";print_r($TabValeurs);echo "</pre>";
			//Connexion à la base de données
			$db= new connect_base($serveur,$database,$username,$password);
			$Resultat=-1;
			//Si erreur de connexion à la base de données
			if(is_null($db->connect_id))
			{
				$moteur->display($CheminTpl.'erreurbdd.tpl');
				die();
			}	
			//Execution de la requete
			$Resultat=$db->ExecProc($TabValeurs,$MOD_ACHETEUR);
			if($Resultat==1)
			{
				$ResultatAffiche="Acheteur correctement modif&eacute;";
			}
			else
			{
				//La requete n'a rien modifier
				$ResultatAffiche="Aucune modification n'a &eacute;t&eacute; effectu&eacute;e";
			}
			$moteur->assign('LeResulat',$ResultatAffiche);
			$moteur->display($CheminTpl.'mod_ach_sql.tpl');
		}
		else
		{
			//Une des valeurs n'est pas OK
			$moteur->assign('Erreur',"Valeurs invalides");
			$moteur->display($CheminTpl.'erreur.tpl');
			die();
		}
	}
	else
	{
		//Formulaire vide
		$moteur->assign('Erreur',"Aucune information fournie");
		$moteur->display($CheminTpl.'erreur.tpl');
		die();
	}

?>