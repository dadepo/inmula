<?php
class Re_Resource_Test
extends Zend_Application_Resource_ResourceAbstract
{
	protected $_options = array(
        'doctype'         => 'XHTML1_STRICT',
        'title'           => 'Site Title',
        'title_separator' => ' :: ',
    );
	
	
   public function init()
    {
    	$bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('View');
        $view = $bootstrap->getResource('View');
        $view->headTitle('Zend Framework');
    }
}

?>