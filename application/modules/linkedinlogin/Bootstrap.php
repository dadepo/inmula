<?php

class Linkedinlogin_Bootstrap extends Zend_Application_Module_Bootstrap
{

	protected function _initload()
		{
		
		
		Zend_Registry::set('url', "http://alumni.aiesec.org");
		//Zend_Registry::set('url', "http://192.168.0.100");
		}

  
}

?>