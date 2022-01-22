<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
    <title>Laurent</title>
</head>
<body>
	<h1>Cr&eacute;ation d'un&nbsp; client acheteur</h1>
	<form name="add_client" method="post" action="add_ach_sql.php">
	<p>Pr&eacute;nom: <input name="prenom" type="text"></p>
	<p>Nom: <input name="nom" type="text"></p>
	<p>Adresse : <input name="adresse" type="text"></p>
	<p>Num&eacute;ro de t&eacute;l&eacute;phone : <input name="tel" type="text"></p>
	<p>adresse Mail :<input name="mail" type="text"></p>
	<p>Type de recherche</p>
	<p>type de bien :
	<select name="TypeMaison">
{if isset ($TabBien)}
{foreach from=$TabBien item=infos}
		<option value="{$infos.id_bien}">{$infos.nom_bien}</option>
{/foreach}
{else}
		<option value="0">Aucun bien</option>
{/if}
	</select></p>
	<p>Etat des lieux :
	<select name="etat">
{if isset ($TabEtat)}
{foreach from=$TabEtat item=infos3}
		<option value="{$infos3.id_etat}">{$infos3.nom_etat}</option>
{/foreach}
{else}		
		<option value="0">Aucune donn&eacute;es</option>
{/if}			
	</select></p>	
	<p>Surface minimum : <input name="surf_min" type="text"></p>
	<p>Surface maximum: <input name="surf_max" type="text"></p>
	<p>Prix minimum: <input name="prix_min" type="text"></p>
	<p>Prix maximum: <input name="prix_max" type="text"></p>
	<p>Ville : 
	<select name="ville">
{if isset ($TabVille)}
{foreach from=$TabVille item=infos2}
		<option value="{$infos2.id_ville}">{$infos2.nom_ville}</option>
{/foreach}
{else}		
		<option value="0">Aucune ville</option>
{/if}		
	</select></p>
	<p>Distance maximum : <input name="dist_max" type="text"></p>
	<p><input type="submit" value="ajouter"></p>
	</form>
</body>
</html>