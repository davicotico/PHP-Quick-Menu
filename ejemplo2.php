<?php 
/**
* @author David Ticona Saravia
*/
include "QuickMenu.php";
$str = '[{"text":"Home","href":"http://home.com","icon":"fa fa-home","target":"_top","title":"My Home","children":[{"text":"Opcion2","href":"","icon":"fa fa-bar-chart-o","target":"_self","title":""},{"text":"Opcion3","href":"","icon":"fa fa-cloud-upload","target":"_self","title":""}]},{"text":"Opcion4","href":"","icon":"fa fa-crop","target":"_self","title":""},{"text":"Opcion5","href":"","icon":"fa fa-flask","target":"_self","title":""},{"text":"Opcion7","href":"","icon":"fa fa-search","target":"_self","title":"","children":[{"text":"Opcion7-1","href":"","icon":"fa fa-plug","target":"_self","title":"","children":[{"text":"Opcion7-1-1","href":"","icon":"fa fa-filter","target":"_self","title":""},{"text":"Opcion6","href":"","icon":"fa fa-map-marker","target":"_self","title":""}]}]}]';
$qMenu = new QuickMenu(array('data'=>$str));
$qMenu->setDropdownIcon('<i class="caret"></i>');
$qMenu->set('ul-root', array('class'=>'nav navbar-nav', 'id'=>'#myMenu'));
$qMenu->set('ul', array('class'=>'dropdown-menu'));
$qMenu->set('a-parent', array('data-toggle'=>"dropdown", 'role'=>"button", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"));
$menu = $qMenu->html(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ejemplo Quick Menu">
    <meta name="author" content="David Ticona Saravia">
    <title>Ejemplo #2 - QuickMenu & Smartmenus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {padding-top: 70px};
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://codeignitertutoriales.com">PHP QuickMenu</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php echo $menu ?>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="jumbotron">
        <h1>PHP QuickMenu Ejemplo #2</h1>
        <p>Este es un ejemplo simple de creación de un menu Bootstrap.</p>
        <p>El menú fue generado a partir de una string JSON.</p>
        <p>
            <a class="btn btn-lg btn-primary" href="https://www.youtube.com/c/DavidTiconaSaravia" target="_blank" role="button">Inscríbete a mi canal en Youtube &raquo;</a>
        </p>
      </div>
      <div class="row">
      <div class="col-md-12">
      <h3>INSTRUCCIONES.-</h3>
      <ul>
      <li>Bootstrap solo acepta menus de hasta 2 niveles.</li>
      <li>Para menus de niveles ilimitados se necesita un plugin. Bajar la ultima version del plugin <strong>Smartmenus <a href="https://github.com/vadikom/smartmenus/archive/1.1.0.zip" target="_blank">Click Aqui</a></strong></li>
      <li>La estructura de archivos necesarios es la siguiente:</li>
      </ul>
      <pre>
      ejemplo2.php
      smartmenus/
            jquery.smartmenus.min.js
            addons/
                bootstrap/
                    jquery.smartmenus.bootstrap.js
                    jquery.smartmenus.bootstrap.css
      </pre>
      </div>
      </div>
    </div>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Plugin Smartmenus with bootstrap -->
    <script type="text/javascript" src="smartmenus/jquery.smartmenus.min.js"></script>
    <script type="text/javascript" src="smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.js"></script>
  </body>
</html>