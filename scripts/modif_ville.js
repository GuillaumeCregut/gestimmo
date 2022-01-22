var i=1;
var TabVilles=[];
function init()
{
	
}
function getVilles()
{
	//Récupère les villes dans un tableau;
	var TabElm=document.getElementsByTagName('input');
	for(var i=0;i<TabElm.length;i++)
	{
		var Nom=TabElm[i].getAttribute('type');
		if(Nom=="hidden")
		{
			if(!isNaN(TabElm[i].value))
				TabVilles.push(TabElm[i].value);
		}
	}
	//Gestion du formulaire concernant la modification des distances
	var myForm = document.getElementById('modif_distance');
	myForm.addEventListener('submit', function(e) {
        var result =true;
		//On parcours le premier formulaire
		var formulaire=document.forms[0];
		for (var i=0;i<formulaire.length;i++)
		{
			if((formulaire[i].name!='NomVille')&&(formulaire[i].name!='ListeVille[]'))
			{
				if(formulaire[i].value!='Modifier')
				{
					if(formulaire[i].value=='')
					{
						{
							result =false;
							alert('Vérifiez les valeurs');
							e.preventDefault();
							return false;
						}
					}
					if(isNaN(formulaire[i].value))
					{
						result =false;
						alert('Vérifiez les valeurs');
						e.preventDefault();
						return false;
					}
				}
			}
		}
		//Fin de parcours du formulaire
	});
	deactivateTooltips();
	//Fin gestion modification
}
function newVille()
{
	var MonSelect=document.getElementById('liste_ville');
	var FormDest=document.getElementById('New_Villes');
	var PremierBouton=document.getElementById('AvantMoi');
	var NewSelect=MonSelect.cloneNode(true);
	NewSelect.setAttribute('name','ville['+i+']');
	var MonP=document.createElement('p');
	//Nouveau par rapport a dessous
	var MaDist=document.getElementById('distance');
	var NewDistance=MaDist.cloneNode(true);
	NewDistance.setAttribute('name','distance['+i+']');
	var Montooltip=document.createElement('SPAN');
	var ValeurSpan=document.createTextNode('Veuillez entrer un chiffre');
	Montooltip.setAttribute('class','tooltip');
	Montooltip.appendChild(ValeurSpan);
	Montooltip.style.display='none';
	/*var MonText=document.createElement('INPUT');
	MonText.setAttribute('type','text');
	MonText.setAttribute('name','distance['+i+']');*/
	MonP.appendChild(NewSelect);
	MonP.appendChild(NewDistance);
	var KM=document.createTextNode('km');
	MonP.appendChild(KM);
	MonP.appendChild(Montooltip);
	FormDest.insertBefore(MonP,PremierBouton);
	i++;
}
function test_ville(app)
{
	var id_newVille=app.value;
	for(var i=0;i<TabVilles.length;i++)
	{
		if(TabVilles[i]==id_newVille)
		{
			app.className = 'incorrect';
			alert('Ville déjà saisie');
		}
		else
		{
			app.className = 'correct';
		}
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