function voir(id)
{
	var MaCle=document.getElementById('Cle');
	MaCle.value=id;
	var MonForm=document.getElementById('Formulaire');
	MonForm.submit();
}