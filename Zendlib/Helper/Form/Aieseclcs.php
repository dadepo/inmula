<?php

class Helper_Form_Aieseclcs extends Zend_View_Helper_Abstract

{
	public function aieseclcs($class='',$id='',$name='')
	{
		//should i be connecting to the database from here
		//should view helpers have access to DB
		//read on how to write plugins that connects to DB
		$c = mysql_connect('localhost','','');
		mysql_selectdb('alumnihub');
		
		try {
		$r = mysql_query("select * from lc order by lc_name");
		if(!$r)
		{
			throw new Exception(mysql_error());
		}
		
		$html = "<select class='$class' id='$id' name='$name'>";
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
