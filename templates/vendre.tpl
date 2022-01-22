<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/vendre.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/vendre.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body onload="init()">
	<h1>Vente d'un bien immobilier</h1>
	<p>Bien selectionn&eacute; :</p>
	<p>{$type_bien}, {$Etat_bien} d'une surface habitable de {$Surf_Hab}m2, sur un terrain de {$Surf_Terr} m2, disposant de {$Nbre_pieces} pi&egrave;ces, situ&eacute;e {$Adresse}, {$Ville} et vendu par {$NomVendeur} au prix de {$Prix} euros.</p>
	<p>Selectionnez l'acheteur</p>
	<form name="vendre" id="vendre" method="post" action="vente.php">
		<input type="hidden" name="id_bien" value="{$id_bien}">
		<p><select name="acheteur" id="acheteur">
		<option value="0">--</option>
{if isset($TabAcheteur)}
{foreach from=$TabAcheteur item=infos}
		<option value="{$infos.id_acheteur}">{$infos.nom_acheteur}</option>
{/foreach}
{/if}		
		</select>
		<p>Prix de vente final (vendeur) : <input type="text" name="pvente" id="pvente" value="{$Prix}" onkeyup="verif(this)"> euros
		<span class="tooltip">Veuillez entrer un chiffre</span></p>
		<p>Commission finale : <input type="text" name="commission" id="com" value="{$commission}" onkeyup="verif(this)"> euros
		<span class="tooltip">Veuillez entrer un chiffre</span></p>
		<p>Date de la vente :<input type="date" name="ladate" value="{$dateV}"></p>
		<p><input type="submit" value="Vendre" class="bouton_lien"></p>
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>