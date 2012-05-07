<?php
//Ok, I agree there is no many code duplication in here
//optimization -- make the creation of the db object part of the private class so it is done only once/
class Helper_Form_Showprofile extends Zend_View_Helper_Abstract
//class declaration into a class varibales so you dont have to call it again in the different if blocks
{
	public $current;
	
	public function showprofile($type='',$edit='',$others='',$id='',$roles='')
	{
		
		if ($others==true)
		{
			if ($type == 'personal')
			{
				$db = new Settings_Model_Profiledb();
						@session_start();
						
						$r = $db->getMember($id);
						//first store the data for Activities
						$this->current = $r->present_role;
						echo "<ul class='alternate'>";
						
						echo "<li><span class='thelabel' >Name </span> <span class='theval'>$r->lname</span></li>";
						echo "<li><span class='thelabel' >AIESEC Country </span><span class='theval'> $r->aiesec_country</span></li>";
						echo "<li><span class='thelabel' >AIESEC LC </span><span class='theval'> $r->aiesec_lc</span></li>";
						
						
						$facebook = ($r->facebook != Null)? $r->facebook : 'Not Available';
						if ($facebook == 'Not Available')
						{
							$fblink = '#';
						}
						else 
						{
							$fblink = "http://www.facebook.com/$facebook";
						}
						$twitter = ($r->twitter != Null)? $r->twitter : 'Not Available';
						
						if ($twitter == 'Not Available')
						{
							$twitterlink = '#';
						}
						else 
						{
							$twitterlink = "http://www.twitter.com/$twitter";
						}
						
						
						
						
						
						
						
						echo "<li><span class='thelabel' >Facebook </span><span class='theval'><a target='_blank' href='$fblink'>$facebook</a></span></li>";
						echo "<li><span class='thelabel' >Twitter </span><span class='theval'><a target='_blank' href='$twitterlink'>$twitter</a></span></li>";
						echo "<li><span class='thelabel' >Email </span><span class='theval'>$r->emails</span></li>";
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
			}
			if ($type == 'pastroles')
			{
										//need to get the personal info
						$db = new Settings_Model_Roles();
						$r = $db->getPastroles($id);
						
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$title = $c['rtitle'];
							$country = $c['rcountry'];
							$fromdate = $c['fromdate'];
							$todate = $c['todate'];
							echo "<li><span class='thelabel' >Role Title</span><span class='theval'>$title</span></li>
							<li><span class='thelabel' >Where</span><span class='theval'>$country</span></li>
							<li><span class='thelabel' >From</span><span class='theval'>$fromdate</span></li>
							<li><span class='thelabel' >Till</span><span class='theval'>$todate</span></li>"; 
							
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul><br/><br/>";
			}
			if ($type == 'pastinternships')
			{
										
						//need to get the personal info
						$db = new Settings_Model_Internships();
						$r = $db->getInternships($id);
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$company = $c['company'];
							$country = $c['internship_country'];
							$fromdate = $c['from_date'];
							$todate = $c['to_date'];
							echo "<li><span class='thelabel' >Company</span><span class='theval'>$company</span></li>
							<li><span class='thelabel' >Where</span><span class='theval'>$country</span></li>
							<li><span class='thelabel' >From</span><span class='theval'>$fromdate</span></li>
							<li><span class='thelabel' >Till</span><span class='theval'>$todate</span></li>"; 
							
						}
						
						echo "</ul><br/>";
			}
			if ($type == 'pastevents')
			{
						$db = new Settings_Model_Pastevents();
						$r = $db->getEvents($id);
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$country = $c['country_event'];
							$year = $c['year_event'];
							$type = ($c['type_event'] == 'IC') ? 'International Congress' : 'International Presidents Meeting';
							
							echo "<li><span class='thelabel' >Country </span><span class='theval'>$country</span></li>
							<li><span class='thelabel' >When </span><span class='theval'>$year</span></li>
							<li><span class='thelabel' >Type </span><span class='theval'>$type</span></li>"; 
							
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
			}
			if ($type == 'activities')
			{
				

						$roles = explode(',', $this->current);
						$count = 1;
					
					if (count($roles) > 1)
					{
						echo "<ul class='alternate'>";
						
					
						foreach ($roles as $role)
						{
							if ($role == 'boa')
							$role = "Board of Advisors";
							
							if ($role == 'intern_taker')
							$role = "Intern Takers";
							
							if ($role == 'sponsor')
							$role = "Sponsors";
							echo "<li>$count) <span class='theval'>$role</li>";
							$count++;
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}
			}
			
			
		}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//this part of code is used when the current signed in user is viewing their own profile
		
		else 
		{
		
		//echo "$type $edit";
	
		
		
		$html = 'ul';
		
		
		switch($type)
		{
			case 'personal':
					if ($edit == 'yes')
					{
						//need to get the personal info
						$db = new Settings_Model_Profiledb();
						@session_start();
						$r = $db->getMember($_SESSION['aid']);
						
						
						
						//first store the data for Activities
						$this->current = $r->present_role;
						echo "<div id='personal'>";
						echo "<ul class='alternate'>";
						echo "<li><span class='thelabel' >Name </span> <span class='theval'>$r->lname</span></li>";
						echo "<li><span class='thelabel' >AIESEC Country </span> <span class='theval'> $r->aiesec_country</span></li>";
						echo "<li><span class='thelabel' >AIESEC LC </span> <span class='theval'> $r->aiesec_lc</span></li>";
						
						
						
						$facebook = ($r->facebook != Null)? $r->facebook : 'Not Available';
						if ($facebook == 'Not Available')
						{
							$fblink = '#';
						}
						else 
						{
							$fblink = "http://www.facebook.com/$facebook";
						}
						$twitter = ($r->twitter != Null)? $r->twitter : 'Not Available';
						
						if ($twitter == 'Not Available')
						{
							$twitterlink = '#';
						}
						else 
						{
							$twitterlink = "http://www.twitter.com/$twitter";
						}
						
						
						echo "<li><span class='thelabel' >Facebook </span><span class='theval'><a target='_blank' href='$fblink'>$facebook</a></span></li>";
						echo "<li><span class='thelabel' >Twitter </span><span class='theval'><a target='_blank' href='$twitterlink'>$twitter</a></span></li>";
						echo "<li><span class='thelabel' >Email </span><span class='theval'>$r->emails</span></li>";
						echo "<li><input type='button' value='Edit' id='personal' class='btn primary personal' /></li>";
						echo "</ul>";
						echo "</div>";
					}
					if ($edit == 'no')
					{
						
						//need to get the personal info
						$db = new Settings_Model_Profiledb();
						@session_start();
						$r = $db->getMember($_SESSION['aid']);
						//first store the data for Activities
						$this->current = $r->present_role;
						echo "<ul class='alternate'>";
						echo "<li><span>Name </span> $r->lname</li>";
						echo "<li><span>AIESE Country </span> $r->aiesec_country</li>";
						echo "<li><span>AIESE LC </span> $r->aiesec_lc</li>";
						
						if(isset($r->facebook))
						echo "<li><span>Facebook </span><a target='_blank' href='http://www.facebook.com/$r->facebook'>$r->facebook</a></li>";
						else
						echo "<li><span>Facebook </span><a target='_blank' href=''>Not Available</a></li>";
						
						
						if($r->twitter != '')
						echo "<li><span>Twitter </span><a target='_blank' href='http://www.twitter.com/$r->twitter'>$r->twitter</a></li>";
						else
						echo "<li><span>Twitter </span><a target='_blank' href=''>Not Available</a></li>";
						
						echo "<li><span>Email </span>$r->emails</li>";
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}
			break;
			
			
			case 'pastroles':
				if ($edit == 'yes')
					{
						
						//need to get the personal info
						
						$db = new Settings_Model_Roles();
						$r = $db->getPastroles($_SESSION['aid']);
						echo "<div id='pastroles'>";
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							$count = $c['id'];
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$title = $c['rtitle'];
							$country = $c['rcountry'];
							$fromdate = $c['fromdate'];
							$todate = $c['todate'];
							echo "<li class='$count'><span class='thelabel' >Role Title </span> <span class='theval'>$title</span></li>";
							echo "<li class='$count'><span class='thelabel' >Where </span> <span class='theval'>$country</span></li>";
							echo "<li class='$count'><span class='thelabel' >from </span> <span class='theval'>$fromdate</span></li>";
							echo "<li class='$count'><span class='thelabel' >Till </span> <span class='theval'>$todate</span></li>";
							
							
							echo "<a id='$count' class='btn danger deleter' onclick='deleterole($count)'>Delete</a>";
							
							echo "<br/><br/>";
							
							
							
						}
						echo "<div id='fornew'></div>";
						echo "<li><input type='button' value='Add New' id='addpastroles' class='btn addbtn'/>
						<input type='button' value='Save' id='pastroles' disabled='disabled' class='btn primary' />

						</li>";
						echo "</ul>";
						echo "</div>";
						
					}
					if ($edit == 'no')
					{
						//need to get the personal info
						$db = new Settings_Model_Roles();
						$r = $db->getPastroles($_SESSION['aid']);
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$title = $c['rtitle'];
							$country = $c['rcountry'];
							$fromdate = $c['fromdate'];
							$todate = $c['todate'];
							echo "<li><span>Role Title</span>$title
							<span>Where</span>$country
							<span>From</span>$fromdate
							<span>Till</span>$todate</li>"; 
							
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}
			break;
			
			
			
			case 'pastinternships':
						if ($edit == 'yes')
					{
						
						//need to get the personal info
						$db = new Settings_Model_Internships();
						$r = $db->getInternships($_SESSION['aid']);
						echo "<div id='pastinternships'>";
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							$count = $c['id'];
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$company = $c['company'];
							$country = $c['internship_country'];
							$fromdate = $c['from_date'];
							$todate = $c['to_date'];
							
							echo "<li class='$count'><span class='thelabel' >Company </span> <span class='theval'>$company</span></li>";
							echo "<li class='$count'><span class='thelabel' >Where </span> <span class='theval'>$country</span></li>";
							echo "<li class='$count'><span class='thelabel' >From </span> <span class='theval'>$fromdate</span></li>";
							echo "<li class='$count'><span class='thelabel' >Till </span> <span class='theval'>$todate</span></li>";
							echo "<a id='d$count' class='btn danger deleter' onclick='deleteint($count)'>Delete</a>";
							echo "<br/><br/>";
							
							
						}
						echo "<div id='fornew'></div>";
						echo "<li><input type='button' value='Add New' id='addpastinternships' class='btn addbtn'/>
						<input type='button' value='Save' disabled='disabled' id='pastinternships' class='btn primary' />
						</li>";
						echo "</ul>";
						echo "</div>";
						
					}
					if ($edit == 'no')
					{
						//need to get the personal info
						$db = new Settings_Model_Internships();
						$r = $db->getInternships($_SESSION['aid']);
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$company = $c['company'];
							$country = $c['internship_country'];
							$fromdate = $c['from_date'];
							$todate = $c['to_date'];
							echo "<li><span>Company</span>$company
							<span>Where</span>$country
							<span>From</span>$fromdate
							<span>Till</span>$todate</li>"; 
							
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}		
				
			break;
			
			
			
			
			
			case 'pastevents':
						if ($edit == 'yes')
					{
						$db = new Settings_Model_Pastevents();
						$r = $db->getEvents($_SESSION['aid']);
						echo "<div id='pastevents'>";
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							$count = $c['id'];
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$country = $c['country_event'];
							$year = $c['year_event'];
							$type = ($c['type_event'] == 'IC') ? 'International Congress' : 'International Presidents Meeting';
							
							
							echo "<li class='$count'><span class='thelabel' >Country </span> <span class='theval'>$country</span></li>";
							echo "<li class='$count'><span class='thelabel' >When </span> <span class='theval'>$year</span></li>";
							echo "<li class='$count'><span class='thelabel' >Type </span> <span class='theval'>$type</span></li>";
							
							
							echo "<a id='d$count' class='btn danger deleter' onclick='deleteevents($count)'>Delete</a>";
							echo "<br/><br/><br/>";

							
						}
						echo "<div id='fornew'></div>";
						echo "<li><input type='button' value='Add New' id='addpastevents' class='btn addbtn'/>
						<input type='button' value='Save' disabled='disabled' id='pastevents' class='btn primary' />
						</li>";
						echo "</ul>";
						echo "</div>";
					}
					if ($edit == 'no')
					{
						$db = new Settings_Model_Pastevents();
						$r = $db->getEvents($_SESSION['aid']);
						echo "<ul class='alternate'>";
						foreach($r as $c)
						{
							//echo "<li><span>Role Title </span> $c['rtitle'] </li>";
							$country = $c['country_event'];
							$year = $c['year_event'];
							$type = ($c['type_event'] == 'IC') ? 'International Congress' : 'International Presidents Meeting';
							
							echo "<li><span>Country </span>$country
							<span> When </span>$year
							<span> Type </span>$type"; 
							
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}	
			break;
			
			
			
			
			case 'activities':
				if ($edit == 'yes')
					{
						
							$roles = explode(',', $this->current);
					    echo "<div id='activities'>";
						echo "<ul class='alternate'>";
						foreach ($roles as $role)
						{
							if ($role == 'boa')
							$role = "Board of Advisors";
							
							if ($role == 'intern_taker')
							$role = "Intern Takers";
							
							if ($role == 'sponsor')
							$role = "Sponsors";
							echo "<li><span class='theval'>$role</span></li>";
						}
						
						
						//echo "<li><input type='button' value='Edit' id='activities' class='btn primary' /></li>";
						echo "</ul>";
						echo "</div>";
						
					}
					if ($edit == 'no')
					{
						
						
						$roles = explode(',', $this->current);
					
						echo "<ul class='alternate'>";
						foreach ($roles as $role)
						{
							if ($role == 'boa')
							$role = "Board of Advisors";
							
							if ($role == 'intern_taker')
							$role = "Intern Takers";
							
							if ($role == 'sponsor')
							$role = "Sponsors";
							echo "<li>$role</li>";
						}
						//echo "<li><input type='button' value='Edit' class='btn primary' /></li>";
						echo "</ul>";
					}
				
				
				break;
		}
	}
	}
}

?>