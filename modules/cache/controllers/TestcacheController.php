<?php
class Cache_TestcacheController extends Zend_Controller_Action
{

	
	
	
public function indexAction()
{
	//Frontend attributes of what we're caching.
	$frontendoption = array('cache_id_prefix' => 'loudbite_',
	'lifetime' => 900);
	
	//Backend attributes
	$backendOptions = array('cache_dir' => '../application/tmp');
	
	//Create Zend_Cache object
	$cache = Zend_Cache::factory('Core',
	'File',
	$frontendoption,
	$backendOptions);
	
	//Create the content to cache.
	$time = date('Y-m-d h:m:s');
	
	//Check if we want to retrieve from cache or not.
if(!$myTime = $cache->load('mytime')){
//If the time is not cached cache it.
$cache->save($time, 'mytime');
$myTime = $time;
}else{
echo "Reading from cache<br>";
}
echo "Current Time: ".$myTime;
//Suppress the view
$this->_helper->viewRenderer->setNoRender();
	
}

}
?>