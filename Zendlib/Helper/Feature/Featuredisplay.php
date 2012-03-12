<?php
//this view just dsplay the link to features

class Helper_Feature_Featuredisplay extends Zend_View_Helper_Abstract

{
	public $url;
	public function featuredisplay($type)
	{
		$this->url = Zend_Registry::get('url');
		echo "<div id='row2'><h3>Quick Tools</h3><ul id='displayf'>
		<a id='directory'  href='$this->url/a2a/directory'><li></li></a>
		<a id='findalumni'  href='$this->url/a2a/findalumni'><li></li></a>
		<a id='startuphub'  href='$this->url/a2a/startuphub'><li></li></a>
		</ul></div>";
	}
}

?>