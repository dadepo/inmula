<?php

class Settings_IndexController extends Zend_Controller_Action
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
    	//if user already added their AIESEC
    	$db = new Settings_Model_Profiledb();
    	@session_start();
    	if (count($db->getMember($_SESSION['aid'])) == 1)
    	{
    	//redirect back to profile
    	$this->_redirect('settings/profile'); 	
    	}
    	
    	
    	
    	
    	$front = Zend_Controller_Front::getInstance();
    	$bootstrap = $front->getParam("bootstrap");
    	
    	

        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        //echo $bootstrap->c;
        
        //$bootstrap->bootstrap('dade');
        //$this->getFrontController()->getParam('bootstrap')->dade();
        //print_r($bootstrap->bootstrap('Dade'));
        
        /*$linkedin = new Linkedin_login();
        $linkedin->displaylinkedinprofile();
        /*$this->view->profilepix = $linkedin->profilepix;
        $this->view->firstname = $linkedin->firstname;
		$this->view->lastname = $linkedin->lastname;
		$this->view->industry = $linkedin->industry;*/
        
       /* $this->view->placeholder('profilepix')->set($linkedin->profilepix);
        $this->view->placeholder('firstname')->set($linkedin->firstname);
        $this->view->placeholder('lastname')->set($linkedin->lastname);
        $this->view->placeholder('industry')->set($linkedin->industry);
        $this->view->placeholder('headline')->set($linkedin->headline);
        $this->view->placeholder('addaiesec')->set(1);
        
        
        $form = new Form_Profile();
        $this->view->form = $form;*/
        
    	
        

        
    }



}

