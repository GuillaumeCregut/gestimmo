<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<script src="scripts/voir_bien.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Recherche de biens</h1>
	<p>Voici les biens correspondants &agrave; la recherche</p>
	<form name="affiche_bien" action="voir_bien.php" method="post" id="Formulaire">
	<input type="hidden" name="Cle" value="0" id="Cle">
	<table>
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nom du vendeur</th>
					<th>Type de bien</th>
					<th>Etat du bien</th>
					<th>Surface du terrain</th>
					<th>Surface habitable</th>
					<th>Nombre de pi&egrave;ces</th>
					<th>Ville</th>
					<th>Prix vendeur</th>
					<th>Commission</th>
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
				</tr>
			{/foreach}
			{/if}
			</tbody>
		</table>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</body>
</html>