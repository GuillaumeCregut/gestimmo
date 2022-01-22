<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles/general.css">
    <title>Laurent</title>
	<script src="scripts/add_bien.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="styles/add_bien.css">
</head>
<body onload="init()">
	<h1>Cr&eacute;ation d'un&nbsp; bien &agrave; vendre</h1>
	<form name="add_client" method="post" action="add_bien_sql.php" id="add_bien">
	<p><label for="vendeur">Vendeur : </label>
	<select name="vendeur" id="vendeur">
	{if isset ($TabVendeur)}
{foreach from=$TabVendeur item=infos1}
		<option value="{$infos1.id_vendeur}">{$infos1.nom_vendeur}</option>
{/foreach}
{else}
		<option value="0">Aucun nom</option>
{/if}
	</select>
	<p>Informations sur le bien</p>
	<p><label for="Adresse">Adresse du bien (sans la ville) : </label><input type="text" name="Adresse" id="Adresse"></p>
	<p><label for="typebien">type de bien :</label>
	<select name="TypeMaison" id="typebien">
{if isset ($TabBien)}
{foreach from=$TabBien item=infos}
		<option value="{$infos.id_bien}">{$infos.nom_bien}</option>
{/foreach}
{else}
		<option value="0">Aucun bien</option>
{/if}
	</select></p>
	<p><label for="etat">Etat du lieu :</label>
	<select name="etat" id="etat">
{if isset ($TabEtat)}
{foreach from=$TabEtat item=infos3}
		<option value="{$infos3.id_etat}">{$infos3.nom_etat}</option>
{/foreach}
{else}		
		<option value="0">Aucune donn&eacute;es</option>
{/if}			
	</select></p>	
	<p><label for="surf_ter">Surface du terrain (m2) : </label><input name="surf_ter" type="text" id="surf_ter">
	<span class="tooltip">Surface minimum : 10m2</span></p>
	<p><label for="surf_hab">Surface habitable (m2) : </label><input name="surf_hab" type="text" id="surf_hab">
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="prix_bien">Prix : </label><input name="prix_bien" type="text" id="prix_bien"> euros
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="pieces">Commission : </label><input name="commission" type="text" id="commission"> euros
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="pieces">Nombre de pi&egrave;ces: </label><input name="pieces" type="text" id="pieces">
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="ville">Ville : </label>
	<select name="ville" id="ville">
{if isset ($TabVille)}
{foreach from=$TabVille item=infos2}
		<option value="{$infos2.id_ville}">{$infos2.nom_ville}</option>
{/foreach}
{else}		
		<option value="0">Aucune ville</option>
{/if}		
	</select></p>
	<p><input type="submit" value="ajouter" id="bouton" class="bouton_lien"></p>
	</form>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>