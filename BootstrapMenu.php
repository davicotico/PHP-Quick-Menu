<?php

require 'QuickMenu.php';

class BootstrapMenu extends QuickMenu
{
    public function __construct($options = array())
    {
        parent::__construct($options);
        $this->setDropdownIcon('<i class="caret"></i>');
        $this->set('ul-root', array('class'=>'nav navbar-nav', 'id'=>'#myMenu'));
        $this->set('ul', array('class'=>'dropdown-menu'));
        $this->set('li-parent', array('class'=>'dropdown'));
        $this->set('li', array('class'=>'test-classitem'));
        $this->set('a-parent', array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"));
    }
}
