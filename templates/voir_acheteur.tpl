<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <title>Gestion immobili&egrave;re</title>
	<link rel="stylesheet" type="text/css" href="styles/voir_acheteur.css">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/voir_acheteur.js"></script>
</head>
<body>
	<h1>Affichage des acheteurs</h1>
	<form name="voir_fiche_acheteur" action="voir_fiche_ach.php" method="post" id="formulaire">	
	{if isset($TabAcheteur)}
	{foreach from=$TabAcheteur item=infos}	
		<p><strong>{$infos.NOMACHETEUR}</strong> recherche <strong>{$infos.TYPE_B}</strong>  dans l'&eacute;tat <strong>{$infos.ETAT}</strong> à <strong>{$infos.DISTANCE}</strong> km maximum de <strong>{$infos.VILLE}</strong>.<br> 
		Surface de terrain comprise entre <strong>{$infos.MINSURF} et {$infos.MAXSURF}</strong> m2.<br>
		Surface habitable comprise entre <strong>{$infos.MINSURF_H} et {$infos.MAXSURF_H}</strong> m2 et <strong>{$infos.NbrePieces}</strong> pi&egrave;ces dans une fourchette de prix de <strong>{$infos.MINPRIX} à {$infos.MAXPRIX}</strong> euros</p>
		<div id="groupe">
			<p><input type="button" value="Voir la fiche" onclick="voir_acheteur({$infos.id_acheteur})"  class="bouton_lien"></p>
			<p><input type="button" value="Modifier la fiche" onclick="modif_acheteur({$infos.id_acheteur})"  class="bouton_lien"></p>
		</div>
	{/foreach}
	{else}
		<p>Il n'y a pas d'acheteurs recherchant un bien dans la liste</p>
	{/if}
		<input type="hidden" value="0" name="id_Acheteur" id="id_Acheteur">
	</form>
	<form name="mod_acheteur" id="mod_acheteur" action="mod_acheteur.php" method="post">
		<input type="hidden" value="0" name="id_Acheteur" id="id_Ach">
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>
