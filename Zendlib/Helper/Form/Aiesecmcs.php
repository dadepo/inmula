<?php

class Helper_Form_Aiesecmcs extends Zend_View_Helper_Abstract

{
	public function aiesecmcs($class='',$id='',$name='',$na='yes')
	{
		//should i be connecting to the database from here
		//should view helpers have access to DB
		//read on how to write plugins that connects to DB
		$c = mysql_connect('localhost','','');
		mysql_selectdb('alumnihub');
		
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
