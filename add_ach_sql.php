<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_ach_sql.php 								 *
 * Date création :	24/06/2018										 *
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
	$Erreur=false;
	if(!$_SESSION['Gest_Immo_Ed98']['Add_acheteur'])
	{
		$moteur->assign('Erreur',"L'ajout &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();
		
	}
	//On regarde si on a recu les infos 
	if(isset($_POST['prenom']))
	{
		$Prenom=$_POST['prenom'];
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['nom']))
	{
		$Nom=$_POST['nom'];
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['adresse']))
	{
		$Adresse=$_POST['adresse'];
	}
	else
	{
		$Adresse='non renseignée';
	}
	if(isset($_POST['tel']))
	{
		$Tel=$_POST['tel'];
	}
	else
	{
		$Tel=0;
	}
	if(isset($_POST['tel2']))
	{
		$Tel2=$_POST['tel2'];
	}
	else
	{
		$Tel2=0;
	}
	if(isset($_POST['mail']))
	{
		$Mail=$_POST['mail'];
	}
	else
	{
		$Mail='non renseigné';
	}
	if(isset($_POST['TypeMaison']))
	{
		$Type_Bien=intval($_POST['TypeMaison']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['etat']))
	{
		$Etat_Bien=intval($_POST['etat']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['surf_min']))
	{
		$Surf_Min=intval($_POST['surf_min']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['surf_max']))
	{
		$Surf_Max=intval($_POST['surf_max']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['prix_min']))
	{
		$Prix_Min=intval($_POST['prix_min']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['prix_max']))
	{
		$Prix_Max=intval($_POST['prix_max']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['ville']))
	{
		$Ville=intval($_POST['ville']);
	}
	else
	{
		$Erreur=true;
	}
	if(isset($_POST['dist_max']))
	{
		$Dist_Max=intval($_POST['dist_max']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//
	if(isset($_POST['surf_min_h']))
	{
		$Surf_Hab_Min=intval($_POST['surf_min_h']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['surf_max_h']))
	{
		$Surf_Hab_Max=intval($_POST['surf_max_h']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	if(isset($_POST['pieces']))
	{
		$Nb_Pieces=intval($_POST['pieces']);
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//On vérifie la validité des valeurs
	if(($Nb_Pieces=='') or(!is_int($Nb_Pieces)))
	{
		$Nb_Pieces=0;
	}
	if(($Dist_Max=='') or(!is_int($Dist_Max)))
	{
		$Dist_Max=0;
	}
	if((!is_int($Prix_Max) OR (!is_int($Prix_Max))))
	{
		$Erreur=true;
		$Id_Erreur=1;
	}
	else
	{
		if ($Prix_Max<$Prix_Min)
		{
			//On inverse les prix
			$Temp=$Prix_Max;
			$Prix_Max=$Prix_Min;
			$Prix_Min=$Temp;
		}
	}
	if((!is_int($Surf_Max) OR (!is_int($Surf_Min))))
	{
		$Erreur=true;
		$Id_Erreur=2;
	}
	else
	{
		if ($Surf_Max<$Surf_Min)
		{
			//On inverse les surfaces
			$Temp=$Surf_Max;
			$Surf_Max=$Surf_Min;
			$Surf_Min=$Temp;
		}
	}
	//Surface habitable
	if((!is_int($Surf_Hab_Max) OR (!is_int($Surf_Hab_Min))))
	{
		$Erreur=true;
		$Id_Erreur=4;
	}
	else
	{
		if ($Surf_Hab_Max<$Surf_Hab_Min)
		{
			//On inverse les surfaces
			$Temp=$Surf_Hab_Max;
			$Surf_Hab_Max=$Surf_Hab_Min;
			$Surf_Hab_Min=$Temp;
		}
	}
	//Nom et prénom
	if($Nom=='' or $Prenom=='')
	{
		$Erreur=true;
		$Id_Erreur=3;
	}
	//Si les valeurs sont toutes OK
	if(!$Erreur)
	{
		//Création du tableau de valeur pour SQL :sh_min,:sh_max,:nb_p $Surf_Hab_Min $Surf_Hab_Max $Nb_Pieces
		$TabValeurs=array(':el'=>$Etat_Bien,':tb'=>$Type_Bien,':fv'=>$Ville,':tel'=>$Tel,':mail'=>$Mail,':nom'=>$Nom,':prenom'=>$Prenom,':p_min'=>$Prix_Min,':p_max'=>$Prix_Max,':s_min'=>$Surf_Min,':s_max'=>$Surf_Max,':ad'=>$Adresse,':dist'=>$Dist_Max,':sh_min'=>$Surf_Hab_Min,':sh_max'=>$Surf_Hab_Max,':nb_p'=>$Nb_Pieces,':tel2'=>$Tel2);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		$Resultat=-1;
		//Si erreur de connexion à la base de données
		if(is_null($db->connect_id))
		{
			$ResultatAffiche="Erreur : Un probl&egrave;me de configuration emp&ecirc;che d'acc&eacute;der aux donn&eacute;es. Veuillez contacter l'administrateur !";
		}	
		else		
			$Resultat=$db->ExecProc($TabValeurs,$ADD_ACHETEUR);
		if($Resultat==1)
		{
			$ResultatAffiche="Le client $Nom $Prenom &agrave; bien &eacute;t&eacute; ajout&eacute; !";
		}
		else
		{
			$ResultatAffiche="Le client n'a put &ecirc;tre enregistr&eacute; !";
		}
	}
	else
	{
		//On récupère le type d'erreur pour l'afficher
		switch($Id_Erreur)
		{
			case 0 : $NomErreur='Formulaire incomplet';
				break;
			case 1 : $NomErreur='Valeur des prix invalide';
				break;
			case 2 : $NomErreur='Valeur des surfaces invalide';
				break;
			case 3 : $NomErreur='Erreur de saisie du nom et pr&eacute;nom';
				break;	
			case 4 : $NomErreur='Valeur des surfaces habitables invalide';
				break;
		}
		$ResultatAffiche="Erreur : $NomErreur<br>Le client n'a pas &eacute;t&eacute; ajout&eacute; !";
	}
	$moteur->assign('LeResultat',$ResultatAffiche);
	$moteur->display($CheminTpl.'add_ach_sql.tpl');
	$_SESSION['Gest_Immo_Ed98']['Add_acheteur']=false;
?>