function voir_bien(lebien)
{
	var MonForm=document.getElementById('retour_bien');
	var MonField=document.getElementById('Cle');
	MonField.value=lebien;
	MonForm.submit();
}
function voir_ach(acheteur)
{
	var MonForm=document.getElementById('retour_acheteur');
	var MonField=document.getElementById('id_Acheteur');
	MonField.value=acheteur;
	MonForm.submit();
}