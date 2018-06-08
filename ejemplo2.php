<?php 
/**
* @author David Ticona Saravia
*/
include "BootstrapMenu.php";
$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "About", "children": [{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": "Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';
$qMenu = new BootstrapMenu(array('data'=>$str));
$qMenu->setActiveItem('http://codeignitertutoriales.com');
$qMenu->insert(array("text"=>'Ooh!', "href"=>'http://codeignitertutoriales.com', "title"=>'Awesome'), 'Another action', 'About');
$qMenu->insert(array("text"=>'Ultimo item', "href"=>'https://github.com/davicotico', "title"=>'My Github'));
$qMenu->replace(array('text'=>'About Wow', 'href'=>'about', 'title'=>'Hey'), 'Home');
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
    </div>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Plugin Smartmenus with bootstrap -->
    <script type="text/javascript" src="smartmenus/jquery.smartmenus.min.js"></script>
    <script type="text/javascript" src="smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.js"></script>
  </body>
</html>
