function init()
{
	var myForm = document.getElementById('add_bien'),
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
		//Prix et surfaces et nombre de pieces
		var Prix=parseInt(document.getElementById('prix_bien').value,10),
			NbrePiece=parseInt(document.getElementById('pieces').value,10),
			SurfHab=parseInt(document.getElementById('surf_hab').value,10),
			SurfTer=parseInt(document.getElementById('surf_ter').value,10);
		if(!(isNaN(Prix)))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez le prix');
			e.preventDefault();
			return false;
		}
		if(!(isNaN(NbrePiece)))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez le nombre de pièces');
			e.preventDefault();
			return false;
		}
		if(!(isNaN(SurfHab)))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez la surface habitable');
			e.preventDefault();
			return false;
		}
		if(!(isNaN(SurfTer)))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez la surface du terrain');
			e.preventDefault();
			return false;
		}
        if (result)
		{
            if(!confirm('Voulez vous ajouter le bien ?'))
			{
				e.preventDefault();
				return false;
			}		
        }
		else
		{
			alert('Le formulaire est mal rempli !');
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
//exemple
check['surf_ter'] = function()
{
    var surf_min = document.getElementById('surf_ter'),
        tooltipStyle = getTooltip(surf_min).style,
		ValeurMin=surf_min.value;
    if ((ValeurMin>= 10)&&(!isNaN(ValeurMin) ))
	{
        surf_min.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        surf_min.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['surf_hab'] = function()
{
    var surf_max = document.getElementById('surf_hab'),
        tooltipStyle = getTooltip(surf_max).style,
		ValeurMax=surf_max.value;
    if (!isNaN(ValeurMax))
	{
        surf_max.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        surf_max.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['prix_bien'] = function()
{
    var prix_min = document.getElementById('prix_bien'),
        tooltipStyle = getTooltip(prix_min).style,
		ValeurMin=prix_min.value;
    if (!isNaN(ValeurMin))
	{
        prix_min.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        prix_min.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['pieces'] = function()
{
    var prix_max = document.getElementById('pieces'),
        tooltipStyle = getTooltip(prix_max).style,
		ValeurMax=prix_max.value;
    if (!isNaN(ValeurMax))
	{
        prix_max.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        prix_max.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['commission'] = function()
{
    var prix_max = document.getElementById('commission'),
        tooltipStyle = getTooltip(prix_max).style,
		ValeurMax=prix_max.value;
    if (!isNaN(ValeurMax))
	{
        prix_max.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        prix_max.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['distance'] = function()
{
    var distance = document.getElementById('distance'),
        tooltipStyle = getTooltip(distance).style,
		ValeurMax=distance.value;
    if (!isNaN(ValeurMax))
	{
        distance.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        distance.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
