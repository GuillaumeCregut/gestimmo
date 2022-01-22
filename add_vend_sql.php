<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	add_vend_sql.php  								 *
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
	if(!$_SESSION['Gest_Immo_Ed98']['Add_vendeur'])
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
	//On vérifie la validité des valeurs
	if($Nom=='' or $Prenom=='')
	{
		$Erreur=true;
		$Id_Erreur=3;
	}
	//Si les valeurs sont toutes OK
	if(!$Erreur)
	{
		//Création du tableau de valeur pour SQL CALL P_Add_Vendeur(:tel,:mail,:nom,:prenom,:ad)
		$TabValeurs=array(':tel'=>$Tel,':mail'=>$Mail,':nom'=>$Nom,':prenom'=>$Prenom,':ad'=>$Adresse,':tel2'=>$Tel2);
		//Connexion à la base de données
		$db= new connect_base($serveur,$database,$username,$password);
		$Resultat=-1;
		//Si erreur de connexion à la base de données
		if(is_null($db->connect_id))
		{
			$ResultatAffiche="Erreur : Un probl&egrave;me de configuration emp&ecirc;che d'acc&eacute;der aux donn&eacute;es. Veuillez contacter l'administrateur !";
		}	
		else		
			$Resultat=$db->ExecProc($TabValeurs,$ADD_VENDEUR); //Changer la requete !!!
		if($Resultat==1)
		{
			$ResultatAffiche="Le vendeur $Nom $Prenom &agrave; bien &eacute;t&eacute; ajout&eacute; !";
		}
		else
		{
			$ResultatAffiche="Le vendeur n'a put &ecirc;tre enregistr&eacute; !";
		}
	}
	else
	{
		//On récupère le type d'erreur pour l'afficher
		switch($Id_Erreur)
		{
			case 0 : $NomErreur='Formulaire incomplet'; 
				break;
			case 1 : $NomErreur='Valeur des prix incompatible';//inutile
				break;
			case 2 : $NomErreur='Valeur des surfaces incompatible';//inutile
				break;
			case 3 : $NomErreur='Erreur de saisie du nom et pr&eacute;nom';
				break;	
		}
		$ResultatAffiche="Erreur : $NomErreur<br>Le vendeur n'a pas &eacute;t&eacute; ajout&eacute; !";
	}
	$moteur->assign('LeResultat',$ResultatAffiche);
	$moteur->display($CheminTpl.'ad_vendeur_sql.tpl');
	$_SESSION['Gest_Immo_Ed98']['Add_vendeur']=false;
?>