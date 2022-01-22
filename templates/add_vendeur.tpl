<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
    <title>Gestion immobili&egrave;re</title>
	<script src="scripts/add_vendeur.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" media="screen" href="styles/add_vendeur.css">
</head>
<body onload="init()">
	<div id="corps">
		<h1>Cr&eacute;ation d'un&nbsp; client vendeur</h1>
		<form name="add_client" method="post" action="add_vend_sql.php" id="add_client">
		<p><label for="prenom">Pr&eacute;nom: </label><input name="prenom" type="text" id="prenom">
		<span class="tooltip">Un pr&eacute;nom ne peut pas faire moins de 2 caractères</span></p>
		<p><label for="nom">Nom: </label><input name="nom" type="text" id="nom">
		<span class="tooltip">Un nom ne peut pas faire moins de 2 caractères</span></p>
		<p><label for="adresse">Adresse : </label><input name="adresse" type="text" id="adresse" size="80"></p>
	{literal}
		<p><label for="tel">Num&eacute;ro de t&eacute;l&eacute;phone : </label><input name="tel" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel"> (ex : 0102030405)</p>
		<p><label for="tel2">Num&eacute;ro de t&eacute;l&eacute;phone : </label><input name="tel2" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel2"></p>
	{/literal}
		<p><label for="mail">adresse Mail :</label><input name="mail" type="email" id="mail"></p>
		<p><input type="submit" value="ajouter" id="monBouton"  class="bouton_lien"></p>
		</form>
	</div>	
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>