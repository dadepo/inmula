<?php
//dont know why Zend_Registry set in linkedin_login is failing and i had to reset the domain again



class Settings_LogoutController extends Zend_Controller_Action
{

    public function init()
    {
        //kill session
        //kill cache
        //redirect
        
        @session_start();
        if (count($_SESSION) == 0)
        {
        $url = Zend_Registry::get('url'); 
		header("location:$url");
        }
        $cache = $_SESSION['cache'];
        $cache->remove('loudbite_');
        session_destroy();
        
        //okay i am going to use CURL to logout. Which is probably not the best thing to do
        // 1. initialize  
		$ch = curl_init();
  
		// 2. set the options, including the url  
		curl_setopt($ch, CURLOPT_URL, "https://www.linkedin.com/secure/login?session_full_logout=&trk=hb_signout");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");  
		curl_setopt($ch, CURLOPT_HEADER, 0);  
  
		// 3. execute and fetch the resulting HTML output  
		$output = curl_exec($ch);  
		//echo $output;
		//get the info
		$info = curl_getinfo($ch);
		$info =  $info['http_code'];
		if ($info == 200)
		{
		// 4. free up the curl handle  
		curl_close($ch); 
		$url = Zend_Registry::get('url'); 
		header("location:$url");
			
		}
		
		
		
		$this->_helper->viewRenderer()->setNoRender();
		
		
		
  
		
        
        
        
        
        
        
        
        
        
    	 
        
   
    }
}  
?>