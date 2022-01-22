<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/general.css">
	<link rel="stylesheet" type="text/css" href="styles/add_visite_client.css">
    <title>Gestion immobili&egrave;re</title>
</head>
<body>
	<h1>Visite d'un bien immobilier</h1>
	<p class="souligne">Acheteur selectionn&eacute; :</p>
	<p><strong>{$NomAcheteur}</strong></p>
	<p class="souligne">Selectionnez le bien visit&eacute;</p>
	<form name="add_visite" id="add_visite" method="post" action="add_visite_client_sql.php">
		<input type="hidden" name="id_acheteur" value="{$id_acheteur}">
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
					<th>Prix</th>
					<th>Commission</th>
					<th>Revenu net</th>
				</tr>
			</thead>
			<tbody>
			{if isset($TabBien)}
			{foreach from=$TabBien item=infos}
				<tr>
					<td><input type="radio" name="id_bien" id="id_bien" value="{$infos.id_bien}"></td>
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
		<p>Date de la visite :<input type="date" name="ladate" value="{$dateV}"></p>
		<p>Commentaires :</p>
		<textarea name="commentaire"></textarea>
		<p><input type="submit" value="Ajouter" class="bouton_lien"></p>
	</form>
	<p id="lienretour"><a href="index.php">Retour &agrave; l'accueil</a></p>
	<footer>
		<p id="copyright"><img src="images/logo-mini.gif" alt="logo"> Copyright &copy; 2018  Editiel 98, Guillaume Cr&eacute;gut. Tous droits r&eacute;serv&eacute;s.</p>
	</footer>
</html>