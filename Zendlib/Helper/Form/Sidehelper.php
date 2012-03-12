<?php

class Helper_Form_Sidehelper extends Zend_View_Helper_Abstract

{
	public function sidehelper()
	{
		$pointer = Zend_Registry::get('url').'/images/pointer.png';
		$module = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
		switch($module)
		{
				case 'a2a':
			{
				
				return "<ul>
				<li><a href='../home'><img src='$pointer' style='vertical-align:middle' />Home</a></li>
				<li><a href='./directory'><img src='$pointer' style='vertical-align:middle' />Alumni Offices</a></li>
				<li><a href='./findalumni'><img src='$pointer' style='vertical-align:middle' />Find Alumni</a></li>
				<li><a href='./start'><img src='$pointer' style='vertical-align:middle' />Starting an Association</a></li>
				<li><a href='./newsletter'><img src='$pointer' style='vertical-align:middle' />Alumni Newsletter</a></li>
				</ul>";
				break;
			}
			case 'a2aiesec':
			{
				return "<ul>
				<li><a href='../home'><img src='$pointer' style='vertical-align:middle' />Home</a></li>
				<li><a href='./recognition'><img src='$pointer' style='vertical-align:middle' />Recognition</a></li>
				<li><a href='./awards'><img src='$pointer' style='vertical-align:middle' />Awards</a></li>
				</ul>";
				break;
			}
			case 'a2w':
			{
				return "<ul>
				<li><a href='../home'><img src='$pointer' style='vertical-align:middle' />Home</a></li>
				<li><a href='./startuphub'><img src='$pointer' style='vertical-align:middle' />Startup Hub</a></li>
				</ul>";
				break;
			}
			default:
			{
				return "<ul>
				<li><a href='../a2aiesec/blog'><img src='$pointer' style='vertical-align:middle' />Blog</a></li>
				<li><a href='../a2w/recognition'><img src='$pointer' style='vertical-align:middle' />Recognition</a></li>
				<li><a href='../a2a/start'><img src='$pointer' style='vertical-align:middle' />Starting an Association</a></li>
				</ul>";
				break;
			}
			
		}
    	
	}
	
}
?>