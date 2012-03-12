/**
 * 
 */


function delrole(n)
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
	
	var addroles = document.getElementById('addroles');
	     addroles.addEventListener('click',function()
				{

	    	     var goahead = 1;
	    		 var rtitle = document.getElementById('rtitle').value;
	    		 var rtitleid = 'rtitle' + n;
	    		 
	    		 if (rtitle == '')
		    		 goahead = 0;
	    		var country = document.getElementById('country').value;
	    		var countryid = 'country' + n;
	    		if (country == '')
		    		 goahead = 0;
	    		var lc = document.getElementById('lcx').value;
	    		var lcid = 'lc' + n;
	    		if (lc == '')
		    		 goahead = 0;
	    		var fromdate = document.getElementById('fromdate').value;
	    		var fromdateid = 'fromdate' + n;
	    		if (fromdate == '')
		    		 goahead = 0;
	    		var todate = document.getElementById('todate').value;
	    		var todateid = 'todate' + n;
	    		if (todate == '')
		    		 goahead = 0;

	    		 


				

			//var html = "<div class='magic' id='magic"+n+"'><p><input class='small' name='"+rtitle+"' id='"+rtitleid+"'  value='"+rtitle+"'/></p><p><input class='small' id='"+countryid+"' name='"+country+"' value='"+country+"'/></p><p><input class='small' name='"+lc+"' id='"+lcid+"' value='"+lc+"'/></p><p><input class='small' name='"+fromdate+"' id='"+fromdateid+"' value='"+fromdate+"'/></p><p><input class='small' id='"+todateid+"' name='"+todate+"' value='"+todate+"'/><input type='button' class='btn danger' onclick=delrole("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
	        var html = "<div class='magic' id='magic"+n+"'><p><input readonly=readonly class='small' name='rtitle[]' id='"+rtitleid+"'  value='"+rtitle+"'/></p><p><input readonly=readonly class='small' id='"+countryid+"' name='country[]' value='"+country+"'/></p><p><input readonly=readonly class='small' name='lc[]' id='"+lcid+"' value='"+lc+"'/></p><p><input readonly=readonly class='small' name='fromdate[]' id='"+fromdateid+"' value='"+fromdate+"'/></p><p><input readonly=readonly class='small' id='todateid[]' name='todate[]' value='"+todate+"'/><input type='button' class='btn danger' onclick=delrole("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
			//only append if there are no empty field.
		
			
			
			

			//if (goahead == 1)
			if (1)
			{
			$('#addedroles').append(html);
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

