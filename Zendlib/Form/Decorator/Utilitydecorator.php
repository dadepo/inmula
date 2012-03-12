<?php

class Form_Decorator_Utilitydecorator extends Zend_Form_Decorator_Abstract

{
public function render($content)
	{
		//var_dump($content);
		$placement = $this->getPlacement();
		$text = $this->getOption('text');
		
		switch ($text)
		{
			case 'addmorebutton':
				$output = "<img style='margin-left:140px;margin-bottom:10px;' src='../images/addmore.png' /><br/>";
				break;
			
		}
		
		
		
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