<?php
class Helper_Form_Hubmembers extends Zend_View_Helper_Abstract

{
	public function hubmembers($count = '5')
	{
	echo "<ul>";
	$db = new Settings_Model_Profiledb();
	$members = $db->getAllMembers(20);
	foreach ($members as $m)
	{
		$lid = $m['lid'];
		$profilepix = $m['profile_pix'];
		$url = Zend_Registry::get('url');
		
		echo "<li><a href='$url/settings/profile/members?id=$lid'><img style='width:35px;height:35px' src='$profilepix' /></a></li>";
		
	}
	echo "</ul>";	
	}
}
?>