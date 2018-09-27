<?php


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.DS.'config'.DS.'routes.php';
        $this->routes = require_once($routesPath);
    }

    private function  getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim(str_replace(DIR_FOLDER_NAME, '', urldecode($_SERVER['REQUEST_URI'])), '/');
        }
    }

    public function run() {
        $uri = $this->getURI();
        $routing = $this->routes;

        if(isset($routing[$uri])) {
            $controllerName = $routing[$uri]['controller'];
            $actionName = $routing[$uri]['action'];

            $controllerFile = ROOT . DS . 'controllers'.DS . $controllerName . '.php';

            if($controllerFile) {
                $controllerObject = new $controllerName;
                $controllerObject->$actionName();
            }
        } else {
            $arr = explode('/', $uri);

            if(isset($routing[$arr[0]])) {
                $controllerName = $routing[$arr[0]]['controller'];
                $actionName = $routing[$arr[0]]['action'];

                $controllerFile = ROOT . DS . 'controllers'.DS . $controllerName . '.php';

                array_shift($arr);

                if($controllerFile) {
                    $controllerObject = new $controllerName;
                    $controllerObject->$actionName($arr);
                }
            } else {
                echo '<h1>Note found</h1>';
            }
        }
    }
}