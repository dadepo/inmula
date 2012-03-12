<?php

class A2aiesec_BlogController extends Zend_Controller_Action
{
 public function init()
    {
        /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('twocolumn');
    	 $this->view->title = "AlumniHub :: Blog";
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        
   
    }
	public function indexAction()
	{
		
	}
}

?>