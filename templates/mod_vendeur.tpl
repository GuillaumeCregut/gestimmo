<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
    <title>Gestion immobili&egrave;re</title>
	<script src="scripts/mod_vendeur.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" media="screen" href="styles/add_vendeur.css">
</head>
<body onload="init()">
	<h1>Modification d'un&nbsp; client vendeur</h1>
	<form name="add_client" method="post" action="mod_vend_sql.php" id="mod_vendeur">
		<input type="hidden" name="IdVendeur" value="{$id_vendeur}">
		<p><label for="prenom">Pr&eacute;nom: </label><input name="prenom" type="text" id="prenom" value="{$prenom}">
		<span class="tooltip">Un pr&eacute;nom ne peut pas faire moins de 2 caractères</span></p>
		<p><label for="nom">Nom: </label><input name="nom" type="text" id="nom" value="{$nom}">
		<span class="tooltip">Un nom ne peut pas faire moins de 2 caractères</span></p>
		<p><label for="adresse">Adresse : </label><input name="adresse" type="text" id="adresse" size="80" value="{$adresse}"></p>
		<p><label for="tel">Num&eacute;ro de t&eacute;l&eacute;phone : </label><input name="tel" value="{$tel}" type="tel"{literal} pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel"></p>
	{/literal}
		<p><label for="tel2">Num&eacute;ro de t&eacute;l&eacute;phone 2 : </label><input name="tel2" value="{$tel2}" type="tel"{literal} pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel2"></p>
		{/literal}
		<p><label for="mail">adresse Mail :</label><input name="mail" type="email" id="mail" value="{$mail}"></p>
		<p><input type="submit" value="Modifier"></p>
	</form>
	<p><a href="sel_vendeur.php" class="bouton_lien">Retour &agrave; la liste des vendeurs</a></p>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>