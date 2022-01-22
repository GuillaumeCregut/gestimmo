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
		//Prix et surface
		var PrixMin=parseInt(document.getElementById('prix_min').value,10),
			PrixMax=parseInt(document.getElementById('prix_max').value,10),
			SurfMin=parseInt(document.getElementById('surf_min').value,10),
			SurfMax=parseInt(document.getElementById('surf_max').value,10),
			SurfMin_H=parseInt(document.getElementById('surf_min_h').value,10),
			SurfMax_H=parseInt(document.getElementById('surf_max_h').value,10),
			NbrePieces=parseInt(document.getElementById('pieces').value,10);
		if(	PrixMin<PrixMax)
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez les prix min et max');
			e.preventDefault();
			return false;
		}
		if(	SurfMin<SurfMax)
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez les surfaces min et max');
			e.preventDefault();
			return false;
		}
		if((SurfMin_H<SurfMax_H)||(SurfMin_H==0))
		{
			result=true;
		}
		else
		{
			result=false;
			alert('Vérifiez les surfaces habitables min et max');
			e.preventDefault();
			return false;
		}
		var LaDistance=parseInt(document.getElementById('distance').value,10);
		if((LaDistance<=0) || (isNaN(LaDistance)))
		{
			document.getElementById('distance').value='0';
		}
		if((NbrePieces<=0) || (isNaN(NbrePieces)))
		{
			document.getElementById('pieces').value='0';
		}
        if (result)
		{
            if(!confirm('Voulez vous modifier le client ?'))
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

check['surf_min'] = function()
{
    var surf_min = document.getElementById('surf_min'),
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
check['surf_max'] = function()
{
    var surf_max = document.getElementById('surf_max'),
        tooltipStyle = getTooltip(surf_max).style,
		ValeurMax=surf_max.value;
		ValeurMin=parseInt(document.getElementById('surf_min').value,10);
    if (!isNaN(ValeurMax)&&(ValeurMax>ValeurMin))
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
check['prix_min'] = function()
{
    var prix_min = document.getElementById('prix_min'),
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
check['prix_max'] = function()
{
    var prix_max = document.getElementById('prix_max'),
        tooltipStyle = getTooltip(prix_max).style,
		ValeurMax=prix_max.value;
		ValeurMin=parseInt(document.getElementById('prix_min').value,10);
    if (!isNaN(ValeurMax)&&(ValeurMax>ValeurMin))
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
check['surf_max_h'] = function()
{
    var surf_max_h = document.getElementById('surf_max_h'),
        tooltipStyle = getTooltip(surf_max_h).style,
		ValeurMax_h=surf_max_h.value;
		ValeurMin_h=parseInt(document.getElementById('surf_min_h').value,10);
    if (!isNaN(ValeurMax_h)&&(ValeurMax_h>=ValeurMin_h))
	{
        surf_max_h.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        surf_max_h.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['surf_min_h'] = function()
{
    var surf_min = document.getElementById('surf_min_h'),
        tooltipStyle = getTooltip(surf_min_h).style,
		ValeurMin=surf_min_h.value;
    if (!isNaN(ValeurMin) )
	{
        surf_min_h.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        surf_min_h.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}
check['pieces'] = function()
{
    var pieces = document.getElementById('pieces'),
        tooltipStyle = getTooltip(pieces).style,
		ValeurMax=pieces.value;
    if (!isNaN(ValeurMax))
	{
        pieces.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        pieces.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}