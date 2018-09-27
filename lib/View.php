<?php

class View
{
    public static function render($name, $data = []) {
        $content = $name.'.php';
        include_once(ROOT.DS.'views'.DS.$content);
    }
}