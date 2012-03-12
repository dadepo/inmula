/**
 * 
 */

function open()
{
	$('#addproject').slideDown('slow');
}

function close()
{
	$('#addproject').slideUp('fast');
}







$(document).ready(function()
{
	var appurl = $('input#appurl').val();	


	
$('#addproject').hide();
	
	var cat = new Array();
	$(':checkbox').click(function()
			{
			//get the value for the category
			var insert = 1;
			for (x in cat)
				{
					if(cat[x] == $(this).val())
						{
						//how do you delete element from an Array in Javascript
						cat[x] = '';
						insert = 0;
						break;
						}
						
				
				}
			if (insert == 1)
				{
				cat.push($(this).val());
				
				}
		
			
			});
	
	
	$('#addprojectbtn').click(function()
			{
		
		var pname = $('#nproject').val();
		var pdesc = $('#tareaproject').val();
		var pemail = $('#email').val();
		//make the stuffs inside CAT array into string
		//now do your ajax magic
		var catstring = '';
			for (x in cat)
				{
				if (cat[x] != '')
				catstring = catstring + ',' + cat[x];
				}
		
		catstring = 'Categories:' + catstring; 
		
		
		$.get(appurl+'/a2w/startuphub/addproject',{pname:pname,pdesc:pdesc,cat:catstring,email:pemail},function(data,status)
				{
				if (status == 'success')
					{
					//append new Project
					//$('div#listofprojects').prepend("<div id='project'><span class='title'>"+pname+"<span class='meta'>Submitted Just Now</span><br/><div id='votewraper'><img class='vup' onclick='voteup(666)' src='http://alumnihub//images/voteup.png'/><span id='votes44'> 0 </span></div></span><br/><span class='innerleft'><img class='pix' src='http://alumnihub//images/default.png'/></span><span class='desc'>You are receiving this message because you have confirmed your attendance at the Global Exchange Summit taking place in Stockholm Sweden from the 7th-9th December, 2011.<br/><br/><br/><span class='email'><em>Contact<span>dadepo@gmail.com</span> to colloborate</em></span><br/><span class='cat'>Categories:,charity</span><br/></span><br/></div>");
					
					
					//do modal
					
					
					$('#my-modal').modal({
						  keyboard: true,
						  backdrop: true
						}).modal('show');
					}
				});
		
			});
	
	
	
	
	
	
	$('#showclose').toggle(
			function()
			{
				open();
			},function ()
			{
				close();
			});
	var tareaproject = document.getElementById('tareaproject');	
	tareaproject.addEventListener('keyup',function()
			{
				//get words in textarea
				var str = $('#tareaproject').val();
				var inputcount = str.length;
				
				//get counter
				
				var counter = 1000 - inputcount;
				$('em#wordcount').html(counter);
			}
	);
	
}		
);