<?php 
//this is totally not needed!
//you dont have to have another Controller to tell people to join the group
//ok move this to Action of an already existing Controller
class Home_JoinController extends Zend_Controller_Action
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