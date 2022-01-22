function voir_acheteur(id_ach)
{
	var MonForm=document.getElementById('formulaire');
	var Valeur=document.getElementById('id_Acheteur');
	Valeur.value=id_ach;
	MonForm.submit();
}
function modif_acheteur(id_ach)
{
	var MonForm=document.getElementById('mod_acheteur');
	var Valeur=document.getElementById('id_Ach');
	Valeur.value=id_ach;
	MonForm.submit();
}