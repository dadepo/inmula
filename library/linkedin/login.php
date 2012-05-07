<?php
class linkedin_login extends Zend_Form
{


Protected $API_CONFIG;
Public $profilepix;
Public $firstname;
Public $lastname;
Public $industry;
Public $aid;
Public $headline;
Public $publiclink;


public function getProfilepix()
{
	return $this->profilepix;
}
public function getFirstname()
{
	return $this->firstname;
}
public function getLastname()
{
	return $this->lastname;
}
public function getIndustry()
{
	return $this->industry;
}
public function getAid()
{
	return $this->aid;
}
public function getHeadline()
{
	return $this->headline;
}

Public function  __construct()
    {
    //require_once('linkedin_3.1.1.class.php');
    //set the Appurl
    Zend_Registry::set('url', "http://alumni.aiesec.org");
    $appurl = Zend_Registry::get('url');
    	
    	
    require_once('linkedin_3.3.0.class.php');
    if (!isset($_SESSION))
    {
    	if (!session_start())
			{
				throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
			}
    }
			  // display constants
  			$this->API_CONFIG = array(
    						'appKey'       => '2fxk8bpggjf9',
	  						'appSecret'    => '6hrMQn0raus1IiOy',
	  						'callbackUrl'  => NULL 
  								);
  								
  			/*define('CONNECTION_COUNT', 20);
  			define('PORT_HTTP', '80');
  			define('PORT_HTTP_SSL', '443');
  			define('UPDATE_COUNT', 10);*/
  			
  			$protocol = 'http';
    
    }


public function douserlogin()
{
	try 
		{
		
  			//$API_CONFIG['callbackUrl'] = "http://localhost/linkedin/myaiesec.php?coded=1";
  			$appurl = Zend_Registry::get('url');
  			
  		    $this->API_CONFIG['callbackUrl'] = "$appurl/home";
  			$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
            // check for response from LinkedIn
            $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
       if(!$_GET[LINKEDIN::_GET_RESPONSE]) 
            {
            	//essence of this is to get the request token
            	
              // LinkedIn hasn't sent us a response, the user is initiating the connection
              //send a request for a LinkedIn access token
              $response = $OBJ_linkedin->retrieveTokenRequest();
              if($response['success'] === TRUE) 
              {
              	
                 // store the request token
                 $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
                 
          		
                 // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                 header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
              } 
              else 
              {
              // bad token request
              echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
              }
            } 
      else {
        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
            $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
        	if($response['success'] === TRUE) 
       		{
       			// the request went through without an error, gather user's 'access' tokens
          		$_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
          		// set the user as authorized for future quick reference
          		$_SESSION['oauth']['linkedin']['authorized'] = TRUE;
          		
          		
          		//can i get the profile info here
          		
          		
          		
       
       }
      }
      
      
      
 //get details    
  			
  			
			
			
		}
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
 catch(LinkedInException $e) 
 		{
  
 			 echo $e->getMessage();
		}
	
}


public function grouprecentactivity()
{
	$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
 	if (!isset($_SESSION['oauth_verifier']))
 		{
     		{
     			$appurl = Zend_Registry::get('url');
     			
			header("location:$appurl");
    		}
		}
	
     	//$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_SESSION['oauth_verifier']);	
	
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		
		$response = $OBJ_linkedin->group('693',':(posts:(id,title,creator,site-group-post-url))');
		//$response = $OBJ_linkedin->group('3458045',':(posts:(id,title,creator))');
		//22258
		
		if($response['success'] === TRUE) 
		{
			$res = new SimpleXMLElement($response['linkedin']);
			$output = "";
			try {
				
					if (!@$res->posts[0]->post)
					{
						throw new Exception(0);
						
					}
					
					//print_r($res->posts->post[2]);
					$output = "<div id='row1'>";
					$count = 0;
					foreach ($res->posts->post as $r)
					{
						if ($count == 4)
						break;
						$count++;
						$pix = $r->{'creator'}->{'picture-url'};
						$posturl = $r->{'site-group-post-url'};
						$output .= "<div class='pwrapper'><div class='smallpix'><img width='30px' height='30px' src='$pix' /></div>";
						$output .= '<div style="float:left;margin-left:40px;margin-top:-5px;border-bottom:0px solid #ccc"><span class="titleln">'. $r->{'title'}.'</span><br/>';
						$output .= '<em style="font-size:10px">Posted by:</em><span style="color:#0486b7;font-weight:bold">'.$r->{'creator'}->{'first-name'}. " ";
						$output .= $r->{'creator'}->{'last-name'}.'</span><a style="margin-left:10px" target="_blank" href="'.$posturl.'">view on linkedin</a></div><div style="clear:both"></div></div><br/>';
						
						
					}
					
					$output .= "</div>";
					return $output;
				
			}
			catch (Exception $e)
			{
				if ($e->getMessage() == 0)
				{
					echo "Not Part Of The Group";
				}
			}
			
			
		
		}
	
	
	
	//http://api.linkedin.com/v1/groups/693:(id,name,site-group-url,posts)
	
	//print_r($OBJ_linkedin);
}

public function displaylinkedinprofile()
{
	
	$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	//turn this GET to a Zend
	
	
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
 	if (!isset($_SESSION['oauth_verifier']))
 		{
     		{
     			$appurl = Zend_Registry::get('url');
     			
			header("location:$appurl");
    		}
		}

		$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_SESSION['oauth_verifier']);
		
		if ($response['success'] == TRUE)
		{
			echo "I have retrieved the TokenAcess";
			//set things needed to be set
			$_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
            $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
            
            $appurl = Zend_Registry::get('url');
            
            header("location:$appurl/home");
		}
		
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		$response = $OBJ_linkedin->profile('~:(id,first-name,last-name,industry,picture-url,headline,site-standard-profile-request:(url))');
		//$response = $OBJ_linkedin->profile('~:(id,first-name,last-name,industry,phone-numbers,picture-url,headline,interests,educations,phone-numbers,specialties)');
		
		if($response['success'] === TRUE) 
		{
			
			$response['linkedin'] = new SimpleXMLElement($response['linkedin']);
			$this->profilepix = $response['linkedin']->{'picture-url'};
			$this->firstname = $response['linkedin']->{'first-name'};
			$this->lastname = $response['linkedin']->{'last-name'};
			$this->industry = $response['linkedin']->{'industry'};
			$this->aid = $response['linkedin']->{'id'};
			$this->headline = $response['linkedin']->{'headline'};
			
			$this-> publiclink = $response['linkedin']->{'site-standard-profile-request'}->{'url'};
			
			//var_dump($this->publiclink);
			

			
			
		}
	
}


public function showgroupmember($count = 10)
{
	//show the members of Group on LinkedIN
	
	       $OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		
		$response = $OBJ_linkedin->searchPeople('?keywords=AIESEC&count=25');
		$response = new SimpleXMLElement($response['linkedin']);
		
		
		$count = count($response->{'people'}->{'person'});
		$n = 0;
		
		
		
		

		
		$html = "<ul id='searchgrid'>";
		
		while ($n < $count)
		
		{
		
		//get the URL and Link using id
		$id = (string) $response->{'people'}->{'person'}[$n]->{'id'};
		$firstname = $response->{'people'}->{'person'}[$n]->{'first-name'};
		$lastname = $response->{'people'}->{'person'}[$n]->{'last-name'};
		
		
		$r = $OBJ_linkedin->Profile("$id:(picture-url,site-standard-profile-request:(url))");
		
		$r = new SimpleXMLElement($r['linkedin']);
		$profileurl = $r->{'site-standard-profile-request'}->{'url'};
		$img =  $r->{'picture-url'};
		if($img == '')
		{
			$img = Zend_Registry::get('url');
			$html .= "<li><a title ='$firstname $lastname' href='$profileurl' target='_blank'><img src='$img/images/profilepix.png'/></a></li>";
			$n = $n + 1;
			continue;
		}
		$html .= "<li><a title ='$firstname $lastname' href='$profileurl' target='_blank'><img src='$img'/></a></li>";
		$n = $n + 1;
			
		
		}
		
		$html = $html."</ul>";
		return $html;
		
}










public function showconnections($type='self',$lid = '')
{
	
	if ($type == 'self')
	
	{
	//show the members of Group on LinkedIN
	
	       $OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		$response = $OBJ_linkedin->connections();
		$response = new SimpleXMLElement($response['linkedin']);
		
		$persons = $response->{'person'};
		$count = 0;
		$html = "<ul id='yconnections'>";
		foreach ($persons as $person)
		{
			
			$url = $person->{'picture-url'};
			$purl = $person->{'site-standard-profile-request'}->{'url'};
			if ($url == '')
			{
				$url = Zend_Registry::get('url')."/images/profilepix.png";
				$html .= "<li><a href='$purl' target='_blank'><img src='$url' /></a></li>";
				$count++;
				continue;
			}
			$html .= "<li><a href='$purl' target='_blank'><img src='$url' /></a></li>";			
			$count++;
			if ($count == 20)
			{
			break;
			}
			
		}
		
		$html .= '</ul>';
		return $html;
		
	}
	
	
	else {
		//then its for others
		//show the members of Group on LinkedIN
	
	       $OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		$response = $OBJ_linkedin->connections("$lid/connections");
		$response = new SimpleXMLElement($response['linkedin']);
		
		$persons = $response->{'person'};
		$count = 0;
		$html = "<ul id='yconnections'>";
		foreach ($persons as $person)
		{
			
			$url = $person->{'picture-url'};
			$purl = $person->{'site-standard-profile-request'}->{'url'};
			if ($url == '')
			{
				$url = Zend_Registry::get('url')."/images/profilepix.png";
				$html .= "<li><a href='$purl' target='_blank'><img src='$url' /></a></li>";
				$count++;
				continue;
			}
			$html .= "<li><a href='$purl' target='_blank'><img src='$url' /></a></li>";			
			$count++;
			if ($count == 20)
			{
			break;
			}
			
		}
		
		$html .= '</ul>';
		
		return $html;
		
		
	}
}


public function getMemberurl($mid)
{
	
	$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
 	if (!isset($_SESSION['oauth_verifier']))
 		{
     		{
     			$appurl = Zend_Registry::get('url');
     			
			header("location:$appurl");
    		}
		}
	
     	//$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_SESSION['oauth_verifier']);	
	
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		
		$r = $OBJ_linkedin->Profile("$mid:(site-standard-profile-request:(url))");
		$response = new SimpleXMLElement($r['linkedin']);
		return $response->{'site-standard-profile-request'}->{'url'};
	
		
	
}


public function isGroupmember($groupid = '693')
{
	$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
	if(isset($_GET['oauth_verifier']))
		{
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];
		}
 	if (!isset($_SESSION['oauth_verifier']))
 		{
     		{
     			$appurl = Zend_Registry::get('url');
     			
			header("location:$appurl");
    		}
		}
	
     	//$response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_SESSION['oauth_verifier']);	
	
		//create new OBJ Object
		$OBJ_linkedin = new LinkedIn($this->API_CONFIG);
		$OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
		
		$response = $OBJ_linkedin->groupMemberships(':(group:(id))');
		$response = new SimpleXMLElement($response['linkedin']);
	
		$ismember = 0;
	foreach($response as $r)
	{
		if ("$groupid" == $r->{'group'}->{'id'})
		{
		$ismember =  '1';
		break;	
		}
		
	}
	
	return $ismember;
}














}
?>
