<?php

class Settings_Model_Pastevents extends Zend_Db_Table_Abstract
{
protected $_name = 'past_events';

public function addEvents($id,$formData)
{
	
//count the number of past roles submited
$count = count($formData['coy']);
$n = 0;
		while ($n < $count)
		{
			
			$data = array(
			'lid'=>$id,
			'country_event'=>$formData['countryevent'][$n],
			'year_event'=>$formData['yearevent'][$n],
			'type_event'=>$formData['typeevent'][$n],
			);
			
			$this->insert($data);
			$n++;
		}
	
	
}


public function getEvents($lid)
{
	$r = $this->fetchAll(
	$this->select()
	->where('lid = ?',$lid)
	);
	
	return($r->toArray());
}




public function updateEvents($newdata)
{
	@session_start();

		$data = array(
	'lid'=>$_SESSION['aid'],
	'country_event'=>$newdata['newcountry'],
	'year_event'=>$newdata['newwhen'],
	'type_event'=>$newdata['newtype']
	
	);
	
	if($this->insert($data))
	{
		return 'success';
	}
	
}




public function deleteEvent($lid)
{
	$this->delete("id = $lid");
}







}

?>