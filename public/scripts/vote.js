/**
 * 
 */

var appurl;
$(document).ready(function()
{
	
	
	appurl = $('input#appurl').val();	
	
	
}		

);

function voteup(vid)
{
	
	
	var linkedinid = $('#profileid').html();
	
	
	
	
	
	$.get(appurl+'/a2w/startuphub/vote',{lid:linkedinid,vid:vid},function(response,status)
			{
				if (response != "Already Voted")
					{
					//then vote successful and now update
					$('span#votes'+vid).html(" " + response + " ");
					
					}
				else
					{
					alert("Already Voted");
					}
			});
	
	
}
