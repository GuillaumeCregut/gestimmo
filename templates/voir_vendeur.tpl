<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
    <title>Gestion immobili&egrave;re</title>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" media="screen" href="styles/voir_vendeur.css">
</head>
<body>
	<h1>Voir un&nbsp; client vendeur</h1>
	<div id="corps">
		<form name="add_client" method="post" action="mod_vendeur.php" id="mod_vendeur">
			<div id="infos">
				<div id="liste">
					<input type="hidden" name="id_vendeur" value="{$id_vendeur}">
					<p>Pr&eacute;nom: <strong>{$prenom}</strong></p>
					<p>Nom: <strong>{$nom}</strong></p>
					<p>Adresse : <strong>{$adresse}</strong></p>
					<p>Num&eacute;ro de t&eacute;l&eacute;phone : <strong>{$tel}</strong></p>
					<p>Num&eacute;ro de t&eacute;l&eacute;phone 2 : <strong>{$tel2}</strong></p>
					<p>Adresse Mail :<strong>{$mail}</strong></p>
				</div>
				<div id="lebouton">
					<p><input type="submit" value="Modifier"  class="bouton_lien"></p>
				</div>
			</div>
		</form>
		<div id="bien_vente" class="fond">
			<p><strong>{$Nbre_Vente}</strong> biens en vente.</p>
			<form name="voir_bien_vendeur" method="post" action="affiche_biens_vendeur.php">
				<input type="hidden" name="id_vendeur" value="{$id_vendeur}">
				<p><input type="submit" value="Voir les biens en vente"  class="bouton_lien"></p>
			</form>
		</div>
		{if isset($RetourBien)}
		<form name="retour_bien" method="post" action="voir_bien.php">
			<input type="hidden" name="Cle" value="{$RetourBien}">
			<p><input type="submit" value="Retour &agrave; la fiche du bien"></p>
		</form>
		{/if}
		<p><a href="sel_vendeur.php" class="bouton_lien">Retour &agrave; la liste des vendeurs</a></p>
	</div>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>