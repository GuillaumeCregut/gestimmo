function init()
{
	var myForm = document.getElementById('add_client'),
        inputs = document.querySelectorAll('input[type=text], input[type=password]'),
        inputsLength = inputs.length;
    for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }
    myForm.addEventListener('submit', function(e) {
        var result =true;
        //Vérification des valeurs mini et maxi :
		//Nom et prénom
		var LeNom=document.getElementById('nom').value,
			LePrenom=document.getElementById('prenom').value;
		if((LeNom!='')&&(LePrenom!=''))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez les nom et prénom');
			e.preventDefault();
			return false;
		}
        if (result)
		{
            if(!confirm('Voulez vous ajouter le vendeur ?'))
			{
				e.preventDefault();
				return false;
			}		
        }
		else
		{
			alert('toto');
			e.preventDefault();
			return false;
			
		}
        
	});
	deactivateTooltips();
}
function deactivateTooltips()
{
    var tooltips = document.querySelectorAll('.tooltip'),
        tooltipsLength = tooltips.length;
    for (var i = 0; i < tooltipsLength; i++)
	{
        tooltips[i].style.display = 'none';
    }
}
function getTooltip(elements)
{
   while (elements = elements.nextSibling)
	{
        if (elements.className === 'tooltip')
		{
			return elements;
        }
    }
    return false;
}
var check = {}; // On met toutes nos fonctions dans un objet littéral
check['nom'] = function(id) {
    var name = document.getElementById(id),
        tooltipStyle = getTooltip(name).style;
    if (name.value.length >= 2) {
        name.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        name.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
};
check['prenom'] = check['nom']; 
