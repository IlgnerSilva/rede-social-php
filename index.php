<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
  require('vendor/autoload.php');

  define('INCLUDE_PATH_STATIC','http://localhost/redesocial/RedeSocial/Views/pages/');
  define('INCLUDE_PATH', 'http://localhost/redesocial/');

  $app = new RedeSocial\Application();
  $app->run();
?>