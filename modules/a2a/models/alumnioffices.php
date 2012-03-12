<?php

class A2a_Model_Alumnioffices extends Zend_Db_Table_Abstract
{
	
	protected $_name = 'alumni_offices';
	
	public function getOffices($count='20')
	{
		$r = $this->fetchAll(
	);
	
	return($r->toArray());
	}
}