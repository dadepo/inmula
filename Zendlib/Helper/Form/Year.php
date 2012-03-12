<?php

class Helper_Form_Year extends Zend_View_Helper_Abstract

{
	public function year($class='',$id='',$name='')
	{
		
		$year = 1948;
		$html = "<select id='$id' class='$class' name='$name'>";
		while ($year != 2013)
		{
			$html .= "<option value='$year'>$year</option>";
			$year++;
		}
		return $html."</select>";
		
		
	}
}

?>
