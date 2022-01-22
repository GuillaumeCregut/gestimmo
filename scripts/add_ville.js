function init()
{
	var myForm = document.getElementById('ajout_ville');
	myForm.addEventListener('submit', function(e) {
        var result =true;
		inputs = document.querySelectorAll('input[type=text]');
		inputsLength = inputs.length;
		for (var i = 0; i < inputsLength; i++)
		{
			if(inputs[i].value=='')
			{
				result =false;
				alert('Vérifiez les valeurs');
				e.preventDefault();
				return false;
			}
			if(inputs[i].name!='NlleVille')
			{
				if(isNaN(inputs[i].value))
				{
					result =false;
					alert('Vérifiez les valeurs');
					e.preventDefault();
					return false;
				}
			}
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
function Check_value(id)
{
	var tooltipStyle = getTooltip(id).style;
	var Valeur=id.value;
    if (!isNaN(Valeur))
	{
        id.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    }
	else
	{
        id.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }
}