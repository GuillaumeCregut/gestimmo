<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_fiche_ach.php  							 *
 * Date création :	27/06/2018										 *
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
	//Connexion à la base de données
	$db= new connect_base($serveur,$database,$username,$password);
	if(is_null($db->connect_id))
	{
		$moteur->display($CheminTpl.'erreurbdd.tpl');
	}
	else
	{
		if (isset($_POST['id_Acheteur']))
		{
			$Id_Acheteur=intval($_POST['id_Acheteur']);
			if(is_int($Id_Acheteur))
			{
				$SQLS=$SEL_ACHETEUR_FULL." WHERE pk_acheteur=$Id_Acheteur";
				$query=$db->sql_query($SQLS);
				$row=$db->sql_fetchrow($query);
				if(isset($row))
				{
					$moteur->assign('id_acheteur',$row['pk_acheteur']);
					$Id_Acheteur=$row['pk_acheteur'];//On évite, au cas ou, un souci avec une valeur injectée
					$moteur->assign('prenom',$row['prenom']);
					$moteur->assign('nom',$row['nom']);
					$moteur->assign('bien',$row['nom_bien']);
					$moteur->assign('etat',$row['nom_etat']);
					$moteur->assign('dist_max',$row['dist_max']);
					$moteur->assign('ville',$row['nom_ville']);
					$moteur->assign('S_min',$row['surf_mini']);
					$moteur->assign('S_max',$row['surf_maxi']);
					$moteur->assign('SH_min',$row['Surf_Hab_min']);
					$moteur->assign('SH_max',$row['Surf_Hab_Max']);
					$moteur->assign('pieces',$row['Nbre_Pieces']);
					$moteur->assign('p_min',$row['prix_mini']);
					$moteur->assign('p_max',$row['prix_maxi']);
					$moteur->assign('mail',$row['mail']);
					$moteur->assign('tel',$row['tel']);
					$moteur->assign('tel2',$row['tel2']);
					//On continu avec les recherches "matchantes"
					//0 On récupère les critères de l'acheteur :
					$SQLS=$SEL_INFOS_BIEN_ACHETEUR.$Id_Acheteur;
					$query=$db->sql_query($SQLS);
					$TabAcheteur=$db->sql_fetchrow($query);
					//Recherche des biens correspondant à la recherche
				//1 La surface
					//Création du tableau préparé
					$ArraySurf= array(':a'=>$TabAcheteur['surf_mini'],':b'=>$TabAcheteur['surf_maxi']); 
					//Formattage de la requete
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_SURF;
					$query=$db->sql_fetch_prepared($ArraySurf,$SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_Surface=$row['nbre'];
					$moteur->assign('Cpte_Surf',$Compte_Surface);
				//2 Le type de bien
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_TYPE.$TabAcheteur['fk_type_bien'];
					$query=$db->sql_query($SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_Type=$row['nbre'];
					$moteur->assign('Cpte_Type',$Compte_Type);
				//3 Etat du bien
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_ETAT.$TabAcheteur['fk_etat_lieux'];
					$query=$db->sql_query($SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_Etat=$row['nbre'];
					$moteur->assign('Cpte_Etat',$Compte_Etat);
				//4 Distance du bien
					//On récupère les distances dans la table
					$CompteVille=0;
					$Id_Ville=$TabAcheteur['fk_ville'];
					$SQLS=SEL_TABLEAU_VILLE($Id_Ville);
					$query=$db->sql_query($SQLS);
					$i=0;
					while($row=$db->sql_fetchrow($query))
					{
						if($row['distance']<=$TabAcheteur['dist_max'])
						{
							if($row['fk_ville1']!=$Id_Ville)
							{
								$TabDist[$i]['Pk_Villes']=$row['fk_ville1'];
							}
							else
							{
								$TabDist[$i]['Pk_Villes']=$row['fk_ville2'];
							}
							$TabDist[$i]['Distance']=$row['distance'];
							$i++;
						}					
					}
					if(isset($TabDist))
					{
						//Création du tableau préparé
						$moteur->assign('Cpte_Ville',$i);
						//$TabAcheteur['dist_max'] $TabAcheteur['fk_ville'] 
						//Formattage de la requete
						for($j=0;$j<sizeof($TabDist);$j++)
						{
							$PK_Ville=$TabDist[$j]['Pk_Villes'];
							$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_VILLE.$PK_Ville;
							//Pour chaque villes voisines ont execute la requete
							$query=$db->sql_query($SQLS);
							$row=$db->sql_fetchrow($query);
							$CompteVille+=intval($row['nbre']);
						}
						$moteur->assign('Cpte_Ville',$CompteVille); //temporaire
					}
					//On selectionne aussi le nombre de biens dans la ville elle même
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_VILLE.$Id_Ville;
					$query=$db->sql_query($SQLS);
					$row=$db->sql_fetchrow($query);
					$CompteVille+=intval($row['nbre']);
					$moteur->assign('Cpte_Ville',$CompteVille);
				//5 Surface habitable
					//Création du tableau préparé
					$ArraySurfH= array(':c'=>$TabAcheteur['Surf_Hab_min'],':d'=>$TabAcheteur['Surf_Hab_Max']); 
					//Formattage de la requete
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_SURF_H;
					$query=$db->sql_fetch_prepared($ArraySurfH,$SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_SurfaceH=$row['nbre'];
					$moteur->assign('Cpte_SurfH',$Compte_SurfaceH);
				//6 Prix
					//Création du tableau préparé
					$ArrayPrix= array(':e'=>$TabAcheteur['prix_mini'],':f'=>$TabAcheteur['prix_maxi']); 
					//Formattage de la requete
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_PRIX;
					$query=$db->sql_fetch_prepared($ArrayPrix,$SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_Prix=$row['nbre'];
					$moteur->assign('Cpte_Prix',$Compte_Prix);
				//7 Nbre de pieces
					$Pieces_min=$TabAcheteur['Nbre_Pieces']-$Variable_Piece;
					$Pieces_max=$TabAcheteur['Nbre_Pieces']+$Variable_Piece;
					//Création du tableau préparé
					$ArrayPieces= array(':g'=>$Pieces_min,':h'=>$Pieces_max); 
					//Formattage de la requete
					$SQLS=$SEL_BASE_COUNT_BIEN.$WHERE_BIEN_PIECES;
					$query=$db->sql_fetch_prepared($ArrayPieces,$SQLS);
					$row=$db->sql_fetchrow($query);
					$Compte_Pieces=$row['nbre'];
					$moteur->assign('Cpte_Pieces',$Compte_Pieces);
					
					//Fin
					//On récupère la liste des visites
					//Selectionne le nombre de visites de ce bien
					$db2= new connect_base($serveur,$database,$username,$password);
					//On est sur que la connexion est OK
					$query2=$db2->sql_query($SEL_NBRE_VISITE_ACHETEUR.$Id_Acheteur);
					$row2=$db2->sql_fetchrow($query2);
					$Nbrevisite=0;
					if(isset($row2['nbre']))
					{
						$Nbrevisite=$row2['nbre'];
					}
					$moteur->assign('NbreVisite',$Nbrevisite);
					//On affiche la page
					$moteur->display($CheminTpl.'voir_fiche_ach.tpl');
				}
				else
				{
					//Il n'y a pas de valeur dans la base
					$moteur->assign('Erreur',"L'acheteur n'existe pas");
					$moteur->display($CheminTpl.'erreur.tpl');
					die();
				}
				
			}//Si la valeur transmise n'est pas un entier (clé primaire)
			else
			{
				//La valeur transmise est fausse
				$moteur->assign('Erreur',"Mauvaise valeur pour l'acheteur");
				$moteur->display($CheminTpl.'erreur.tpl');
				die();
			}
		}
		else
		{
			//Pas de valeur POST
			$moteur->assign('Erreur','Valeur transmise erron&eacute;e');
				$moteur->display($CheminTpl.'erreur.tpl');
				die();
		}
	}
	
?>