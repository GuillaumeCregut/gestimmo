<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Modification d'une ville</h1>
	<div id="corps">
		<form name="mod_distance" action="#" method="post" id="mod_distance">
		<table>
			<tbody>
			<tr>
				<th>&nbsp;</th>
				<th>Nom de la ville</th>
			</tr>
	{if isset($TabVille)}
	{foreach from=$TabVille item=infos}
			<tr>
				<td><input type="radio" name="id_ville" value="{$infos.id_ville}"></td>
				<td>{$infos.nom_ville}</td>
			<td>
			</tr>
	{/foreach}
	{/if}		
			</tbody>
		</table>
		<p><input name="Valider" value="Modifier" type="submit" class="bouton_lien"></p>
		</form>
	</div>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>