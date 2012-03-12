<?php

class a2a_Model_Projectsdb extends Zend_Db_Table_Abstract
{
protected $_name = 'projects';



public function addProject($proj)
{
	@session_start();
	$lid = $_SESSION['aid'];
	$data = array(
	'linkedin' => "$lid",
	'title' => $proj['title'],
	'project_desc' => $proj['project_desc'],
	'cat' => $proj['cat'],
	'email' => $proj['email']
	);
	
	if(!$this->insert($data))
	{
		echo "Error";
	}
	else 
	{
		
		$title = $proj['title'];
		$desc = $proj['project_desc'];
		
		$result = $this->fetchAll(
			$this->select()
			->where('title = ?',$title)
			->where('project_desc = ?',$desc)
			);
			
			
		if ($result)
		{
		return ($result[0]['projectid']);
		}
		
		
	
		
		
		
		
		
		
	
	}
	
		
}

public function fetchProject($type, $pid='', $count = '10')
{
		if ($type == 'all')
		{

		$r = $this->fetchAll(
		$this->select()
		->order('projectid DESC')
		->limit(10)
		);
		return $r;
		}
		if ($type == 'single' && is_numeric($pid))
		{

			$r = $this->fetchRow(
			$this->select()
			->where('projectid = ?',$pid)
			);
			if(!$r)
			{
				echo mysql_error();
			}
			
			
			
			return $r;	
		}
		
	if ($type == 'single' && !is_numeric($pid))
		{
		
			
			
			$rowset = $this->fetchAll($this->select()->where('cat LIKE ?', "%$pid%")->order('projectid DESC'));
 
		// Echo the value of the bug_description column

			if(!$rowset)
			{
				echo mysql_error();
			}
			else 
			{
				return $rowset;
			}
		}
		
		
		
}

public function columnCount($like)
{
	//this is a temp thing. Find a way to use PDO to do this
	$conn = mysql_connect('localhost','','');
	mysql_selectdb('alumnihub');
	$r = mysql_query("select count(cat) from projects where cat like '%$like%'");
	if(!$r)
	{
		echo mysql_error();
	}
	else 
	{
	list($count) = mysql_fetch_row($r);
	return $count;
	}
	
	
	
}


public function addVote($lid,$pid)
{
	//check if this lid has already voted for this vid
	$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    'host'     => '127.0.0.1',
    'username' => '',
    'password' => '',
    'dbname'   => ''
));

$result = $db->fetchAll("SELECT * FROM votes where projectid='$pid' AND linkedinid='$lid'");
if (count($result) == 0)
{
	//new vote then add to database;
	$r = $db->insert('votes', array('projectid' => $pid, 'linkedinid' => $lid ));
	$result = $db->fetchAll("SELECT count(*) as vcount from votes where projectid='$pid'");
	echo ($result[0]['vcount']);

}
else 
{
	
	echo "Already Voted";
}



}

}

?>
