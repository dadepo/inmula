<?php


class Helper_Form_Blogfeed extends Zend_View_Helper_Abstract

{
	public function blogfeed($type,$count=3)
	{
		try 
		{
    		$blog = Zend_Feed::import('http://aiesecalumniunite.org/feed/');
		}	 
		catch (Zend_Feed_Exception $e) 
		{
    	// feed import failed
    	echo "Exception caught importing feed: {$e->getMessage()}\n";
    	exit;
		}
		
		// Initialize the channel data array
	$channel = array(
    	'title'       => $blog->title(),
    	'link'        => $blog->link(),
    	'description' => $blog->description(),
    	'items'       => array()
    );
		
		//echo $blog->title();
		
		
		if ($type == 'posts')
		{
		$n = 1;
		echo "<div id='channeltitle' >$blog->title</div>";
		echo "<em id='channeldesc'>$blog->description</em>";
		foreach($blog as $item)
		{
			$img = Zend_Registry::get('url')."/images/rss.png";
			echo "<div class='blogtitle'>$item->title <img src='$img' /></div><br/>";
			echo "<em><strong>Published on:</strong> $item->pubDate </em><br/>";
			echo "<div class='blogcontent'>$item->content </div><br/>";
			
			if ($n == $count) break;
			$n++;
		}
			
		echo "<a href='http://aiesecalumniunite.org/' target='_blank' class='btn success' >Continue Reading</a>";	
			
		}
		
		if ($type == 'titles')
		{
		$n = 1;
		
		foreach($blog as $item)
		{
			//$img = Zend_Registry::get('url')."/images/rss.png";
			echo "<p style='border-bottom:1px dotted #f0f0f0;font-size:11px;padding-bottom:3px;'>$item->title <strong><a href='$item->link' target='_blank'>Read Post Here</a></strong></p>";
			if ($n == $count) break;
			$n++;
		}
			
			
			
		}
	
	
		
		
		
	}
}

?>