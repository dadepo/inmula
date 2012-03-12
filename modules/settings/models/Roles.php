<?php


class Settings_Model_Roles extends Zend_Db_Table_Abstract
{
protected $_name = 'past_roles';

public function addRole($id,$formData)
{
	
	
	
//count the number of past roles submited
$count = count($formData['rtitle']);
$n = 0;
		while ($n < $count)
		{
			
			$data = array(
			'lid'=>$id,
			'rtitle'=>$formData['rtitle'][$n],
			'rcountry'=>$formData['country'][$n],
			'rlc'=>$formData['lc'][$n],
			'fromdate'=>$formData['fromdate'][$n],
			'todate'=>$formData['todate'][$n],
			);
			
			
			$this->insert($data);
			$n++;
		}
	
	
}



public function getPastroles($lid)
{
		$r = $this->fetchAll(
	$this->select()
	->where('lid = ?',$lid)
	);
	
	return($r->toArray());
	
}

public function updateRole($newdata)
{
	@session_start();
	
	
	
	
		$data = array(
	'lid'=>$_SESSION['aid'],
	'rtitle'=>$newdata['newrole'],
	'rcountry'=>$newdata['newwhere'],
	'fromdate'=>$newdata['newform'],
	'todate'=>$newdata['newtill']
	
	);
	
	$this->insert($data);
	
}



public function deleteRole($lid)
{
	$this->delete("id = $lid");
}






}

?>