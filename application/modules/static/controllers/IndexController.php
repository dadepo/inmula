<?php

class Static_IndexController extends Zend_Controller_Action
{
	
	 public function init()
    {
        /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('profilelayout');
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        
   
    }
	
 public function indexAction()
 {
 	echo "Index";
 }
 
 public function welcomeaddressAction()
 {
 	
 }
 

 
}
?>