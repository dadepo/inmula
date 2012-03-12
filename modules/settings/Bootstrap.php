<?php

class Settings_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
		protected function _initload()
		{
		
		
		$view = new Zend_View();
		$view->addHelperPath('Helper/Form', 'Helper_Form');
		
		
			
			Zend_Registry::set('url', "http://alumni.aiesec.org");
			//Zend_Registry::set('url', "http://192.168.0.100");
		
		
		}
		
		
	
	//protected function _initSettingsAutoload()
	//{
		
		/*$moduleLoader = new Zend_Application_Module_Autoloader(array(
        'namespace' => '', 
        'basePath'  => APPLICATION_PATH.'/../library',
		));
		$moduleLoader->addResourceType('form','Form/','Form');*/
		//var_dump($moduleLoader);
		//exit;
	//}
		

  
}

?>