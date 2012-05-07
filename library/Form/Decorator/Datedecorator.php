<?php

class Form_Decorator_Datedecorator extends Zend_Form_Decorator_Abstract

{
public function render($content)
	{
		//var_dump($content);
		$placement = $this->getPlacement();
		
		
		$name = $this->getOption('text');
		$output = "<div style='margin-left:140px;background-color:#f9f9f9;border:1px solid #f3f3f3;padding:10px;margin-bottom:10px;'><div style='float:left;margin-right:5px;'><span>From</span><br/><input class='medium datepicker' type='date' name='from_date_$name'/></div><div><span>To</span><br/><input class='medium datepicker' type='date' name='to_date_$name' /><br/><br/></div></div>";
		switch($placement)
		{
			case 'PREPEND':
				return $output . $content;
				break;
			case 'APPEND':
				return $content . $output;
		}
	}
}

?>