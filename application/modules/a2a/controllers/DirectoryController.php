<?php

class A2a_DirectoryController extends Zend_Controller_Action
{
        
 public function init()
    {
        /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('twocolumn');
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        
   
    }
    
    
	
	
    public function indexAction ()
    {
        // TODO Auto-generated IndexController::indexAction() default action
        
        $db = new A2a_Model_alumnioffices();
        $this->view->offices = $db->getOffices();
        
    }
    
    
   
}


?>