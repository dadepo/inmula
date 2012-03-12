/**
 * 
 */


function delinternship(n)
{
	var remove = "#magic"+n;
	
	$(remove).fadeOut('slow',function()
			{
		$(this).remove();
			});
}

$(document).ready(function()
		{
	

	var n = 1;
		var addinternships = document.getElementById('addinternships');
	     addinternships.addEventListener('click',function()
				{
	    	 

	    	     var goahead = 1;
	    		 var coy = document.getElementById('coy').value;
	    		 
	    		 var coyid = 'coy' + n;
	    		 
	    		 if (coy == '')
		    		 goahead = 0;
	    		var countryinternship = document.getElementById('countryinternship').value;
	    		var countryinternshipid = 'countryinternship' + n;
	    		if (countryinternship == '')
		    		 goahead = 0;
	    		var lci = document.getElementById('lcxi').value;
	    		
	    		var lciid = 'lci' + n;
	    		if (lci == '')
		    		 goahead = 0;
	    		var fromdatei = document.getElementById('fromdatei').value;
	    	    var fromdateiid = 'fromdatei' + n;
	    		if (fromdatei == '')
		    		 goahead = 0;
	    		var todatei = document.getElementById('todatei').value;
	    		var todateiid = 'todatei' + n;
	    		
	    		if (todatei == '')
		    		 goahead = 0;

	    		 


				

			//var html = "<div class='magic' id='magic"+n+"'><p><input class='small' name='"+coy+"' id='"+coyid+"'  value='"+coy+"'/></p><p><input class='small' id='"+countryid+"' name='"+country+"' value='"+country+"'/></p><p><input class='small' name='"+lc+"' id='"+lcid+"' value='"+lc+"'/></p><p><input class='small' name='"+fromdate+"' id='"+fromdateid+"' value='"+fromdate+"'/></p><p><input class='small' id='"+todateid+"' name='"+todate+"' value='"+todate+"'/><input type='button' class='btn danger' onclick=delrole("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
	        var html = "<div class='magic' id='magic"+n+"'><p><input readonly=readonly class='small' name='coy[]' id='"+coyid+"'  value='"+coy+"'/></p><p><input readonly=readonly class='small' id='"+countryinternshipid+"' name='countryinternship[]' value='"+countryinternship+"'/></p><p><input readonly=readonly class='small' name='lci[]' id='"+lciid+"' value='"+lci+"'/></p><p><input readonly=readonly class='small' name='fromdatei[]' id='"+fromdateiid+"' value='"+fromdatei+"'/></p><p><input readonly=readonly class='small' id='todateidi' name='todatei[]' value='"+todatei+"'/><input type='button' class='btn danger' onclick=delinternship("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
			//only append if there are no empty field.
		
			
			
			

			//if (goahead == 1)
			if (1)
			{
			$('#addedinternships').append(html);
			//clear fields
			$('div.inputbox input[type=text]').each(function()
					{
					
					$(this).val('');
					});
			
			n++;
			}
			else
			{
				alert("You have to fill all fields");
			}
			});
		}
		);

