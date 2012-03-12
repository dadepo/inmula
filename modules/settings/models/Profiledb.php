<?php


class Settings_Model_Profiledb extends Zend_Db_Table_Abstract
{
protected $_name = 'alumni';


public function addMember($aieseccountry='',$lc='',$presentrole='na',$formData)
{
	//formData holds the other variables
	//infact form data should be the only thing passed (fixed this so no need to pass the first 3 variables)
	@session_start();
	
	
	
	$data = array(
		'lid' => (string) $_SESSION['aid'],
		'lname' => (string) $_SESSION['firstname']." ". (string) $_SESSION['lastname'],
		'profile_pix' => (string) $_SESSION['profilepix'],
		'industry' => (string) $_SESSION['industry'],
		'headline' => (string) $_SESSION['headline'],
		'aiesec_country' => $aieseccountry,
		'aiesec_lc' => $lc,
		'present_role' => @implode(',', $presentrole),
		'facebook'=> $formData['facebook'],
		'twitter'=>$formData['twitter'],
		'emails'=>$formData['emails'],
		);
		
		$this->insert($data);
		
		//now add to the past roles tables
		//get the model for past roles table
		
		$rdb = new Settings_Model_Roles();
		$rdb->addRole($_SESSION['aid'],$formData);

		//now add to the past internship table
		
		$rdb = new Settings_Model_Internships();
		$rdb->addInternships($_SESSION['aid'],$formData);
		
		//add to past event table
		$rdb = new Settings_Model_Pastevents();
		$rdb->addEvents($_SESSION['aid'],$formData);
		
		//then no errors
		//
		//redirect to their profile page
		
}

public function getMember($lid)
{
	//
	$r = $this->fetchRow(
	$this->select()
	->where('lid = ?',$lid)
	);
	
	return $r;
}

public function getAllMembers($limit=5)
{
	//
	$r = $this->fetchAll(
	$this->select()
	->limit($limit)
	);
	
	return $r;
} 

public function getQuery($q)
{
	$r = $this->fetchAll(
	$this->select()
	->where('lname LIKE ?', "%$q%")
	);
	
	return $r;
}


public function getQueryWithSub($q,$c='')
{
	//this is a temp thing. Find a way to use PDO to do this
	$conn = mysql_connect('localhost','','');
	mysql_selectdb('alumnihub');
	
	//if $c is set, then this should take preference in the filter
	if(isset($c))
	{
	$c = (string) trim(ucfirst(strtolower($c)));
	
	$r = mysql_query("select profile_pix,lname,lid from alumni where aiesec_country = '$c'");	
	}
	else 
	{
	$r = mysql_query("select profile_pix,lname,lid from alumni where lid in (select lid from past_events where type_event = '$q') ");	
	}
	
	
	if(!$r)
	{
		echo mysql_error();
	}
	else 
	{
	return $r;
	}
	
}






public function updateProfile($moddata)
{
	$data = array(
	'lname'=>$moddata[0],
	'aiesec_country'=>trim($moddata[1]),
	'aiesec_lc'=>trim($moddata[2]),
	'facebook'=>trim($moddata[3]),
	'twitter'=>trim($moddata[4]),
	'emails'=>trim($moddata[5])
	);
	@session_start();
	$id = $_SESSION['aid'];
	
	return ($this->update($data,"lid = '$id'"));
}


}

?>
