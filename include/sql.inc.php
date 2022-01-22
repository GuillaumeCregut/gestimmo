<?php
//Page ajout acheteur, modif_ville
	$SEL_VILLE="SELECT pk_ville, nom_ville FROM t_ville ORDER BY nom_ville";
//Page ajout acheteur	
	$SEL_ETAT="SELECT id_etat,nom_etat FROM etat_bien ORDER BY nom_etat";
	$SEL_TYPE="SELECT pk_bien, nom_bien FROM type_bien ORDER BY nom_bien";
	$ADD_ACHETEUR="CALL P_Add_Acheteur(:el,:tb,:fv,:tel,:mail,:nom,:prenom,:p_min,:p_max,:s_min,:s_max,:ad,:dist,:sh_min,:sh_max,:nb_p,:tel2)";
	$SEL_VUE_ACHETEUR="SELECT nom, prenom, tel,tel2, mail, adresse, dist_max, prix_mini, prix_maxi, surf_mini, surf_maxi, nom_etat, nom_bien, nom_ville FROM vue_acheteur";
//Page ajout vendeur
	$ADD_VENDEUR="CALL P_Add_Vendeur(:tel,:mail,:nom,:prenom,:ad,:tel2)";
//Page Bien
	$ADD_BIEN="CALL P_Add_Bien(:px, :vendeur, :s_ter, :fk_ville, :s_hab, :nbre_p, :etat,:type_bien,:adr,:com)";
	$SEL_VENDEUR='SELECT pk_vendeur, nom, prenom FROM vendeur ORDER BY nom';
//Page affichage des biens en vente
	$SEL_BIENS_VENTE="SELECT id_bien,fk_vendeur,prix,surface_habitable,surface_terrain,Nbre_pieces,nom_ville,commission,nom_etat,nom_bien,nom,prenom,Adresse FROM vue_bien_a_vendre ORDER BY fk_vendeur";
//Requete récupérant les infos de l'acheteur mises en forme, sans données de contact (ad mail, tel, adresse, etc...)
	$SEL_ACHETEUR_FULL="SELECT pk_acheteur,nom, prenom,mail, tel, tel2, dist_max, prix_mini, prix_maxi, surf_mini, surf_maxi,Surf_Hab_Max,Surf_Hab_min,Nbre_Pieces, nom_etat, nom_bien, nom_ville FROM vue_acheteur_sans_contact";
//Requete permettant de recupérer les données d'un acheteur pour matcher un bien
	$SEL_INFOS_BIEN_ACHETEUR='SELECT  fk_etat_lieux, fk_type_bien, fk_ville, prix_mini, prix_maxi, surf_mini, surf_maxi, dist_max, Surf_Hab_min, Surf_Hab_Max, Nbre_Pieces FROM acheteur WHERE pk_acheteur=';
//Base requete pour selection match
	$SEL_BASE_COUNT_BIEN='SELECT count(*) AS nbre FROM t_bien WHERE vendue=0 AND';
	$WHERE_BIEN_ETAT=" fk_Etat=";
	$WHERE_BIEN_TYPE=" fk_type=";
	$WHERE_BIEN_SURF=" surface_terrain BETWEEN :a AND :b";
	$WHERE_BIEN_SURF_H=" surface_habitable BETWEEN :c AND :d";
	$WHERE_BIEN_PRIX=" prix+commission BETWEEN :e AND :f";
	$WHERE_BIEN_VILLE=" fk_ville=";
	$WHERE_BIEN_PIECES=" Nbre_pieces BETWEEN :g AND :h";
//Recherche des critères d'un acheteur
	$SEL_CRITERES_ACHETEUR="SELECT fk_etat_lieux, fk_type_bien, fk_ville, prix_mini, prix_maxi, surf_mini, surf_maxi, dist_max, Surf_Hab_min, Surf_Hab_Max, Nbre_Pieces FROM acheteur WHERE pk_acheteur=";
//Recherche le bien dans la vue mutlicritère
	$SEL_VUE_MULTI="SELECT id_bien, commission, prix, surface_terrain, surface_habitable, Nbre_pieces, nom, prenom, nom_ville, nom_bien,nom_etat FROM vue_biens_multicriteres WHERE ";
//Ajoute une ville à la base
	$AddVille="INSERT INTO t_ville (nom_ville) VALUES(:nomville)";
	$AddDistance="CALL P_Add_Distances(:vil1,:vil2,:dist)";
//Modification ville
	$SEL_VILLE_NAME="SELECT pk_ville, nom_ville FROM t_ville WHERE pk_ville=";
//Requete parametrée
	function SEL_TABLEAU_VILLE($id_ville)
	{
		return "select id_ligne,fk_ville1, fk_ville2, distance,nom_ville1,nomville2 FROM Vue_Distances_Villes WHERE ((fk_ville1= $id_ville ) OR (fk_ville2= $id_ville ))";
	}	
//Modification des distances
	$MOD_DISTANCES="CALL P_Mod_Distance(:a,:b)";
//Selection d'un bien
	$SEL_BIEN_FULL="SELECT id_bien,commission, nom, prenom, nom_ville, prix, surface_terrain, surface_habitable, Nbre_pieces, Adresse, nom_etat, nom_bien,pk_vendeur  FROM vue_Bien_full WHERE id_bien=";
//Modification du prix d'un bien
	$MOD_PRIX_BIEN="CALL P_Mod_Prix_Bien(:a, :b, :c, :d, :e, :f)";
//Modification de l'état vendu du bien
	$MOD_VENDU_BIEN="CALL P_Mod_Vente(:a)";
//Selectionne un bien par son ID
	$SEL_BIEN_VENDRE="SELECT id_bien,prix,commission,surface_habitable,surface_terrain,Nbre_pieces,nom_ville,nom_etat,nom_bien,nom,prenom,Adresse FROM vue_bien_full WHERE id_bien=";
//Selectionne un acheteur pour la vente
	$SEL_ACHETEUR_VENTE="SELECT pk_acheteur, nom, prenom FROM acheteur ORDER BY nom, prenom";
//Pour la vente
	$SEL_NBRE_BIEN="SELECT count(*) AS nbre FROM t_bien WHERE id_bien=";
	$SEL_NBRE_ACHETEUR="SELECT count(*) AS nbre FROM acheteur WHERE pk_acheteur=";
	$ADD_VENTE="CALL P_Add_Vente(:bien,:acheteur,:prix,:com,:datev)";
	$MOD_SERT_ACHETEUR="CALL P_Sert_Acheteur(:a)";
//Selectionne les valeurs d'un vendeur
	$SEL_VENDEUR_FULL="SELECT tel,tel2, mail, nom, prenom, adresse FROM vendeur WHERE pk_vendeur=:a";
//Modification d'un vendeur
	$MOD_VENDEUR="CALL P_Mod_Vendeur(:a,:b,:c,:d,:e,:f,:g)";
//Récupération des infos de l'acheteur
	$SEL_ACHETEUR_TABLE="SELECT fk_etat_lieux, fk_type_bien, fk_ville, tel,tel2, mail, nom, prenom, prix_mini, prix_maxi, surf_mini, surf_maxi, adresse, dist_max, Surf_Hab_min, Surf_Hab_Max, Nbre_Pieces FROM acheteur WHERE pk_acheteur=:a";
//Modification d'un acheteur
	$MOD_ACHETEUR="CALL Mod_Acheteur(:id,:etat,:bien,:ville,:tel,:lemail,:px_min,:px_max,:s_min,:s_max,:ad,:dist,:sh_min,:sh_max,:pieces,:tel2)";
//Compte les biens en vente d'un vendeur
	$SEL_COMPTE_BIEN_VENDEUR="SELECT count(*) AS nbre FROM t_bien WHERE vendue=0 and fk_vendeur=:a";
//Récupère les valeurs des biens pour un vendeur
	$SEL_BIEN_VENDEUR="SELECT id_bien, prix, surface_habitable, surface_terrain, Nbre_pieces, Adresse, nom_ville, commission, nom_etat, nom_bien, nom, prenom FROM vue_bien_full WHERE pk_vendeur=:a";
	$SEL_BIEN_MULTI_SANS_WHERE="SELECT id_bien, commission, prix, surface_terrain, surface_habitable, Nbre_pieces, nom, prenom, nom_ville, nom_bien,nom_etat FROM vue_biens_multicriteres";
//Insertion d'une visite
	$ADD_VISITE="CALL P_Add_Visite(:client,:bien,:ladate,:lecomm)";
//Nombre de visite pour ce bien
	$SEL_NBRE_VISITE_BIEN="SELECT count(*) as nbre FROM t_visite WHERE  fk_bien=";
//Nombre de visite pour cet acheteur
	$SEL_NBRE_VISITE_ACHETEUR="SELECT count(*) as nbre FROM t_visite WHERE  fk_client=";
//Selection d'une entrée dans la vue visite
	$SEL_VUE_VISITE="SELECT pk_visite, fk_client, fk_bien, date_visite, comm, adresse, prix, commission, nom, prenom, nom_etat, nom_ville, nom_bien, ven_nom, ven_prenom FROM vue_visite";
//Clauses WHERE pour la vue visite
	$WHERE_VISITE_BIEN=" WHERE fk_bien= :a";
	$WHERE_VISITE_ACHETEUR=" WHERE fk_client= :a";
?>