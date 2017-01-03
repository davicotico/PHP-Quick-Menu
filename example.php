<?php 
/**
* @author David Ticona Saravia
*/
include "QuickMenu.php";
$str = '[{"text":"aaa", "href": "http://aaa.com", "title": "t1"}, {"text":"aaa2", "href": "#", "title": "t2", "children": [{"text":"aaa21", "href": "h21", "title": "t21"}, {"text":"aaa22", "href": "h22", "title": "t22"}]}, {"text":"aaa3", "href": "h3", "title": "t3", "icon": "fa-ok"}]';
$m = new QuickMenu(array('data'=>$str));
$m->setProperties('ul-root', array('class'=>'root', 'id'=>'#myMenu'));
$m->setProperties('ul', array('class'=>'node'));
$m->setProperties('li-root', array('data-toggle'=>'tooltip'));
$m->insert(array("text"=>'Fin', "href"=>'http://fin', "title"=>'titleAdd'));
$m->insert(array("text"=>'insert', "href"=>'http://add', "title"=>'titleAdd'), "aaa2");
$m->insert(array("text"=>'insert21', "href"=>'http://add21', "title"=>'titleAdd', "children"=>[['text'=>'i', 'href'=>'i', 'title'=>'i'], ['text'=>'i2', 'href'=>'i2', 'title'=>'i2']]), "aaa1122", "aaa2");
echo $m->html();
