/**
 * 
 */

/**
 * 
 */




function delevent(n)
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
		var addevents = document.getElementById('addevents');
	     addevents.addEventListener('click',function()
				{
	    	 
	    	

	    	     var goahead = 1;
	    		 
	    	     
	    	     
	    	     var countryevent = document.getElementById('countryevent').value;
		    		var countryeventid = 'countryevent' + n;
		    		if (countryevent == '')
			    		 goahead = 0;
	    	     
	    	     
	    	     var yearevent = document.getElementById('yearevent').value;
	    		 var yeareventid = 'yearevent' + n;
	    		 if (yearevent == '')
		    		 goahead = 0;
	    		 
	    		 var typeevent = document.getElementById('typeevent').value;
	    		 var typeeventid = 'typeevent' + n;
	    		 if (typeevent == '')
		    		 goahead = 0;
	    		
	    		  //
	    		 
	    		
	    		
	    		
	    		
	    	
	    		 


				

			//var html = "<div class='magic' id='magic"+n+"'><p><input class='small' name='"+coy+"' id='"+coyid+"'  value='"+coy+"'/></p><p><input class='small' id='"+countryid+"' name='"+country+"' value='"+country+"'/></p><p><input class='small' name='"+lc+"' id='"+lcid+"' value='"+lc+"'/></p><p><input class='small' name='"+fromdate+"' id='"+fromdateid+"' value='"+fromdate+"'/></p><p><input class='small' id='"+todateid+"' name='"+todate+"' value='"+todate+"'/><input type='button' class='btn danger' onclick=delrole("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
	        var html = "<div class='magic' id='magic"+n+"'><p><input readonly=readonly class='small' name='countryevent[]' id='"+countryeventid+"'  value='"+countryevent+"'/></p><p><input readonly=readonly class='small' id='"+yeareventid+"' name='yearevent[]' value='"+yearevent+"'/></p><p><input readonly=readonly class='small' name='typeevent[]' id='"+typeeventid+"' value='"+typeevent+"'/></p><p><input type='button' class='btn danger' onclick=delevent("+n+") value='Remove'/></p></div><div style='clear:both'></div>";
			//only append if there are no empty field.
		
			
			
			

			//if (goahead == 1)
			if (1)
			{
			$('#addedevents').append(html);
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

