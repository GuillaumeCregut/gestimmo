<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_bien_sql.php  								 *
 * Date création :	26/06/2018										 *
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
	if(!$_SESSION['Gest_Immo_Ed98']['Add_bien'])
	{
		$moteur->assign('Erreur',"L'ajout &agrave d&eacute;j&agrave; &eacute;t&eacute; effectu&eacute;");
		$LaPage='erreur.tpl';
		$moteur->display($CheminTpl.$LaPage);
		die();
		
	}
	//Vérification des arrivées POST
	$Erreur=false;
	//Vendeur
	if(isset($_POST['vendeur']))
	{
		$Vendeur=intval($_POST['vendeur']);
		if(($Vendeur<=0) or (!is_int($Vendeur)))
		{
			$Erreur=true;
			$Id_Erreur=1;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Type
	if(isset($_POST['TypeMaison']))
	{
		$TypeBien=intval($_POST['TypeMaison']);
		if(($TypeBien<=0) or (!is_int($TypeBien)))
		{
			$Erreur=true;
			$Id_Erreur=2;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Etat
	if(isset($_POST['etat']))
	{
		$Etat_Bien=intval($_POST['etat']);
		if(($Etat_Bien<=0) or (!is_int($Etat_Bien)))
		{
			$Erreur=true;
			$Id_Erreur=3;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Surface terrain
	if(isset($_POST['surf_ter']))
	{
		$Surf_Ter=intval($_POST['surf_ter']);
		if(($Surf_Ter<=0) or (!is_int($Surf_Ter)))
		{
			$Erreur=true;
			$Id_Erreur=4;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Surface habitable
	if(isset($_POST['surf_hab']))
	{
		$Surf_Hab=intval($_POST['surf_hab']);
		if(!is_int($Surf_Hab))
		{
			$Erreur=true;
			$Id_Erreur=7;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Prix
	if(isset($_POST['prix_bien']))
	{
		$Prix=intval($_POST['prix_bien']);
		if(($Prix<=0) or (!is_int($Prix)))
		{
			$Erreur=true;
			$Id_Erreur=5;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Pieces
	if(isset($_POST['pieces']))
	{
		$Pieces=intval($_POST['pieces']);
		if(!is_int($Pieces))
		{
			$Erreur=true;
			$Id_Erreur=8;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Adresse
	if(isset($_POST['Adresse']))
	{
		$Adresse=$_POST['Adresse'];
	}
	else
	{
		$Adresse='';
	}
	//Ville
	if(isset($_POST['ville']))
	{
		$Ville=intval($_POST['ville']);
		if(($Ville<=0) or (!is_int($Ville)))
		{
			$Erreur=true;
			$Id_Erreur=6;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Commission
	if(isset($_POST['commission']))
	{
		$LaCom=intval($_POST['commission']);
		if(!is_int($LaCom))
		{
			$Erreur=true;
			$Id_Erreur=9;
		}
	}
	else
	{
		$Erreur=true;
		$Id_Erreur=0;
	}
	//Si pas d'erreur on ajoute
	if(!$Erreur)
	{
		//Création du tableau de valeur pour SQL
		$TabValeurs=array(':px'=>$Prix,':vendeur'=>$Vendeur,':s_ter'=>$Surf_Ter,':fk_ville'=>$Ville,':s_hab'=>$Surf_Hab,':nbre_p'=>$Pieces,':etat'=>$Etat_Bien,':type_bien'=>$TypeBien,':adr'=>$Adresse,':com'=>$LaCom);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		$Resultat=-1;
		//Si erreur de connexion à la base de données
		if(is_null($db->connect_id))
		{
			$ResultatAffiche="Erreur : Un probl&egrave;me de configuration emp&ecirc;che d'acc&eacute;der aux donn&eacute;es. Veuillez contacter l'administrateur !";
		}	
		else		
			$Resultat=$db->ExecProc($TabValeurs,$ADD_BIEN);
		if($Resultat==1)
		{
			$ResultatAffiche="Le bien immobilier &agrave; bien &eacute;t&eacute; ajout&eacute; !";
		}
		else
		{
			$ResultatAffiche="Le bien n'a put &ecirc;tre enregistr&eacute; !";
		}	
	}
	//Il y a eu une erreur
	else
	{
		switch($Id_Erreur)
		{
			case 0 : $NomErreur='Formulaire incomplet';
				break;
			case 1 : $NomErreur='Identifiant vendeur invalide';
				break;
			case 2 : $NomErreur='Type de bien invalide';
				break;
			case 3 : $NomErreur='Etat du bien invalide';
				break;
			case 4 : $NomErreur='Surface de terrain invalide';
				break;	
			case 5 : $NomErreur='Prix invalide';
				break;
			case 6 : $NomErreur='Ville invalide';
				break;
			case 7 : $NomErreur='Surface habitable invalide';
				break;
			case 8 : $NomErreur='Nombre de pi&egrave;ces invalide';
				break;
			case 9 : $NomErreur='Commission invalide';
				break;
		}
		$ResultatAffiche="Erreur : $NomErreur<br>Le client n'a pas &eacute;t&eacute; ajout&eacute; !";
	}
	$moteur->assign('LeResultat',$ResultatAffiche);
	$moteur->display($CheminTpl.'add_bien_sql.tpl');
	$_SESSION['Gest_Immo_Ed98']['Add_bien']=false;
?>