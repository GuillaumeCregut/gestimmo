<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<script src="scripts/voir_visite.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/voir_visite.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Affichage des visites</h1>
<!-- Debut de la liste -->
{if isset($TabVisite)}
{foreach from=$TabVisite item=infos}
	<div class="fiche_visite">
		<p class="souligne">Fiche de visite :</p>
		<p>Client : <strong>{$infos.NomPrenom}</strong><br>
		Date de la visite : <strong>{$infos.datevisite}</strong><br>
		Bien visit&eacute; : <strong>{$infos.typebien}</strong>, <strong>{$infos.etat}</strong>, situ&eacute; <strong>{$infos.adresse}</strong>,<strong>{$infos.ville}</strong> vendu par <strong>{$infos.NomVendeur}</strong><br>
		Prix : <strong>{$infos.Prix}</strong> euros<br>
		Commission : <strong>{$infos.Commission}</strong> euros<br>
		voir le bien {$infos.id_bien}<br>
		voir l'acheteur {$infos.id_acheteur}<br>
		Commentaire sur la visite :
		</p>
		<div class="commentaire">
			<p>{$infos.Commentaire}</p>
		</div>
		<div class="btns">
				<p><input type="button" value="Retour au bien" class="bouton_lien" onclick="voir_bien({$infos.id_bien})"></p>
				<p><input type="button" value="Retour &agrave; l'acheteur" class="bouton_lien" onclick="voir_ach({$infos.id_acheteur})"></p>
		</div>
	</div>
{/foreach}
{/if}
<!-- fin de la liste -->
	<form name="retour_bien" action="voir_bien.php" method="post" id="retour_bien">
		<input type="hidden" name="Cle" value="0" id="Cle">
	</form>
	<form name="retour_acheteur" action="voir_fiche_ach.php" method="post" id="retour_acheteur">
		<input type="hidden" name="id_Acheteur" value="0" id="id_Acheteur">
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>