<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Vente du bien</h1>
	<p>{$ResultVente}.</p>
	{if isset($EtatBien)}
	<p>{$EtatBien}.</p>
	{/if}
	{if isset($EtatAch)}
	<p>{$EtatAch}.</p>
	{/if}
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>