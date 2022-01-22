<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	index.php  										 *
 * Date création :	28/06/2018										 *
 * Date Modification :	01/07/2018									 *
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
	//Récupérations des données POST Attention, manque critère ville pour le moment !!
	if(isset($_POST['id_acheteur']))
	{
		$Id_Acheteur=intval($_POST['id_acheteur']);
		if(is_int($Id_Acheteur))
		{
			//On reprend les critères de recherche de l'acheteur correspondant
			$SQLS=$SEL_CRITERES_ACHETEUR.$Id_Acheteur;
			//Connexion à la base de données
			$db= new connect_base($serveur,$database,$username,$password);
			if(is_null($db->connect_id))
			{
				$moteur->display($CheminTpl.'erreurbdd.tpl');
			}
			else
			{
				$query=$db->sql_query($SQLS);
				$row=$db->sql_fetchrow($query);
				if(isset($row))
				{
					$Type_Bien=$row['fk_type_bien'];
					$Etat_Bien=$row['fk_etat_lieux'];
					$Prix_Mini=$row['prix_mini'];
					$Prix_Maxi=$row['prix_maxi'];
					$Surf_Mini=$row['surf_mini'];
					$Surf_Maxi=$row['surf_maxi'];
					$SurfH_Mini=$row['Surf_Hab_min'];
					$SurfH_Maxi=$row['Surf_Hab_Max'];
					$NombrePiece_Mini=$row['Nbre_Pieces']-$Variable_Piece;
					$NombrePiece_Maxi=$row['Nbre_Pieces']+$Variable_Piece;
					$Ville=$row['fk_ville'];
					$Distance=$row['dist_max'];
					$TabRequete=array();
					$Separateur='';
					//On formate la requete SQL
					$SQLS=$SEL_VUE_MULTI;
					//Surfaces
					if(isset($_POST['surface']))
					{
						//On forge la requete
						$SQLS1="($WHERE_BIEN_SURF)";
						$TabRequete[':a']=$Surf_Mini;
						$TabRequete[':b']=$Surf_Maxi;
					}
					else
						$SQLS1='';
					//Type Bien
					if(isset($_POST['type_bien']))
					{
						//On forge la requete
						$SQLS2="($WHERE_BIEN_TYPE"."$Type_Bien)";
					}
					else
						$SQLS2='';
					//Etat
					if(isset($_POST['etat']))
					{
						//On forge la requete
						$SQLS3="($WHERE_BIEN_ETAT"."$Etat_Bien)";
					}
					else
						$SQLS3='';
					//Surface habitable
					if(isset($_POST['surf_h']))
					{
						//On forge la requete
						$SQLS4="($WHERE_BIEN_SURF_H)";
						$TabRequete[':c']=$SurfH_Mini;
						$TabRequete[':d']=$SurfH_Maxi;
					}
					else
						$SQLS4='';
					//Pieces
					if(isset($_POST['pieces']))
					{
						//On forge la requete
						$SQLS5="($WHERE_BIEN_PIECES)";
						$TabRequete[':g']=$NombrePiece_Mini;
						$TabRequete[':h']=$NombrePiece_Maxi;
					}
					else
						$SQLS5='';
					//Prix
					if(isset($_POST['prix']))
					{
						//On forge la requete
						$SQLS7="($WHERE_BIEN_PRIX)";
						$TabRequete[':e']=$Prix_Mini;
						$TabRequete[':f']=$Prix_Maxi;
					}
					else
						$SQLS7='';
					if(isset($_POST['ville']))
					{
						//On récupères les clés des villes correspondantes
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
						//On forge la requete
					}
					else
					{
						$SQLS6='';
					}
					//Formatage de sql
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
					//On recherche les biens  dans la vue vue_biens_multicriteres en fonction des critères demandés
					$query=$db->sql_fetch_prepared($TabRequete,$SQLS);
					$i=0;
					while($row=$db->sql_fetchrow($query))
					{
						$TabBiens[$i]['id_bien']=$row['id_bien'];
						$TabBiens[$i]['Prix']=$row['prix'];
						$TabBiens[$i]['Surf_Terr']=$row['surface_terrain'];
						$TabBiens[$i]['Surf_Hab']=$row['surface_habitable'];
						$TabBiens[$i]['Nbre_pieces']=$row['Nbre_pieces'];
						$Vendeur=$row['prenom'].' '.$row['nom'];
						$TabBiens[$i]['NomVendeur']=$Vendeur;
						$TabBiens[$i]['Ville']=$row['nom_ville'];
						$TabBiens[$i]['Etat_bien']=$row['nom_etat'];
						$TabBiens[$i]['type_bien']=$row['nom_bien'];
						$TabBiens[$i]['commission']=$row['commission'];
						$i++;
					}
					if(isset($TabBiens))
					{
						$moteur->assign('TabBien',$TabBiens);
					}
					$moteur->display($CheminTpl.'rech_bien_acheteur.tpl');
				}//Fin il y a bien un acheteur selectionné
				else
				{
					//Il n'y pas pas d'acheteur dans la base
					$moteur->assign('Erreur',"l'acheteur n'existe pas");
					$moteur->display($CheminTpl.'erreur_rech.tpl');
				}
			}//Fin BDD OK
		}
		else
		{
			//Mauvaise valeur dans le post
			$moteur->assign('Erreur','Valeurs transmises non coh&eacute;rentes');
			$moteur->display($CheminTpl.'erreur_rech.tpl');
		}
	}//Fin if POST défini
	else
	{
		//Pas de POST
		$moteur->assign('Erreur','Aucun crit&egrave;re de recherche');
		$moteur->display($CheminTpl.'erreur_rech.tpl');
	}
?>