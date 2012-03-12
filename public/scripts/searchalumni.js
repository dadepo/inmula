/**
 * 
 */



$(document).ready(function()
		
{
	
var appurl = $('input#appurl').val();	


$('button#searchbtn').click(function()
{
 var alname = $('input#searchname').val(); 
 //both were clicked
 if($('input#searchtype').is(":checked") && $('input#searchtypelinkedin').is(":checked"))
	 {
	 
	 return;
	 }
 
 if($('input#searchtypelinkedin').is(":checked"))
 {
 return;
 }
 
 
 if($('input#searchtype').is(":checked"))
 {
	 $.get(appurl+'/a2a/findalumniajax',{tosearch:alname,searchtype:'hub'},function(response,status)
	{
		 if(status == 'success')
			 {
			 $('div#searchresultorganic').html(response).hide().slideDown('slow');
			 }
		 
		 
	}		 
	 );
	 return;
 }
 
 //if none
 if(!$('input#searchtype').is(":checked") && !$('input#searchtypelinkedin').is(":checked"))
 {
 	 if (filter == 0)
		 {//if no filters is set
	 $.get(appurl+'/a2a/findalumniajax',{tosearch:alname,searchtype:'hub'},function(response,status)
				{
					 if(status == 'success')
						 {
						 $('div#searchresultorganic').html(response).hide().slideDown('slow');
						 }
					 
					 
				}		 
				 );
		 }
	 else
		 {
		 //if filters are set
		 var event = $('select#events').val();
		 var country = $('select#country').val();
		 
		 $.get(appurl+'/a2a/findalumniajax',{tosearch:alname,searchtype:'hub',filter:event,filterc:country},function(response,status)
					{
						 if(status == 'success')
							 {
							 $('div#searchresultorganic').html(response).hide().slideDown('slow');
							 }
						 
						 
					}		 
					 );
		 
		 }
 }
 
 
 
 
}		
);	
}

);