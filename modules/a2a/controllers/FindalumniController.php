<?php

class A2a_FindalumniController extends Zend_Controller_Action
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
 	       $linked = new linkedin_login();
 	       
 	       //need to cache this
 	       //using Session now
 	       //would move to something central like cache
 	       
 	       
 	      
 	       @session_start();
 	       if(!isset($_SESSION['groupmembers']))
 	       {
 	       	echo "doing it the first time";
 	       	$gm = $linked->showgroupmember();
 	       $this->view->groupmembers = $gm; 
 	       $_SESSION['groupmembers'] = $gm;
 	       }
 	       else 
 	       {
 	       	$this->view->groupmembers = $_SESSION['groupmembers'];
 	       }
 	       
 	
 	       
 }
    
}
?>
