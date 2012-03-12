<?php

class A2aiesec_Bootstrap extends Zend_Application_Module_Bootstrap
{

	
		public function _initload()
		{
			
			Zend_Registry::set('url', "http://alumnihub");
			//Zend_Registry::set('url', "http://192.168.0.100");
		}

  
}

?>