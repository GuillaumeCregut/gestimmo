<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/confirm_bien.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/voir_bien.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body onload="init()">
	<h1>Informations sur le bien</h1>
	<p>Propri&eacute;taire : <strong>{$Vendeur}</strong></p>
	<p>Adresse : <strong>{$adresse}</strong></p>
	<p>Ville : <strong>{$ville}</strong></p>
	<p>Type de bien : <strong>{$bien}</strong></p>
	<p>Etat : <strong>{$etat}</strong></p>
	<form name="modif_bien" action="mod_bien.php" method="post" id="modif_bien">
		<div id="infos">
			<div id="liste">
				<input type="hidden" name="id_bien" value="{$id_bien}">
				<p>Surface du terrain : <input type="text" name="Surf" value="{$surf}" id="surf"> m2
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p>Surface habitable : <input type="text" name="Surf_h" value="{$surfh}" id="surf_h"> m2
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p>Nombre de pi&egrave;ces  :  <input type="text" name="pieces" value="{$piece}" id="pieces">
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p>Prix : <input type="text" name="prix" value="{$prix}" id="prix"> euros
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p>Commission : <input type="text" name="commission" value="{$commission}" id="commission"> euros
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p id="vendre_cb"><input type="checkbox" name="vendue" value="1" id="cb_vendre" onclick="alerter()">Bien indisponible ou vendu par un ext&eacute;rieur</p>
			</div>
			<div id="lebouton">
				<p><input type="submit" value="modifier" class="bouton_lien"></p>
			</div>
		</div>
	</form>
	<div id="groupe_boutons">
		<div id="vente_bien" class="grp_btn">
			<form name="vendre_bien" action="vendre.php" method="post" id="vendre">
				<!--<fieldset name="fs1"><legend>Vente</legend> -->
					<input type="hidden" name="id_bien" value="{$id_bien}">
					<p><input type="submit" value="Vendre le bien" class="bouton_lien"></p>
				<!--</fieldset> -->
			</form>
		</div>
		<div class="grp_btn">
			<form name="voir_vendeur" action="voir_vendeur.php" method="post">
				<!--<fieldset name="fs2"><legend>Vendeur</legend> -->
					<input type="hidden" name="id_vendeur" value="{$id_vendeur}">
					<input type="hidden" name="id_bien" value="{$id_bien}">
					<p><input type="submit" value="Voir la fiche vendeur" class="bouton_lien"></p>
				<!--</fieldset> -->
			</form>
		</div>
		<div class="grp_btn">
			<!--<fieldset name="fs3"><legend>Visites</legend> -->
				<p>Il y a eu <strong>{$NbreVisite}</strong> visites de ce bien</p>
				<form name="visite" action="add_visite.php" method="post">
					<input type="hidden" name="id_bien" value="{$id_bien}">
					<p><input type="submit" value="Ajouter une visite" class="bouton_lien"></p>
				</form>
				<form name="voir_visite" action="voir_visite.php" method="post">
					<input type="hidden" name="id_bien" value="{$id_bien}">
					
					<p><input type="submit" value="Voir les visites" class="bouton_lien"></p>
				</form>
			<!--</fieldset> -->
		</div>
	</div>
	<p><a href="affiche_biens.php" class="bouton_lien">Retour &agrave; la liste des biens en vente</a></p>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>