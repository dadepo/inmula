<?php
//TODO remove all waring supression
class Settings_UpdateprofileController extends Zend_Controller_Action
{
    /**
     * The default action - show the home page
     */
	
private $errormsg = array(); //used to move error message from indexAction to errorAction
	
	
    public function indexAction()
    {
    	
    	$formData = $this->getRequest()->getPost();
    	//if it is not set then redirect back
    	
    	
    	
    	if(count($formData) == 0)
    	{
    		header("location:/settings");
    	}
    	
    	
        //print_r($formData['presentrole']);	
        
    	//$validator = new Zend_Validate_EmailAddress();
    	
    	
    	
        $db = new Settings_Model_Profiledb();
        
    	$validator = new Zend_Validate_Alpha();
    	$emailv = new Zend_Validate_EmailAddress();
    	
    	/*
		if (!$validator->isValid(trim($formData['aieseccountry']))) 
		{
		   $this->errormsg['aieseccountry'] = 'AIESEC Country must contain only Alphabets'; 
		  
		} 
		
    	if (!$validator->isValid(trim($formData['homelc']))) 
		{
		   $this->errormsg['homelc'] = 'AIESEC LC must contain only Alphabets';
		    
		} */
		
    	if (!$emailv->isValid(trim($formData['emails']))) 
		{
		   $this->errormsg['email'] = 'You must enter a valid email';
		} 
		
		if (count($this->errormsg) != 0)
		{
			
			@session_start();
			$_SESSION['singinerror'] = $this->errormsg;
			$this->_redirect('/settings/updateprofile/error');
			
			
			
		}
		
		
		

        
        @$db->addMember($formData['aieseccountry'], $formData['homelc'], $formData['presentrole'],$formData);
         
        
        
        //update the event
        $log = new Events_events();
        @session_start();
		$uname = $_SESSION['firstname'] ." ". $_SESSION['lastname'];
		
		$lid = $_SESSION['aid'];
		//http://alumni.aiesec.org/settings/profile/members?id=5tV4qaRbPf
		$d = Zend_Registry::get('url')."/settings/profile/members?id=".$lid;
		
		
		
        $log->logevents('Just Updated Their Profile',"$uname","$lid", "$d",'View Profile');
        
    	$this->_redirect('/settings/profile/');
        
        
    	//$log = new Events_events();
    	//$log->logevents('Just Updated His Profile','http://www.google.com','Check his profile');
    	
    	/*
$filters = array('month' => array('StringTrim' , 'StripTags'));
$validators = array(
					'month' => 'Alpha',
					'days' => 'Alpha'
					);
					
$input = new Zend_Filter_Input($filters, $validators, $_GET);

if ($input->isValid()) {
    // do something with form
    echo 1111;
} else {
    // failed validation
    $messages = $input->getMessages();
    var_dump($messages);
    // iterate though $messages to display to user
}

        */
    	
        /*$db = new Settings_Model_Profiledb();
        $form = new Form_Profile();
        if ($this->getRequest()->isPost())
        {
        	$formData = $this->getRequest()->getPost();
        	/*if ($form->isValid($this->getRequest()->getPost())) {
        	print_r($formData);
        	}*/
        	
        	
        	
        	//get linkedin ID
        	/*$linkedin = new Linkedin_login();
        	$linkedin->displaylinkedinprofile();
        	$linkedin = $linkedin->aid;
        	
        	$formData = $this->getRequest()->getPost();
        	$roles = array();
        	$internships = array();
        	
        	$roles[] = array($formData['roles'],$formData['from_date_roles'], $formData['from_date_roles']);
        	$roles[] = array($formData['roles1'],$formData['from_date_roles1'], $formData['from_date_roles1']);
        	
        	$internships[] = array($formData['internships'],$formData['from_date_internships'], $formData['from_date_internships']);
        	$internships[] = array($formData['internships1'],$formData['from_date_internships1'], $formData['from_date_internships1']);
        	
        	
        	
        	
        	
        	$db = new Settings_Model_Profiledb();
        	
        	$db->addMember($linkedin,$formData,$roles,$internships);
        	
        	
        	
        	
        }*/
        
}



public function errorAction()

{
	@session_start();
	$this->view->errormsg = $_SESSION['singinerror'];
	$this->render('error');
}

}

?>
