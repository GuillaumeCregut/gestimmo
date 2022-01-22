<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<script src="scripts/add_ville.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/modif_ville.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body onload="init()">
	<div id="corps">
		<h1>Nouvelle ville</h1>
		<form name="ajout_ville" action="add_ville_sql.php" method="post" id="ajout_ville">
		<p>Nom de la Ville :<input name="NlleVille" type="text"></p>
		<p>Distance par rapport &agrave; la ville</p>
		{if isset($TabVille)}
		{foreach from=$TabVille item=infos}
		<p>{$infos.nom_ville} : <input name="idville[{$infos.id_ville}]" type="text" onkeyup="Check_value(this)"> km
		<span class="tooltip">Veuillez entrer un chiffre</span></p>
		{/foreach}
		{/if}
		<p><input name="Valider" value="Valider" type="submit" class="bouton_lien"></p>
		</form>
		<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	</div>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>