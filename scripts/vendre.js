function init()
{
	var myForm = document.getElementById('vendre');
	myForm.addEventListener('submit', function(e) {
		var Acheteur=document.getElementById('acheteur').value;
		console.log('Acheteur : '+Acheteur);
		if(Acheteur!=0)
		{
			if(confirm('Voulez vous réaliser la vente ?'))
			{
				 myForm.submit();
			}
			else
			{
				e.preventDefault();
				return false;
			}
		}
		else
		{
			alert('Veuillez selectionner un acheteur');
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
function verif(id)
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