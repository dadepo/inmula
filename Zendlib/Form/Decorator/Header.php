<?php


class Form_Decorator_Header extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		//var_dump($content);
		$placement = $this->getPlacement();
		
		
		$text = $this->getOption('text');
		$output = "<h3 class='form_title'>". $text."</h3>";
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