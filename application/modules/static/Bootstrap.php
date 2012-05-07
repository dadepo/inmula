<?php

class Static_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
		protected function _initload()
		{
		
		
		$view = new Zend_View();
		$view->addHelperPath('Helper/Form', 'Helper_Form');
	
		   Zend_Registry::set('url', "http://alumni.aiesec.org");
			//Zend_Registry::set('url', "http://192.168.0.100");
		
		
		}
		
		
	
	
		

  
}

?>