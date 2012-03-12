<?php

class Settings_Model_Internships extends Zend_Db_Table_Abstract
{
protected $_name = 'past_internships';

public function addInternships($id,$formData)
{
	
//count the number of past roles submited
$count = count($formData['coy']);
$n = 0;
		while ($n < $count)
		{
			
			$data = array(
			'lid'=>$id,
			'company'=>$formData['coy'][$n],
			'internship_country'=>$formData['countryinternship'][$n],
			'internship_lc'=>$formData['lci'][$n],
			'from_date'=>$formData['fromdatei'][$n],
			'to_date'=>$formData['todatei'][$n],
			);
			
			$this->insert($data);
			$n++;
		}
	
	
}

public function getInternships($lid)
{
	$r = $this->fetchAll(
	$this->select()
	->where('lid = ?',$lid)
	);
	
	return($r->toArray());
}


public function updateInternships($newdata)
{
	@session_start();
	
	
	
	
	$data = array(
	'lid'=>$_SESSION['aid'],
	'company'=>$newdata['newcoy'],
	'internship_country'=>$newdata['newwhere'],
	'from_date'=>$newdata['newform'],
	'to_date'=>$newdata['newtill']
	
	);
	
	if($this->insert($data))
	{
		return 'success';
	}
	
}


public function deleteInternship($lid)
{
	if($this->delete("id = $lid"))
	{
		return 'success';
	}
}





}

?>