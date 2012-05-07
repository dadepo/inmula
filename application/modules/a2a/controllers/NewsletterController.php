<?php

class A2a_NewsletterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('twocolumn');
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        
   
    }
    
    
    public function indexAction()
    {
    	
    }
}


?>