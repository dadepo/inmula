<?php
class Events_events
{

private $c;
	
public function __construct()
{

	$user = Zend_Registry::get('user');
	$password = Zend_Registry::get('password');
	$db = Zend_Registry::get('database');

	$this->c = mysql_connect('localhost',$user,$password);
	mysql_select_db($db,$this->c);
}

public function logevents($desc,$uname,$lid,$link='',$linkdesc='')
{
	//Events model?
	
	
	try {
	$r = mysql_query("INSERT into events(edesc,link,linkdesc,uname,linkedin) values('$desc','$link','$linkdesc','$uname','$lid')");
	if(!$r)
		{
		  throw new Exception(mysql_error());
		}
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
}

public function displayevents($id='')
{
	//return 
	//id
	//desc
	//time
	//link
	//linkdesc
	
	
	//first get the name of the user using $id
	
	try {
	$r = mysql_query("select * from events order by eid desc limit 5",$this->c);
	if(!$r)
		{
		throw new Exception(mysql_error);
		}
	
	
		return $r;
		
	
		
		
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	
}


}

