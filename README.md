# PHP Quick Menu
Esta clase PHP permite crear un menu Html a partir de una string Json. Por favor **califica este repositorio**, pues de esa forma voy a saber que este trabajo está siendo útil.
La clase tiene parámetros de configuración, explicados en este tutorial: **http://codeignitertutoriales.com/php-menu-dinamico-multinivel/**

![Yes](http://codeignitertutoriales.com/wp-content/uploads/2017/01/php-menu-dinamico-multinivel.jpg)

### Input
```
[{
	"text": "Home",
	"href": "#home",
	"title": "Home"
}, {
	"text": "About",
	"href": "#",
	"title": "About",
	"children": [{
		"text": "Action",
		"href": "#action",
		"title": "Action"
	}, {
		"text": "Another action",
		"href": "#another",
		"title": "Another action"
	}]
}, {
	"text": "Something else here",
	"href": "#something",
	"title": "Something else here"
}]
```

### Output
```html
<ul class="nav navbar-nav" id="#myMenu">
   <li><a href="#home" title="Home">Home</a></li>
   <li class="dropdown">
      <a href="#" title="About" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <i class="caret"></i></a>
      <ul class="dropdown-menu">
         <li><a href="#action" title="Action">Action</a></li>
         <li><a href="#another" title="Another action">Another action</a></li>
      </ul>
   </li>
   <li><a href="#something" title="Something else here">Something else here</a></li>
</ul>
```
# How to use
* Extend the QuickMenu class for customization. For instance Bootstrap menu. (This is optional)
```php
require 'QuickMenu.php';
class BootstrapMenu extends QuickMenu
{
    public function __construct($options = array())
    {
        parent::__construct($options);
        $this->set('dropdownIcon', '<i class="caret"></i>');
        $this->set('ul-root', array('class'=>'nav navbar-nav', 'id'=>'#myMenu'));
        $this->set('ul', array('class'=>'dropdown-menu'));
        $this->set('li-parent', array('class'=>'dropdown'));
        $this->set('a-parent', array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"));
    }
}
```
* Include your class
```php
include "BootstrapMenu.php";
$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "About", "children": [{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": "Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';
```
* Instance the class with data parameters
```php
$qMenu = new BootstrapMenu(array('data'=>$str));
```
* Use the methods availables
```php
$qMenu->setActiveItem('http://codeignitertutoriales.com');
$qMenu->insert(array("text"=>'Ooh!', "href"=>'http://codeignitertutoriales.com', "title"=>'Awesome'), 'Another action', 'About');
$qMenu->insert(array("text"=>'Ultimo item', "href"=>'https://github.com/davicotico', "title"=>'My Github'));
```
* Renderize the menu in a string variable
```php
$menu = $qMenu->html();
```
* Done. You can echoes the menu on html document
```html
<div id="navbar" class="navbar-collapse collapse">
    <?php echo $menu ?>
</div>
```
# Class reference
### setActiveItem($href, $activeClass = '')
Setting the active item.

**Parameters:**
* string $href The active href
* string $activeClass (Optional) The Css class for the active item
### insert($item, $before_at = '', $parent = '')
Insert an item

**Parameters:**
* array $item - Associative array with item attributes (text, href, icon, title)
* string $before_at (Optional) The reference position for insert
* string $parent (Optional) The parent if the insert is in submenu
