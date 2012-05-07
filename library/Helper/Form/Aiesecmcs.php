<?php

class Helper_Form_Aiesecmcs extends Zend_View_Helper_Abstract

{
	public function aiesecmcs($class='',$id='',$name='',$na='yes')
	{
		
		$user = Zend_Registry::get('user');
		$password = Zend_Registry::get('password');
		$db = Zend_Registry::get('database');
		
		
		$c = mysql_connect('localhost',$user,$password);
		mysql_selectdb($db);
		
		try {
		$r = mysql_query("select * from countries");
		if(!$r)
		{
			throw new Exception(mysql_error());
		}
		
		$html = "<select class='$class' id='$id' name='$name'>";
		if ($na == 'yes')
		$html .= "<option value='na'>Not Applicable</option>";
		while(list($id,$name,$region) = mysql_fetch_row($r))
		{
			
			$html .= "<option value='$name'>$name</option>";
		}
		$html = $html . "</select>";
		
		return $html;
		
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		
		
	}
}

?>
