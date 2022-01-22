<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <title>Gestion immobili&egrave;re</title>
	<script src="scripts/voir_bien.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" media="screen" href="styles/affiche_biens.css">
</head>
<body>
	<h1>Liste des biens en vente (version 2)</h1>
	<p>* : essayer de regrouper les tableaux par vendeur</p>
	<form name="affiche_bien" action="voir_bien.php" method="post" id="Formulaire">
	<input type="hidden" name="Cle" value="0" id="Cle">
		<table>
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nom du vendeur*</th>
					<th>Type de bien</th>
					<th>Etat du bien</th>
					<th>Surface du terrain</th>
					<th>Surface habitable</th>
					<th>Nombre de pi&egrave;ces</th>
					<th>Ville</th>
					<th>Prix</th>
					<th>Commission</th>
					<th>Revenu net</th>
				</tr>
			</thead>
			<tbody>
			{if isset($TabBien)}
			{foreach from=$TabBien item=infos}
				<tr>
					<td><input type="button" id="id_bien" value="Voir" onclick="voir({$infos.id_bien})"></td>
					<td>{$infos.NomVendeur}</td>
					<td>{$infos.type_bien}</td>
					<td>{$infos.Etat_bien}</td>
					<td>{$infos.Surf_Terr} m2</td>
					<td>{$infos.Surf_Hab} m2</td>
					<td>{$infos.Nbre_pieces}</td>
					<td>{$infos.Ville}</td>
					<td>{$infos.Prix} euros</td>
					<td>{$infos.commission} euros</td>
					<td>{$infos.revenu}</td>
				</tr>
			{/foreach}
			{/if}
			</tbody>
		</table>
	</form>
	<p><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>