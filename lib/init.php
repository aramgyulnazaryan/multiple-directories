<?php
require_once(ROOT.DS.'db'.DS.'db.php');

function __autoload($class_name) {
    $lib_path = ROOT.DS.'lib'.DS.strtolower($class_name).'.php';
    $controllers_path = ROOT.DS.'controllers'.DS. $class_name .'.php';
    $models_path = ROOT.DS.'models'.DS.strtolower($class_name).'.php';

    if( file_exists($lib_path)) {
        require_once($lib_path);
    } elseif( file_exists($controllers_path) ) {
        require_once($controllers_path);
    } elseif ( file_exists($models_path) ) {
        require_once($models_path);
    } else {
        throw new Exception('Failed to include class:'.$class_name);
    }
}