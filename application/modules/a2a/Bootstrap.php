<?php

class A2a_Bootstrap extends Zend_Application_Module_Bootstrap
{

	
		protected function _initAutoload()
		{

			Zend_Registry::set('url', "http://alumni.aiesec.org");
			
		}

  
}

?>
