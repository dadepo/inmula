<?php

class Home_IndexController extends Zend_Controller_Action
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
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        echo $bootstrap->c;
       
        
		$linkedin = new linkedin_login();
		$linkedin->displaylinkedinprofile();
		
        
        
        
        
      		//Cache the class
		$frontendoption = array('cache_id_prefix' => 'loudbite_',
		'lifetime' => 900,
		'cached_entity' => new Linkedin_login(),
		'cached_methods' => array('grouprecentactivity'));
		//Backend attributes
		$backendOptions = array('cache_dir' => '../application/tmp');
		//Create Zend_Cache object
		$cache = Zend_Cache::factory('Class',
									'File',
								$frontendoption,$backendOptions);
		
		
									
		@session_start();
		$_SESSION['cache'] = $cache;
        
	
		$this->view->recentlinkedin = $cache->grouprecentactivity();
		
		
		
		//get recent activities
		$log = new Events_events();
		$this->view->recentevents = $log->displayevents();


        
        
        
        


        
    }

    
    
  

}

