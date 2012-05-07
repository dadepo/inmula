<?php
class Helper_Form_Hubmembers extends Zend_View_Helper_Abstract

{
	public function hubmembers($count = '20',$dimension = '35px')
	{
	echo "<ul>";
	$db = new Settings_Model_Profiledb();
	$members = $db->getAllMembers($count);
	foreach ($members as $m)
	{
		$lid = $m['lid'];
		$profilepix = $m['profile_pix'];
		$lname = $m['lname'];
		$aiesec_country = $m['aiesec_country'];
		if ($profilepix == '')
		{
		 $profilepix = "$url/images/profilepix.png";	
		}
		$url = Zend_Registry::get('url');
		
		echo "<li><a href='$url/settings/profile/members?id=$lid' title='$lname from $aiesec_country'><img style='width:$dimension;height:$dimension' src='$profilepix' /></a></li>";
		
	}
	
	echo "</ul>";	
	}
}
?>