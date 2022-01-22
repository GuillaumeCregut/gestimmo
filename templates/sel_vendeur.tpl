<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Modifier un vendeur</h1>
	<p class="souligne">Selectionnez un vendeur</p>
	<div id="corps">
		<form name="voir_vend" action="voir_vendeur.php" method="post">
			{if isset($TabVendeur)}
			{foreach from=$TabVendeur item=infos}
				<p><input type="radio" name="id_vendeur" value="{$infos.id_vendeur}">{$infos.nom_vendeur}</p>
			{/foreach}
			{/if}	
			<p><input type="submit" value="Selectionner" class="bouton_lien"></p>
		</form>
	</div>	
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>