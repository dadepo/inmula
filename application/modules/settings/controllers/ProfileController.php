<?php
class Settings_ProfileController extends Zend_Controller_Action
{

    public function init()
    {
    	
    	 /* Initialize action controller here */
    	 $layout = $this->_helper->layout();
    	 $layout->setLayout('profilelayout');
    	 // action body
        //$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	 
        //if code is appended to the end of the url
        //check if it is a visitor visiting or the user itself
        //if visitor display information
        //if user, direct to /profile
        
    	$lid = $this->_request->getQuery();
    	//echo $lid;
    	if (Zend_Controller_Front::getInstance()->getRequest()->getActionName() == 'index' )
    	{
    		
    	}
    	else 
    	{
    		//get the action name
    		$profileid = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
    		//if it is the same with the user, redirect to /profile
    		@session_start();
    		if ($profileid == $_SESSION['aid'])
    		{
    			
    			$this->_redirect('/settings/profile/');
    			
    		}
    		
    		
    	}
   
    }
    
    
    
    public function indexAction()
    {
    	//@session_start();
    	//if ($this->_request->getQuery("user") == $_SESSION['aid'])
    	//{
    		//this is not needed
    		//$this->_redirect('/settings/profile/');
    		
    	//}
    	
    	
    	 $l = new linkedin_login();
         $this->view->connections = $l->showconnections();
    	 
    	
    	
    	
    }
    
    
public function allAction()
    {
	//silence is golden
	//ok not that golden
	//picks the all.phtml view file
    }
    
 public function membersAction()
    {
	if ($this->_request->getQuery("id") == $_SESSION['aid'])
    	{
    		//this is not needed
    		$this->_redirect('/settings/profile/');
    		
    	}
    	
    	//get the needed properties you need
    	
    	
    	$db = new Settings_Model_Profiledb();
    	//first all check if the user exist
    	$r = $db->getMember($this->_request->getQuery("id"));
    	if (count($r) == 0)
    	{
    		$this->_helper->viewRenderer->setRender('nouserfound');
    	}
    	else
    	{
    		//get the info for the user
    		$this->view->id = $r['lid'];
    		$this->view->lname = $r['lname'];
    		$this->view->profilepix = $r['profile_pix'];
    		$this->view->industry = $r['industry'];
    		$this->view->headline = $r['headline'];
    		$this->view->aiesec_country = $r['aiesec_country'];
    		$this->view->aiesec_lc = $r['aiesec_lc'];
    		$this->view->present_role = $r['present_role'];
    		
    		//get connection of user
    		$l = new Linkedin_login();
            $this->view->connections = $l->showconnections('others',$this->view->id);
            //get this user public url
            
            $this->view->memberurl = $l->getMemberurl($r['lid']); 
            
    		
    	}
    }
    
    
    public function editprofileajaxAction()
    {
    	//this is called via ajax by the editprofile.js script
    	$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disablelayout();
		
		if ($this->_request->isXmlHttpRequest())
		{
			
			if( $this->_request->getQuery("edittype") == 'roles')
			{
				$data = array();
				$data['newrole'] = $this->_request->getQuery("newrole");
				$data['newwhere'] = $this->_request->getQuery("newwhere");
				$data['newform'] = $this->_request->getQuery("newfrom");
				$data['newtill'] = $this->_request->getQuery("newtill");
				
			
				$db = new Settings_Model_Roles();
				if($db->updateRole($data))
				{
					return 'success';
				}
				
			}
			
			
			
			if( $this->_request->getQuery("edittype") == 'internships')
			{
				$data = array();
				$data['newcoy'] = $this->_request->getQuery("newcoy");
				$data['newwhere'] = $this->_request->getQuery("newwhere");
				$data['newform'] = $this->_request->getQuery("newfrom");
				$data['newtill'] = $this->_request->getQuery("newtill");
				$db = new Settings_Model_Internships();
				print ($db->updateInternships($data));
				
			}
			
			if( $this->_request->getQuery("edittype") == 'events')
			{
				$data = array();
				$data['newcountry'] = $this->_request->getQuery("newcountry");
				$data['newwhen'] = $this->_request->getQuery("newwhen");
				$data['newtype'] = $this->_request->getQuery("newtype");
				$db = new Settings_Model_Pastevents();
				print ($db->updateEvents($data));
				
			}
			
		if( $this->_request->getQuery("edittype") == 'profile')
			{
				
				$db = new Settings_Model_Profiledb();
				$data = $this->_request->getQuery("data");
				print $db->updateProfile($data);
				
				
				
				
			}
			
			if( $this->_request->getQuery("edittype") == 'deleterole')
			{
				$db = new Settings_Model_Roles();
				
				$db->deleteRole($this->_request->getQuery("id"));
				print $this->_request->getQuery("id");
			}
			
			
			
		if( $this->_request->getQuery("edittype") == 'deleteinternship')
			{
				$db = new Settings_Model_Internships();
				
				print($db->deleteInternship($this->_request->getQuery("id")));
                
			}
			
		if( $this->_request->getQuery("edittype") == 'deleteevent')
			{
				$db = new Settings_Model_Pastevents();
				
				print($db->deleteEvent($this->_request->getQuery("id")));
                
			}
		
		if( $this->_request->getQuery("edittype") == 'getcountry')
			{
				$cid = $this->_request->getQuery("cid");
				
				print $this->view->aiesecmcs("","$cid","");
				
				
                
			}
			
			
			
			
			
			
			
		}
		
    }
    
}  
?>
