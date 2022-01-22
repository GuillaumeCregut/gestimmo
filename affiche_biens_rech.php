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
	$TabRequete=array();
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
		die();
	}
	//Pas de soucis avec la connexion à la base de données
	if(isset($_POST['rech_ok']))
	{
		if(isset($_POST['cb_surf']))
		{
			if(isset($_POST['surf_min'])&&isset($_POST['surf_max']))
			{
				//On récupère les valeurs
				$Surf_Mini=intval($_POST['surf_min']);
				$Surf_Maxi=intval($_POST['surf_max']);
				//On met en forme le morceau de requete
				$SQLS1="($WHERE_BIEN_SURF)";
				$TabRequete[':a']=$Surf_Mini;
				$TabRequete[':b']=$Surf_Maxi;
			}
			else
			{
				//Requete vide
				$SQLS1='';
			}
		}
		else
		{
			//Requete vide
			$SQLS1='';
		}
		if(isset($_POST['cb_surf_h']))
		{
			if(isset($_POST['surf_min_h'])&&isset($_POST['surf_max_h']))
			{
				//Récupère les valeurs
				$SurfH_Mini=intval($_POST['surf_min_h']);
				$SurfH_Maxi=intval($_POST['surf_max_h']);
				//On forge la requete
				$SQLS4="($WHERE_BIEN_SURF_H)";
				$TabRequete[':c']=$SurfH_Mini;
				$TabRequete[':d']=$SurfH_Maxi;
			}
			else
			{
				//Requete vide
				$SQLS4='';
			}
		}
		else
		{
			//Requete vide
			$SQLS4='';
		}
		if(isset($_POST['cb_prix']))
		{
			if(isset($_POST['prix_min'])&&isset($_POST['prix_max']))
			{
				//On récupère les valeurs
				$Prix_Mini=intval($_POST['prix_min']);
				$Prix_Maxi=intval($_POST['prix_max']);
				//On forge la requete
				$SQLS7="($WHERE_BIEN_PRIX)";
				$TabRequete[':e']=$Prix_Mini;
				$TabRequete[':f']=$Prix_Maxi;
			}
			else
			{
				//Requete vide
				$SQLS7='';
			}
		}
		else
		{
			//Requete vide
			$SQLS7='';
		}
		if(isset($_POST['cb_piece']))
		{
			if(isset($_POST['pieces_min'])&&isset($_POST['pieces_max']))
			{
				//Recupère les valeurs
				$NombrePiece_Mini=intval($_POST['pieces_min']);
				$NombrePiece_Maxi=intval($_POST['pieces_max']);
				//On forge la requete
				$SQLS5="($WHERE_BIEN_PIECES)";
				$TabRequete[':g']=$NombrePiece_Mini;
				$TabRequete[':h']=$NombrePiece_Maxi;
			}
			else
			{
				//Requete vide
				$SQLS5='';
			}
		}
		else
		{
			//Requete vide
			$SQLS5='';
		}
		if(isset($_POST['cb_ville']))
		{
			if(isset($_POST['id_ville'])&&isset($_POST['distance']))
			{
				//On récupere les valeurs
				$Ville=intval($_POST['id_ville']);
				$Distance=intval($_POST['distance']);
				//On forge la requete
				$SQLS6="($WHERE_BIEN_VILLE"."$Ville";
				$SQLS_Ville=SEL_TABLEAU_VILLE($Ville);
				$query=$db->sql_query($SQLS_Ville);
				$i=0;
				while($row=$db->sql_fetchrow($query))
				{
					if($row['distance']<=$Distance)
					{
						if($row['fk_ville1']!=$Ville)
						{
							$TabDist[$i]['Pk_Villes']=$row['fk_ville1'];
						}
						else
						{
							$TabDist[$i]['Pk_Villes']=$row['fk_ville2'];
						}
						$i++;
					}					
				}
				if(isset($TabDist))
				{
					//Si il y a des villes voisines
					for($j=0;$j<sizeof($TabDist);$j++)
					{
						$PK=$TabDist[$j]['Pk_Villes'];
						$SQLS6.=" OR fk_ville=".$PK;
					}
				}
				$SQLS6.=')';
			}
			else
			{
				//Requete vide
				$SQLS6='';
			}
		}
		else
		{
			//Requete vide
			$SQLS6='';
		}
		if(isset($_POST['cb_etat']))
		{
			if(isset($_POST['id_etat']))
			{
				//Recupere l'indice
				$Etat_Bien=intval($_POST['id_etat']);
				//On forge la requete
				$SQLS3="($WHERE_BIEN_ETAT"."$Etat_Bien)";
			}
			else
			{
				//Requete vide
				$SQLS3='';
			}
		}
		else
		{
			//Requete vide
			$SQLS3='';
		}
		if(isset($_POST['cb_bien']))
		{
			if(isset($_POST['id_bien']))
			{
				//Récupère l'indice
				$Type_Bien=intval($_POST['id_bien']);
				//Met en forme la requete
				$SQLS2="($WHERE_BIEN_TYPE"."$Type_Bien)";
			}
			else
			{
				//Requete vide
				$SQLS2='';
			}
		}
		else
		{
			//Requete vide
			$SQLS2='';
		}
		/*
		On formate la requete et on affiche en fonction des critères
		*/
		$SQLS=$SEL_VUE_MULTI;
		$SQLS.=$SQLS1;
		if(($SQLS1!='')&&($SQLS2!=''))
		{
			$SQLS.=' AND ';
		}
		$SQLS.=$SQLS2;
		
		if(($SQLS3!='')&&(($SQLS1!='')||($SQLS2!='')))
		{
			$SQLS.=' AND ';
		}
		$SQLS.=$SQLS3;
		if(($SQLS4!='')&&(($SQLS1!='')||($SQLS2!='')||($SQLS3!='')))
		{
			$SQLS.=' AND ';
		}
		$SQLS.=$SQLS4;
		if(($SQLS5!='')&&(($SQLS1!='')||($SQLS2!='')||($SQLS3!='')||($SQLS4!='')))
		{
			$SQLS.=' AND ';
		}
		$SQLS.=$SQLS5;
		if(($SQLS6!='')&&(($SQLS1!='')||($SQLS2!='')||($SQLS3!='')||($SQLS4!='')||($SQLS5!='')))
		{
			$SQLS.=' AND ';
		}
		$SQLS.=$SQLS6;
		if(($SQLS7!='')&&(($SQLS1!='')||($SQLS2!='')||($SQLS3!='')||($SQLS4!='')||($SQLS5!='')||($SQLS6!='')))
		{
			$SQLS.=' AND ';
		}
		
		$SQLS.=$SQLS7;
		if($SQLS==$SEL_VUE_MULTI)
		{
			$SQLS=$SEL_BIEN_MULTI_SANS_WHERE;
			$query=$db->sql_query($SQLS);
		}
		else
		{
			$query=$db->sql_fetch_prepared($TabRequete,$SQLS);
		}
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
	