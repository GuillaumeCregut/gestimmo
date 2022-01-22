<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/rech_bien.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/rech_bien.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body onload="init()">
	<h1>Rechercher un bien immobilier</h1>
	<p class="souligne">crit&egrave;res de recherche :</p>
	<form name="aff_bien" id="aff_bien" action="affiche_biens_rech.php" method="post">
		<input type="hidden" name="rech_ok" value="1">
		<p><input name="cb_surf" id="cb_surf" type="checkbox" class="MaCB"> Surface du terrain : entre <input name="surf_min" id="surf_min" type="text" onchange="checkLaBox(this)"> et <input name="surf_max" id="surf_max" type="text"> m2
		<span class="tooltip">La surface doit &ecirc;tre de 10m2 minimum. Attention au minimum et au maximum</span></p>
		<p><input name="cb_surf_h" id="cb_surf_h" type="checkbox" class="MaCB"> Surface habitable : entre <input name="surf_min_h" id="surf_min_h" type="text" onchange="checkLaBox(this)"> et <input name="surf_max_h" id="surf_max_h" type="text"> m2
		<span class="tooltip">La surface doit &ecirc;tre de 10m2 minimum. Attention au minimum et au maximum</span></p>
		<p><input name="cb_prix" id="cb_prix" type="checkbox" class="MaCB"> Prix : entre <input name="prix_min" id="prix_min" type="text" onchange="checkLaBox(this)"> et <input name="prix_max" id="prix_max" type="text"> euros
		<span class="tooltip">Le prix doit &ecirc;tre un chiffre.  Attention au minimum et au maximum</span></p>
		<p><input name="cb_piece" id="cb_piece" type="checkbox" class="MaCB"> Nombre de pi&egrave;ces : entre <input name="pieces_min" id="pieces_min" type="text" onchange="checkLaBox(this)"> et <input name="pieces_max" id="pieces_max" type="text">
		<span class="tooltip">Le prix doit &ecirc;tre un chiffre. Attention au minimum et au maximum</span></p>
		<p><input name="cb_ville" id="cb_ville" type="checkbox" class="MaCB">Ville :
		<select name="id_ville" id="id_ville" onchange="checkLaBox(this)">
		{if isset($TabVille)}
		{foreach from=$TabVille item=infos}
		<option value="{$infos.id_ville}">{$infos.nom_ville}</option>
		{/foreach}
		{else}
		<option value="0">--</option>
		{/if}
		</select> <label for=""></label> &agrave; une distance maximum de : <input type="text" name="distance" id="distance" value="0"> km
		<span class="tooltip">La distance doit &ecirc;tre un chiffre.</span></p>
		<p><input name="cb_etat" id="cb_etat" type="checkbox" class="MaCB">Etat :
		<select name="id_etat" id="id_etat" onchange="checkLaBox(this)">
		{if isset($TabEtat)}
		{foreach from=$TabEtat item=infos2}
		<option value="{$infos2.id_etat}">{$infos2.nom_etat}</option>
		{/foreach}
		{else}
		<option value="0">--</option>
		{/if}
		</select></p>
		<p><input name="cb_bien" id="cb_bien" type="checkbox" class="MaCB">Type de bien :
		<select name="id_bien" id="id_bien" onchange="checkLaBox(this)">
		{if isset($TabBien)}
		{foreach from=$TabBien item=infos3}
		<option value="{$infos3.id_bien}">{$infos3.nom_bien}</option>
		{/foreach}
		{else}
		<option value="0">--</option>
		{/if}
		</select></p>
		<p><input type="submit" value="Rechercher" class="bouton_lien"></p>
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>

