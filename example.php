<?php 
/**
* @author David Ticona Saravia
*/
include "QuickMenu.php";
$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "Abour", "children": [{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": "Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';
$m = new QuickMenu(array('data'=>$str));
$m->setProperties('ul-root', array('class'=>'nav navbar-nav', 'id'=>'#myMenu'));
$m->setProperties('ul', array('class'=>'dropdown-menu'));
$m->setProperties('li-root', array('class'=>'dropdown'));
$m->setProperties('a-parent', array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"));
//$m->insert(array("text"=>'Fin', "href"=>'http://fin', "title"=>'titleAdd'));
//$m->insert(array("text"=>'insert', "href"=>'http://add', "title"=>'titleAdd'), "aaa2");
//$m->insert(array("text"=>'insert21', "href"=>'http://add21', "title"=>'titleAdd', "children"=>[['text'=>'i', 'href'=>'i', 'title'=>'i'], ['text'=>'i2', 'href'=>'i2', 'title'=>'i2']]), "aaa1122", "aaa2");
$menu = $m->html(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Example #1 - QuiMenu</title>
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
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PHP QuickMenu</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php echo $menu ?>
        </div>
      </div>
    </nav>
    <div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>PHP QuickMenu Example #1</h1>
        <p>Este es un ejemplo simple de creación de un menu Bootstrap.</p>
        <p>El menú es generado a partir de una string JSON.</p>
        <p>Estoy creando un tutorial. Apoyame: 
<a class="github-button" href="https://github.com/davicotico/PHP-Quick-Menu-Multilevel" data-icon="octicon-star" data-style="mega" data-count-href="/davicotico/PHP-Quick-Menu-Multilevel/stargazers" data-count-api="/repos/davicotico/PHP-Quick-Menu-Multilevel#stargazers_count" data-count-aria-label="# stargazers on GitHub" aria-label="Star davicotico/PHP-Quick-Menu-Multilevel on GitHub">Star</a>
        </p>
        <p>
            <a class="btn btn-lg btn-primary" href="https://www.youtube.com/c/DavidTiconaSaravia" target="_blank" role="button">Inscríbete a mi canal en Youtube &raquo;</a>
        </p>
      </div>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
