<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/voir_acheteur.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/fiche_acheteur.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
		<h1>Consultation de la fiche</h1>
	<div id="coord">
		<p>Nom : <strong>{$nom}</strong></p>
		<p>Prénom : <strong>{$prenom}</strong></p>
		<p>Num&eacute;ro de t&eacute;l&eacute;phone : <strong>{$tel}</strong></p>
		<p>Num&eacute;ro de t&eacute;l&eacute;phone 2 : <strong>{$tel2}</strong></p>
		<p>Adresse mail : <strong>{$mail}</strong></p>
	</div>
	<p class="souligne">Critères de recherche :</p>
	<div id="rech">	
		<p>Type de bien : <strong>{$bien}</strong></p>
		<p>Surface : entre <strong>{$S_min} et {$S_max}</strong> m2</p>
		<p>Surface habitable : entre <strong>{$SH_min} et {$SH_max}</strong> m2</p>
		<p>Nombre de pièces : <strong>{$pieces}</strong></p>
		<p>Etat : <strong>{$etat}</strong> </p>
		<p>A <strong>{$dist_max}</strong> km de <strong>{$ville}</strong></p>
		<p>Prix : entre <strong>{$p_min} et {$p_max}</strong> euros</p>
	</div>
	<p class="souligne">Rapprochement :</p>
	<div>
		<form name="form_rech_bien_acheteur" id="form_rech_bien_acheteur" action="rech_bien_acheteur.php" method="post">
			<input type="hidden" name="id_acheteur" value="{$id_acheteur}">
			<p><input type="checkbox" name="surface" value="1">{$Cpte_Surf} biens matchs pour la surface</p>
			<p><input type="checkbox" name="type_bien" value="1">{$Cpte_Type} biens matchs pour le type de bien</p>
			<p><input type="checkbox" name="etat" value="1">{$Cpte_Etat} biens matchs pour l'&eacute;tat du bien</p>
			<p><input type="checkbox" name="surf_h" value="1">{$Cpte_SurfH} biens matchs pour la surface habitable</p>
			<p><input type="checkbox" name="pieces" value="1">{$Cpte_Pieces} biens matchs pour le nombre de pièces</p>
			<p><input type="checkbox" name="ville" value="1">{$Cpte_Ville} biens matchs pour la ville*</p>
			<p><input type="checkbox" name="prix" value="1">{$Cpte_Prix} biens matchs pour le prix</p>
			<p><input type="submit" value="Voir les biens correspondants" class="bouton_lien"></p>
		</form>
	</div>
	<div>
		<form name="voir_visite" action="voir_visite.php" method="post">
			<input type="hidden" name="id_acheteur" value="{$id_acheteur}">
			<p>IL y a eu <strong>{$NbreVisite}</strong> visites avec cet acheteur</p>
			<p><input type="submit" value="Voir les visites" class="bouton_lien"></p>
		</form>
	</div>
	<div>
		<form name="voir_visite" action="add_visite_client.php" method="post">
			<input type="hidden" name="id_acheteur" value="{$id_acheteur}">
			<p><input type="submit" value="Ajouter une visite" class="bouton_lien"></p>
		</form>
	</div>
	<p><a href="voir_acheteur.php" class="bouton_lien">Retour &agrave; la page pr&eacute;c&eacute;dente</a></p>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>