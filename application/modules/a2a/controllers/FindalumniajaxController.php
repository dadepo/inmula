<?php

class A2a_FindalumniajaxController extends Zend_Controller_Action
{
        
    
 public function indexAction()
 {
 $this->_helper->getHelper('viewRenderer')->setNoRender();
 $this->_helper->getHelper('layout')->disablelayout();
 
 if ($this->_request->isXmlHttpRequest())
		{
		 $tosearch = $this->_request->getQuery("tosearch");
		 $searchtype = $this->_request->getQuery("searchtype");
		 $filter = $this->_request->getQuery("filter");
		 $country = $this->_request->getQuery("filterc");
		 
		 		 
		 if ($tosearch != '')
		 {//you are searching based on input, input should not be empty
		 	if($searchtype == 'hub' && !isset($filter))
		 	{
		 		$html = "<h6 id='result'>Search Result for <em>$tosearch</em></h6><ul>";
		 		$db = new Settings_Model_Profiledb();
		 		$q = (string) $tosearch[0].$tosearch[1].$tosearch[2];
		 		$r = $db->getQuery("$q");
		 		$r = $r->toArray();
		 		foreach($r as $result)
		 			{
		 				$profilepix = $result['profile_pix'];
		 				$lname = $result['lname'];
		 				$purl = $result['lid'];
		 				$profileurl = Zend_Registry::get('url')."/settings/profile/members?id=$purl";
		 				$html .= "<li><a href='$profileurl'><img src='$profilepix'/></a><br/><span>$lname</span></li>";
		 			}
		 	$html .= '</ul>';
		 	echo $html;
		 	}

		 if($searchtype == 'linkedin')
		 	{
		 		
		 	}
		 	
		 if($searchtype == 'both' && $searchtype == 'none')
		 	{
		 		
		 	}
		 	
		 }
		if ($tosearch == '' OR $tosearch != '' )
		 {
		 	
		 	if($searchtype == 'hub' && isset($filter))
		 	{
		 		$html = "<h6 id='result'>Search Result Using <em>Filters</em></h6><ul>";
		 		$db = new Settings_Model_Profiledb();
		 		$r = $db->getQueryWithSub("$filter","$country");
		 		

		 		while(list($profile_pix,$lname,$lid) = mysql_fetch_row($r))
		 		{
		 			$purl = $lid;
		 			$profileurl = Zend_Registry::get('url')."/settings/profile/members?id=$purl";
		 			$html .= "<li><a href='$profileurl'><img src='$profile_pix'/></a><br/><span>$lname</span></li>";
		 		}
		 		$html .= '</ul>';
		 		echo $html;
		 	}
		 	
		 	
		 }
		 
		 
		 
		 
		 
		 
		}
 
 }
 
}
?>