<?php
//Page ajout acheteur
	$SEL_VILLE="SELECT pk_ville, nom_ville FROM t_ville ORDER BY nom_ville";
	$SEL_ETAT="SELECT id_etat,nom_etat FROM etat_bien ORDER BY nom_etat";
	$SEL_TYPE="SELECT pk_bien, nom_bien FROM type_bien ORDER BY nom_bien";
	$ADD_ACHETEUR="CALL P_Add_Acheteur(:el,:tb,:fv,:tel,:mail,:nom,:prenom,:p_min,:p_max,:s_min,:s_max,:ad,:dist)";
	$SEL_VUE_ACHETEUR="SELECT nom, prenom, tel, mail, adresse, dist_max, prix_mini, prix_maxi, surf_mini, surf_maxi, nom_etat, nom_bien, nom_ville FROM vue_acheteur"
?>