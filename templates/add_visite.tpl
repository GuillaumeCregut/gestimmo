<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Visite d'un bien immobilier</h1>
	<p class="souligne">Bien selectionn&eacute; :</p>
	<p>{$type_bien}, {$Etat_bien}  situ&eacute;e {$Adresse}, {$Ville} et vendu par {$NomVendeur} au prix de {$Prix} euros.</p>
	<p class="souligne">Selectionnez l'acheteur</p>
	<form name="vendre" id="vendre" method="post" action="add_visite_sql.php">
		<input type="hidden" name="id_bien" value="{$id_bien}">
		<p><select name="acheteur" id="acheteur">
		<option value="0">--</option>
{if isset($TabAcheteur)}
{foreach from=$TabAcheteur item=infos}
		<option value="{$infos.id_acheteur}">{$infos.nom_acheteur}</option>
{/foreach}
{/if}		
		</select>
		<p>Date de la visite :<input type="date" name="ladate" value="{$dateV}"></p>
		<p>Commentaires :</p>
		<textarea name="commentaire"></textarea>
		<p><input type="submit" value="Ajouter" class="bouton_lien"></p>
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>