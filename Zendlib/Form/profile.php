<?php
class Form_profile extends Zend_Form
{

	public function init()
{
// initialize form

	
//this adds the decorator class
$this->addprefixPath('Form_Decorator','Form/Decorator','decorator');	




$this->setAction('/settings/updateprofile')->setMethod('post');

$this->setDecorators(array(
'FormElements',
array('HtmlTag',array('tag'=>'ul','placement' => 'REPLACE')),
'Form'
));
// create text input aieseccountry
$aieseccountry = new Zend_Form_Element_Text('aieseccountry');
$aieseccountry->setLabel('AIESEC Country:')
->setOptions(array('size' => '35'))
->setRequired(true)
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');



// create text input aieselc
$lc = new Zend_Form_Element_Text('lc');
$lc->setLabel('Local Committee:')
->setOptions(array('size' => '35'))
->setRequired(true)
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');


// create text input aieselc
$roles = new Zend_Form_Element_Text('roles');
$roles->setLabel('Role Title:')
->setOptions(array('size' => '35'))
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');

$roles1 = new Zend_Form_Element_Text('roles1');
$roles1->setLabel('Role Title:')
->setOptions(array('size' => '35'))
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');

// create text input aieselc
$internships = new Zend_Form_Element_Text('internships');
$internships->setLabel('AIESEC Internships:')
->setOptions(array('size' => '35'))
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');

$internships1 = new Zend_Form_Element_Text('internships1');
$internships1->setLabel('AIESEC Internships:')
->setOptions(array('size' => '35'))
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');


// create text input aieselc
$events = new Zend_Form_Element_Text('events');
$events->setLabel('AIESEC Events:')
->setOptions(array('size' => '35'))
->addValidator('NotEmpty', true)
->addValidator('Alpha', true)
->addFilter('HTMLEntities')
->addFilter('StringTrim');





// create submit button
$submit = new Zend_Form_Element_Submit('submit');
$submit->setLabel('Submit')
->setOptions(array('class' => 'btn primary'));



$this->addElement($aieseccountry)
->addElement($lc)
->addElement($roles)
->addElement($roles1)
->addElement($internships)
->addElement($internships1)
//->addElement($events)
->addElement($submit);




$this->setElementDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li'))
));



$aieseccountry->setDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li')),
array('Header',array('placement'=>'PREPEND','text'=>'AIESEC Entity')),
));


$roles->setDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li')),
array('Header',array('placement'=>'PREPEND','text'=>'Past Roles in AIESEC')),
array('Datedecorator',array('placement'=>'APPEND','text'=>'roles')),
));

$roles1->setDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li')),
array('Datedecorator',array('placement'=>'APPEND','text'=>'roles1')),
array('Utilitydecorator',array('placement'=>'APPEND','text'=>'addmorebutton')),
));

$internships->setDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li')),
array('Header',array('placement'=>'PREPEND','text'=>'Past Internships in AIESEC')),
array('Datedecorator',array('placement'=>'APPEND','text'=>'internships')),
));

$internships1->setDecorators(array('ViewHelper',
'Label',
array(array('p'=>'HtmlTag'),array('tag'=>'p')),
array(array('data'=>'HtmlTag'),array('tag'=>'li')),
array('Datedecorator',array('placement'=>'APPEND','text' => 'internships1')),
array('Utilitydecorator',array('placement'=>'APPEND','text'=>'addmorebutton')),
));






$submit->setDecorators(array('ViewHelper'));


}





}
?>

