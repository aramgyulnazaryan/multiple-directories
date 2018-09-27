<?php

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);

include_once(ROOT. '/config/config.php');
require_once(ROOT.DS.'lib'.DS.'init.php');


$router = new Router();
$router->run();
