var check = {};
function init()
{
	var myForm = document.getElementById('modif_bien'),
        inputs = document.querySelectorAll('input[type=text]'),
        inputsLength = inputs.length;
    for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }
	
	myForm.addEventListener('submit', function(e) {
		if (confirm('Voulez vous modifier ?'))
		{
			myForm.submit();
		}
		else
		{
			e.preventDefault();
				return false;
		}
	});
	var formVendre=document.getElementById('vendre');
	formVendre.addEventListener('submit', function(e) {
		if (confirm('Voulez vous vendre le bien ?'))
		{
			formVendre.submit();
		}
		else
		{
			e.preventDefault();
				return false;
		}
	});
	deactivateTooltips();
}
function alerter()
{
	var MaCB=document.getElementById('cb_vendre');
	if (MaCB.checked==true)
	{
		alert('Attention ! Cette option retire le bien de la liste disponible à la vente');
	}
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
check['prix'] = function()
{
    var prix_min = document.getElementById('prix'),
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
check['commission'] = function()
{
    var prix_min = document.getElementById('commission'),
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
check['surf'] = function()
{
    var prix_min = document.getElementById('surf'),
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
check['surf_h'] = function()
{
    var prix_min = document.getElementById('surf_h'),
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
    var prix_min = document.getElementById('pieces'),
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