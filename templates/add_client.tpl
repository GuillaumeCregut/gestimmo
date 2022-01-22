<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles/general.css">
    <title>Laurent</title>
	<script src="scripts/add_ach.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="styles/add_client.css">
</head>
<body onload="init()">
	<h1>Cr&eacute;ation d'un&nbsp; client acheteur</h1>
	<form name="add_client" method="post" action="add_ach_sql.php" id="add_client">
	<p><label for="prenom">Pr&eacute;nom: </label><input name="prenom" type="text" id="prenom">
	<span class="tooltip">Un pr&eacute;nom ne peut pas faire moins de 2 caractères</span></p>
	<p><label for="nom">Nom: </label><input name="nom" type="text" id="nom">
	<span class="tooltip">Un nom ne peut pas faire moins de 2 caractères</span></p>
	<p><label for="adresse">Adresse : </label><input name="adresse" type="text" id="adresse"></p>
{literal}
	<p><label for="tel">Num&eacute;ro de t&eacute;l&eacute;phone : </label><input name="tel" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel"></p>
	<p><label for="tel2">Num&eacute;ro de t&eacute;l&eacute;phone 2 : </label><input name="tel2" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" id="tel2"></p>
{/literal}
	<p><label for="mail">adresse Mail :</label><input name="mail" type="email" id="mail"></p>
	<p>Type de recherche</p>
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
	<p><label for="surf_min">Surface minimum (m2) : </label><input name="surf_min" type="text" id="surf_min">
	<span class="tooltip">Surface terrain minimum : 10m2</span></p>
	<p><label for="surf_max">Surface terrain maximum (m2): </label><input name="surf_max" type="text" id="surf_max">
	<span class="tooltip">Veuillez entrer un chiffre, supérieur &agrave la surface minimum</span></p>
	<p><label for="surf_min_h">Surface habitable minimum (m2) : </label><input name="surf_min_h" type="text" id="surf_min_h">
	<span class="tooltip">Surface habitable minimum : 10m2</span></p>
	<p><label for="surf_max_h">Surface habitable maximum (m2): </label><input name="surf_max_h" type="text" id="surf_max_h">
	<span class="tooltip">Veuillez entrer un chiffre, supérieur &agrave la surface minimum</span></p>
	<p><label for="pieces">Nombre de pi&egrave;ces : </label><input name="pieces" type="text" id="pieces">
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="prix_min">Prix minimum: </label><input name="prix_min" type="text" id="prix_min">
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><label for="prix_max">Prix maximum: </label><input name="prix_max" type="text" id="prix_max">
	<span class="tooltip">Veuillez entrer un chiffre, sup&eacute;rieur au prix minimum</span></p>
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
	<p><label for="distance">Distance maximum : </label><input name="dist_max" type="text" id="distance">
	<span class="tooltip">Veuillez entrer un chiffre</span></p>
	<p><input type="submit" value="ajouter"></p>
	</form>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>