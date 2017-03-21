# PHP Quick Menu
Esta clase PHP permite crear un menu Html a partir de una string Json. Por favor **califica este repositorio**, pues de esa forma voy a saber que este trabajo está siendo útil.
La clase tiene parámetros de configuración, explicados en este tutorial: **http://codeignitertutoriales.com/php-menu-dinamico-multinivel/**

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
```
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