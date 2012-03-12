<?php


class Helper_Form_Uploadproject extends Zend_View_Helper_Abstract

{
	public function uploadproject($divid ='')
	{
		
		echo <<<HTML
		<div id="$divid">
		<form method='GET' action='addproject.php'>
		<span class='form'>Name Of Your Project</span>
		<input type='text' name='nproject' id='nproject' placeholder='' class='xlarge' style='width:400px'/>
		<span class='form'>Detailed Description of Project <em id='wordcount'>1000</em></span>
		<textarea name='tareaproject' id='tareaproject' maxlength='1000'></textarea>
		<span class='form'>Categories</span>
		<div style='margin:0px 0px;padding:5px;background-color:#f9f9f9'>
		<input name='cat' value='social' type='checkbox'/>Social 
		<input name='cat' value='technology' type='checkbox'/>Technology 
		<input name='cat' value='career' type='checkbox'/>Career 
		<input name='cat' value='government' type='checkbox'/>Government<br/>
		<input name='cat' value='education' type='checkbox'/>Education
		<input name='cat' value='charity' type='checkbox'/>Charity
		<input name='cat' value='health' type='checkbox'/>Health
		<input name='cat' value='others' type='checkbox'/>Others</div>
		<span class='form'>Contact Email</span>
		<input type='text' name='email' id='email' placeholder=''/><input type='button' class='btn primary' value='Add Project' id='addprojectbtn' />
		</div>
		</form>
HTML;
	
	


		
	}
}

?>