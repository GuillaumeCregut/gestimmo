<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<script src="scripts/modif_ville.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/modif_ville.css">
    <title>Gestion immobilière</title>
</head>
<body onload="getVilles()">
	<h1>Modifier les distances de la ville : {$NomVille}</h1>
	<div id="corps">
		<div id="part1">
			<p class="titre">Distance par rapport &agrave; la ville</p>
			<form name="modif_distance" action="modif_distance_sql.php" method="post" id="modif_distance">
				{if isset($TabVille)}
				{foreach from=$TabVille item=infos}
				<p><input type="hidden" name="ListeVille[]" value="{$infos.Pk_Villes}">{$infos.Nom_Ville} : <input name="idligne[{$infos.id_ligne}]" type="text" value="{$infos.Distance}" onkeyup="Check_value(this)"> km
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				{/foreach}
				{/if}
				<input type="hidden" name="NomVille" value="{$NomVille}">
				<p><input type="submit" value="Modifier"  class="bouton_lien"></p>
			</form>
		</div>
		<div id="part2">
			<form name="add_distance" action="add_distance.php" method="post" id="New_Villes">
				<input type="hidden" name="Id_Ville" value="{$VilleRef}">
				<input type="hidden" name="NomVille" value="{$NomVille}">
				<p class="titre">Ajouter une nouvelle information</p>
				<p><select name="ville[0]" id="liste_ville" onclick="test_ville(this)">
				<option value="0">--</option>
				{if isset($TabVilles)}
				{foreach from=$TabVilles item=infos2}
				<option value="{$infos2.id_ville}">{$infos2.nom_ville}</option>
				{/foreach}
				{/if}
				</select> <input type="text" name="distance[0]" id="distance" onkeyup="Check_value(this)"> km
				<span class="tooltip">Veuillez entrer un chiffre</span></p>
				<p id="AvantMoi"><input type="button" value="Ajouter une ville" onclick="newVille()"></p>
				<p><input type="submit" value="Valider"  class="bouton_lien"></p>
			</form>
		</div>
	</div>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>