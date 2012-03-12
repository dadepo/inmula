<?php


class Helper_Form_Showprojects extends Zend_View_Helper_Abstract
{
	private $pdb;
	private $db; //for alternate db connection. This is not optimal, a much better gateway should be used
	public function __construct()
	{
		$this->pdb = new A2a_Model_Projectsdb();
		$this->db = new Zend_Db_Adapter_Pdo_Mysql(array(
    'host'     => 'localhost',
    'username' => '',
    'password' => '',
    'dbname'   => 'alumnihub'
));
	}
	
	private function timediff($time)
	{
				$now = time() + 7200; //utc plus 2hr
				$uploaded = @strtotime("$time");
				//echo strtotime('2012-01-20 14:10:18');
				
				 

				$diff = abs($now - $uploaded);
				
				
				if ($diff > 86400)
				{
					//its more than a day
					$timediff = floor(($diff/86400))." Days Ago";
				}
				
				if ($diff >= 3600 && $diff <= 86400)
				{
					$timediff = floor(($diff/3600))." Hour(s) Ago";
					
				}
				
				
				
			if ($diff >= 60 && $diff <= 3600)
				{
					$timediff = "Less than a hour ago";
				}
				
				if ($diff < 60)
				{
					$timediff = "Just a moment ago";
				}
				
				
				return $timediff;
				
	}
	
	
	public function showprojects($type = 'all',$pid='')
	{
		$url = Zend_Registry::get('url');
		switch($type)
		{
			case 'all':
			//get the model to connect to the database
			$projects = $this->pdb->fetchProject('all',10);
			$html = "<div id='listofprojects'>";
			foreach($projects as $proj)
			{
				$projectid = $proj['projectid'];
				
				$result = $this->db->fetchAll("SELECT count(*) as vcount from votes where projectid='$projectid'");
				
				
				$count = $result[0]['vcount'];
				
				
				$lid = $proj['linkedin'];
				$title = $proj['title'];
				$desc = $proj['project_desc'];
				$cat = $proj['cat'];
				$email = $proj['email'];
				$time = (string) $proj['time'];
				
				
				$profilepix = $this->db->fetchRow("SELECT profile_pix from alumni where lid='$lid'");
				$profilepix = $profilepix['profile_pix'];
				
				
				
				
				
				
				
				//should i make the time difference into a controller plugin?
				//would it cost resource
				
				$timediff = $this->timediff($time);
				 
				
				$html .= "<div id='project'>
				
				<span class='title'>$title<br/><span class='meta'>Submitted $timediff</span><br/><div id='votewraper'><img class='vup' onclick='voteup($projectid)' src='$url/images/voteup.png'/><span id='votes$projectid'> $count </span></div></span><br/>
				<span class='innerleft'>
				<a href='$url/settings/profile/members?id=$lid'><img class='pix' src='$profilepix'/></a>
				</span>
				<span class='desc'>$desc
				<br/><br/><br/>
				<span class='email'><em>Contact<span>$email</span> to colloborate</em></span><br/>
				<span class='cat'>$cat</span><br/>
				</span><br/>
				
				
				
				</div>
				";
				
				
			}
			$html = $html."</div>";
			echo $html;
				
			break;
			case 'single':
						//get the model to connect to the database
			$html = "<div id='listofprojects'>";
			
			if (is_numeric($pid))
			{
				//then it is project
			$proj = $this->pdb->fetchProject('single',$pid);
			
			
			$projectid = $proj['projectid'];
			$result = $this->db->fetchAll("SELECT count(*) as vcount from votes where projectid='$projectid'");
			$count = $result[0]['vcount'];	
				
				
				
				
				$lid = $proj['linkedin'];
				$title = $proj['title'];
				$desc = $proj['project_desc'];
				$cat = $proj['cat'];
				$email = $proj['email'];
				$time = $proj['time'];
				
				
				
				$timediff = $this->timediff($time);
				
				$profilepix = $this->db->fetchRow("SELECT profile_pix from alumni where lid='$lid'");
				$profilepix = $profilepix['profile_pix'];
				
				
				
				$html .= "<div id='project'>
				
				<span class='title'>$title<br/><span class='meta'>Submitted $timediff</span><br/><div id='votewraper'><img class='vup' onclick='voteup($projectid)' src='$url/images/voteup.png'/><span id='votes$projectid'> $count </span></div></span><br/>
				<span class='innerleft'>
				<a href='$url/settings/profile/members?id=$lid'><img class='pix' src='$profilepix'/></a>
				</span>
				<span class='desc'>$desc
				<br/><br/><br/>
				<span class='email'><em>Contact<span>$email</span> to colloborate</em></span><br/>
				<span class='cat'>$cat</span><br/>
				</span><br/>
				
				
				
				</div>
				";
				
			$html = $html."</div>";
			echo $html;
			}
			
			if (!is_numeric($pid))
			{
				//then it is search for category
			$projects = $this->pdb->fetchProject('single',"$pid");
			
			$url = Zend_Registry::get('url');
			
			$html = "<div id='listofprojects'>";
			foreach($projects as $proj)
			{
				
				$projectid = $proj['projectid'];
				
				$result = $this->db->fetchAll("SELECT count(*) as vcount from votes where projectid='$projectid'");
				$count = $result[0]['vcount'];
				
				
				
				$lid = $proj['linkedin'];
				$title = $proj['title'];
				$desc = $proj['project_desc'];
				$cat = $proj['cat'];
				$email = $proj['email'];
				$time = $proj['time'];
				
				$profilepix = $this->db->fetchRow("SELECT profile_pix from alumni where lid='$lid'");
				$profilepix = $profilepix['profile_pix'];
				
				$timediff = $this->timediff($time);
				
				$html .= "<div id='project'>
				
				<span class='title'>$title<br/><span class='meta'>Submitted $timediff </span><br/><div id='votewraper'><img class='vup' onclick='voteup($projectid)' src='$url/images/voteup.png'/><span id='votes$projectid'> $count </span></div></span><br/>
				<span class='innerleft'>
				<a href='$url/settings/profile/members?id=$lid'><img class='pix' src='$profilepix'/></a>
				</span>
				<span class='desc'>$desc
				<br/><br/><br/>
				<span class='email'><em>Contact<span>$email</span> to colloborate</em></span><br/>
				<span class='cat'>$cat</span><br/>
				</span><br/>
				
				
				
				</div>
				";
				
				
			}
			$html = $html."</div>";
			echo $html;
				
				
				
				
				
				
				
				
			}
			
				
			break;
				
		}

		
	
	


		
	}
}

?>
