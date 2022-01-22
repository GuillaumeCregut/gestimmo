var check = {};
function init()
{
	var myForm = document.getElementById('aff_bien'),
        inputs = document.querySelectorAll('input[type=text]'),
        inputsLength = inputs.length;
	for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }
	myForm.addEventListener('submit', function(e) {
		var result =true;
		 //Verification des valeurs surface
		var cb_surf=document.getElementById('cb_surf').checked;
		if(cb_surf)
		{
			var v_s_min=document.getElementById('surf_min').value;
			var v_s_max=document.getElementById('surf_max').value;
			//On verifie si ce sont des nombres ou non
			if((!isNaN(v_s_min))&&(!isNaN(v_s_max)))
			{
				v_test=v_s_min+v_s_max;
				if(!((v_test>21)&&(v_s_min<v_s_max)))
				{
					alert('Vérifiez les valeurs de la surface');
					result=false;
					e.preventDefault();
					return false;
				}
			}
			else
			{
				alert('Vérifiez la surface');
				result=false;
				e.preventDefault();
				return false;
			}
		}
		 //Verification des valeurs surface habitables
		var cb_surf_h=document.getElementById('cb_surf_h').checked;
		if(cb_surf_h)
		{
			var v_sh_min=document.getElementById('surf_min_h').value;
			var v_sh_max=document.getElementById('surf_max_h').value;
			//On verifie si ce sont des nombres ou non
			if((!isNaN(v_sh_min))&&(!isNaN(v_sh_max)))
			{
				v_test=v_sh_min+v_sh_max;
				if(!((v_test>21)&&(v_sh_min<v_sh_max)))
				{
					alert('Vérifiez les valeurs de la surface habitables');
					result=false;
					e.preventDefault();
					return false;
				}
			}
			else
			{
				alert('Vérifiez la surface habitable');
				result=false;
				e.preventDefault();
				return false;
			}
		}
		 //vérification des prix
		var cb_prix=document.getElementById('cb_prix').checked;
		if(cb_prix)
		{
			var v_p_min=document.getElementById('prix_min').value;
			var v_p_max=document.getElementById('prix_max').value;
			//On verifie si ce sont des nombres ou non
			if((!isNaN(v_p_min))&&(!isNaN(v_p_max)))
			{
				if(!(v_p_min<v_p_max))
				{
					alert('Vérifiez le prix');
					result=false;
					e.preventDefault();
					return false;
				}
			}
			else
			{
				alert('Vérifiez le prix');
				result=false;
				e.preventDefault();
				return false;
			}
		}
		 //verification des pieces
		var cb_piece=document.getElementById('cb_piece').checked;
		if(cb_piece)
		{
			var v_pi_min=document.getElementById('pieces_min').value;
			var v_pi_max=document.getElementById('pieces_max').value;
			//On verifie si ce sont des nombres ou non
			if((!isNaN(v_pi_min))&&(!isNaN(v_pi_max)))
			{
				if(!(v_pi_min<v_pi_max))
				{
					alert('Vérifiez le nombre de pièces');
					result=false;
					e.preventDefault();
					return false;
				}
			}
			else
			{
				alert('Vérifiez le nombre de pièces');
				result=false;
				e.preventDefault();
				return false;
			}
		}
		 //Verification de la distance
		var cb_ville=document.getElementById('cb_ville').checked;
		if(cb_ville)
		{
			var v_dist=document.getElementById('distance').value;
			//On verifie si ce sont des nombres ou non
			if(isNaN(v_dist))
			{
				document.getElementById('distance').value=0;
			}
			else
			{
				document.getElementById('distance').value=0;
			}
		}
		/*result=false;
		e.preventDefault();
		return false;*/
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
function checkLaBox(champ)
{
	while(champ=champ.previousSibling)
	{
		if(champ.className==='MaCB')
		{
			champ.checked=true;
		}
	}
}
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
//pieces_min
check['pieces_min'] = function()
{
    var surf_min = document.getElementById('pieces_min'),
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
check['pieces_max'] = function()
{
    var surf_max_h = document.getElementById('pieces_max'),
        tooltipStyle = getTooltip(surf_max_h).style,
		ValeurMax_h=surf_max_h.value;
		ValeurMin_h=parseInt(document.getElementById('pieces_min').value,10);
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