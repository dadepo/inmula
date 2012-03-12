/**
 * 
 */

//get country
var rolecountry = "<select></select>";
var cinternship = "<select></select>";
var cevent = "<select></select>";
function getCountry()
{
	$.get('/settings/profile/editprofileajax',{edittype:'getcountry',cid:'ajaxwhere'},function(data,status)
			{
		if(status == 'success')
			{
			rolecountry = data;	
			
			}
		
			});
	
}


function countryinternship()
{
	$.get('/settings/profile/editprofileajax',{edittype:'getcountry',cid:'newwhere'},function(data,status)
			{
		if(status == 'success')
			{
			cinternship = data;	
			
			}
		
			});
	
}


function countryevent()
{
	$.get('/settings/profile/editprofileajax',{edittype:'getcountry',cid:'neweventcountry'},function(data,status)
			{
		if(status == 'success')
			{
			cevent = data;	
			
			}
		
			});
	
}


getCountry();
countryinternship();
countryevent();

/*saves the changes made*/

$('input[value=Save]').click(function()		
{
if ($(this).attr('id') == 'pastroles')
	{
	//you are dealing with past roles
	var newrole = $('input#ajaxroletitle').val();
	var newwhere = $('#ajaxwhere').val();
	var newfrom = $('input#ajaxfrom').val();
	var newtill = $('input#ajaxtill').val();
	
	//activate the modal
	$('#my-modal').modal({backdrop: false}).modal('show');
			/*$('#my-modal').modal({
				  backdrop: false
				}).modal('show');*/
			
	
	
	
	$.get('/settings/profile/editprofileajax',{edittype:'roles',newrole:newrole,newwhere:newwhere,newfrom:newfrom,newtill:newtill},function(data,status)
			{
				if(status == 'success')
					{
					$('#my-modal').modal('hide');
					
						//refresh
						//alert('New Role Added');
						window.location.reload();
					}
				else{
					alert("An Error Was Encounterd. Please try again");	
				}
		
			});
	

	}

if ($(this).attr('id') == 'pastinternships')
{//you are dealing with past internships

	
	//you are dealing with past internships
	var newcoy = $('input#newcoy').val();
	var newwhere = $('#newwhere').val();
	var newfrom = $('input#newfrom').val();
	var newtill = $('input#newtill').val();
	
	//activate the modal
	$('#my-modal').modal({backdrop: false}).modal('show');
			/*$('#my-modal').modal({
				  backdrop: false
				}).modal('show');*/
			
	
	
	
	$.get('/settings/profile/editprofileajax',{edittype:'internships',newcoy:newcoy,newwhere:newwhere,newfrom:newfrom,newtill:newtill},function(data,status)
			{
				if(status == 'success')
					{
					$('#my-modal').modal('hide');
					if (data == 'success')
						{
						//refresh
						//alert('New Internship Added');
						window.location.reload();
						}
					else{
						alert("An Error Was Encounterd. Please try again");	
					}
					
					}
		
			});
	
}











if ($(this).attr('id') == 'pastevents')
{
	
	
	
	//you are dealing with past events
	var newcountry = $('#neweventcountry').val();
	var newwhen = $('input#neweventwhen').val();
	var newtype = $('select#neweventtype').val();
	
	
	//activate the modal
	$('#my-modal').modal({backdrop: false}).modal('show');
			/*$('#my-modal').modal({
				  backdrop: false
				}).modal('show');*/
			
	
	
	
	$.get('/settings/profile/editprofileajax',{edittype:'events',newcountry:newcountry,newwhen:newwhen,newtype:newtype},function(data,status)
			{
				if(status == 'success')
					{
					$('#my-modal').modal('hide');
					if (data == 'success')
						{
						//refresh
						//alert('New Event Added');
						window.location.reload();
						}
					else{
						alert("An Error Was Encounterd. Please try again");	
					}
					
					}
		
			});
	
	
	
	
	
	
	
	
	
	
	
	
	
}

}
);


/*saves the changes made*/




$('.addbtn').click(function()
{
	
	//get the parent div
	var parentdiv = $(this).attr('id').slice(3);
	
	if (parentdiv == 'pastroles')
		{
	$("div#"+parentdiv+' ul.alternate div#fornew').prepend(
			"<li><span class='thelabel'>Role Title </span> <span class='theval'><input type='text' id='ajaxroletitle' /></span></li>" +
			"<li><span class='thelabel'>Where </span> <span class='theval'>"+rolecountry+"</span></li>" +
			"<li><span class='thelabel'>From </span> <span class='theval'><input type='text' id='ajaxfrom' class='datepicker'/></span></li>" +
			"<li><span class='thelabel'>Till </span> <span class='theval'><input type='text' id='ajaxtill' class='datepicker' /></span></li><br/><br/>");
			$( ".datepicker" ).datepicker({ changeYear: true,  yearRange: '1948:2012',changeMonth : true });
		}
	if (parentdiv == 'pastinternships')
		{
		$("div#"+parentdiv+' ul.alternate div#fornew').prepend(
				"<li><span class='thelabel'>Company</span> <span class='theval'><input id='newcoy' type='text' /></span></li>" +
				"<li><span class='thelabel'>Where </span> <span class='theval'>"+cinternship+"</span></li>" +
				"<li><span class='thelabel'>From </span> <span class='theval'><input id='newfrom' type='text' class='datepicker'/></span></li>" +
				"<li><span class='thelabel'>Till </span> <span class='theval'><input id= 'newtill' type='text' class='datepicker' /></span></li><br/><br/>");
		$( ".datepicker" ).datepicker({ changeYear: true,  yearRange: '1948:2012',changeMonth : true });
		
		}
	
	if (parentdiv == 'pastevents')
	{
	$("div#"+parentdiv+' ul.alternate div#fornew').prepend(
			"<li><span class='thelabel'>Country</span> <span class='theval'>"+cevent+"</span></li>" +
			"<li><span class='thelabel'>When </span> <span class='theval'><input id='neweventwhen' type='text' class='datepicker'/></span></li>" +
			"<li><span class='thelabel'>Type</span> <span class='theval'><select id='neweventtype'><option>IC</option><option>IPM</option></select></span></li>");
	$( ".datepicker" ).datepicker({ changeYear: true,  yearRange: '1948:2012',changeMonth : true });
	
	}
	
	
	
$('input#'+parentdiv).attr('value','Save').removeAttr("disabled");
$(this).attr('disabled','disabled');
}		
);

function deleterole(c)
{
	
	if(confirm('Are you sure you want to remove role?'))
		{
 $("div#pastroles li."+c).slideUp('slow');
 $("div#pastroles a#"+c).fadeOut('slow');
 //$('input#pastroles').attr('value','Save');
 //do ajax that removes
 $.get('/settings/profile/editprofileajax',{edittype:'deleterole',id:c},function(data,status)
		 {
	 	//alert("Delete Successful");
		 });
		}
}

function deleteint(c)
{
	if(confirm('Are you sure you want to remove Internship?'))
	{
 $("div#pastinternships li."+c).slideUp('slow');
 $("div#pastinternships a#d"+c).fadeOut('slow');
 //$('input#pastinternships').attr('value','Save');
 //do ajax
 $.get('/settings/profile/editprofileajax',{edittype:'deleteinternship',id:c},function(data,status)
		 {
	 	if (data == 'success')
	 		{
	 		//alert("Delete Successful");
	 		}
		 });
 
 
 
 
	}
}

function deleteevents(c)
{

	if(confirm('Are you sure you want to remove Event?'))
	{
 $("div#pastevents li."+c).slideUp('slow');
 $("div#pastevents a#d"+c).fadeOut('slow');
 //$('input#pastevents').attr('value','Save');
 //do ajax
 $.get('/settings/profile/editprofileajax',{edittype:'deleteevent',id:c},function(data,status)
		 {
	 	if (data == 'success')
	 		{
	 		//alert("Delete Successful");
	 		}
		 });
 
 
 
 
 
	}
}


function myedit(e,myid)
{
	if (myid == 'personal')
		{
	//bring out the editable form
	$("div#"+myid+" span.theval").each(function()
	{
		var nvalue = $(this).html();
		
		//see if it is facebook or twitter
		var n = nvalue.search("<a");
		if (n != -1)//found
			{
			$(this).fadeOut('slow').html("<input type='text' value='' />").hide().fadeIn('slow');
			}
		else
			{
		$(this).fadeOut('slow').html("<input type='text' value='"+nvalue+"' />").hide().fadeIn('slow');
			}
	}		
	);
	
	$(e).attr('value','Save Changes');
		}
	else
		{
		//the other categories
		}
	
	//change button to save
	//$(e).attr('value','Save Changes');
}

function mysave(e,myid)
{
	//bring back the display form
	
	if (myid == 'personal')
		{
		//do ajax
		
		//return view
		var n = 0;
		var v = new Array();
		$("div#"+myid+" span.theval input[type=text]").each(function()
				{
				v.push($(this).val());
				
				}		
				);
		$("div#"+myid+" span.theval").each(function()
		{
			$(this).html(""+v[n]+"");
			n++;
		}		
		
		);
		
		
		//do ajax
		$.get("/settings/profile/editprofileajax", { edittype:'profile','data[]': v },function(data,status)
					{
			if (status == 'success')
				{
			//alert("Profile Updated Successfully");
				}
			else
				{
				alert('An Unexpected Error Occured, Please Try Again Latter');
				}
			
				});
		
		$(e).attr('value','Edit');
		}
	else
		{
		//the rest
		}
	
	
	//change button to save
	//$(e).attr('value','Edit');
}


$(document).ready(function()
{
$('.btn').toggle(
	function ()
	{
		//get the id
		var myid = $(this).attr('id');
		//function that changes to editable interface
		myedit(this,myid);
	},
	function ()
	{
	var myid = $(this).attr('id');
	//function that save changes and brings back the old interface;
    mysave(this,myid);
	}
);	
}		
);