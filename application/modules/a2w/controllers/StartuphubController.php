<?php

class a2w_StartuphubController extends Zend_Controller_Action
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
	
	public function projectAction()
	{
		$this->view->projectid = $this->getRequest()->getParam('project');
		$this->view->category = $this->getRequest()->getParam('category');
	}
	

		
	public function voteAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disablelayout();
		//takes care of voting
		if ($this->_request->isXmlHttpRequest())
		{
		 $lid = $this->_request->getQuery("lid");
		 $vid = $this->_request->getQuery("vid");
		 //update the db
		 $pdb = new A2a_Model_Projectsdb();
		 $pdb->addVote($lid,$vid);
		 
		 
		 
		}
	
	}
	
	public function addprojectAction()
	{
	//get allparameter
	if ($this->_request->isXmlHttpRequest())
	{
		$pname = $this->_request->getQuery("pname");
		$pdesc = $this->_request->getQuery("pdesc");
		$cat = $this->_request->getQuery("cat");
		$email = $this->_request->getQuery("email");

		$pdb = new A2a_Model_Projectsdb();
		
		
		//set up the input array
		$proj = array('title'=>$pname,'project_desc'=>$pdesc,'cat'=>$cat,'email'=>$email);
		$s = $pdb->addProject($proj);
		//$s is the project ID of the new project just added
		if ($s != 'Error') //then its a success
		{
			
			//update the event
			$url = "/a2a/startuphub/project/?project=$s";
			$d = Zend_Registry::get('url');
			$log = new Events_events();
			
			@session_start();
			$uname = $_SESSION['firstname'] ." ". $_SESSION['lastname'];
			$lid = $_SESSION['aid'];

    		$log->logevents('Just Added New Project',"$uname","$lid", "$d$url",'View Project');
			echo 'success';
		}
		
		
		
		
		
		
		
		
		
		
		
		
	}
	

	$this->_helper->viewRenderer->setNoRender();
	}
	
}

?>