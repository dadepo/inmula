<?php

class Linkedinlogin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('master_home');
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        
   
    }
    

    public function indexAction()
    {
        //the Index action should check if the user is logged in.
        //if not then send them to the contraller that handles login
       if (0)
       {
       	//send to home
       }
       else
       {
       	//redirect to do login
       	$this->_redirect('linkedinlogin/index/dologin/');
       }
    }

    
    
 	public function dologinAction()
    {
        //the Index action should check if the user is logged in.
        //if not then send them to the controller that handles login
       $this->render('index');
       $linked = new linkedin_login();
       $linked->douserlogin();
       
       echo $this->getRequest()->getQuery('name');
    }

}

?>
