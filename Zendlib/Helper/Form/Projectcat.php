<?php


class Helper_Form_Projectcat extends Zend_View_Helper_Abstract

{
	public function projectcat()
	{
		//get social category
		$db = new A2a_Model_Projectsdb;
		$count_social = $db->columnCount('social');
		$count_tech = $db->columnCount('technology');
		$count_career = $db->columnCount('career');
		$count_gov = $db->columnCount('government');
		$count_edu = $db->columnCount('education');
		$count_charity = $db->columnCount('charity');
		$count_health = $db->columnCount('health');
		$count_others = $db->columnCount('others');
		
		$url = Zend_Registry::get('url');
		$url = $url."/a2w/startuphub/project/?category";
		
		
		echo "<h6 class='h6'>Projetcs By Category</h6>
		<ul id='catlisting'>
		<li><a href=$url=social>Social ($count_social)</a></li>
		<li><a href=$url=technology>Technology ($count_tech)</a></li>
		<li><a href=$url=career>Career ($count_career)</a></li>
		<li><a href=$url=government>Government ($count_gov)</a></li>
		<li><a href=$url=education>Education ($count_edu)</a></li>
		<li><a href=$url=charity>Charity ($count_charity)</a></li>
		<li><a href=$url=health>Health ($count_health)</a></li>
		<li><a href=$url=others>Others ($count_others)</a></li>
		</ul>";
	}
}

?>