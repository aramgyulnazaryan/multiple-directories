<?php
return $routing = [

    '' => ['controller' => 'HomeController', 'action' => 'index'],
    'create/levelone' => ['controller' => 'HomeController', 'action' => 'createLavelOne'],
    'create/leveltwo' => ['controller' => 'HomeController', 'action' => 'createLavelTwo'],
    'create/levelthree' => ['controller' => 'HomeController', 'action' => 'createLavelThree'],
    'create/levelfour' => ['controller' => 'HomeController', 'action' => 'createLavelFour'],
    'get/child/directory' => ['controller' => 'HomeController', 'action' => 'getChildDirectory'],
    'filter' => ['controller' => 'HomeController', 'action' => 'getDirectoryByName']
];