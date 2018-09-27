<?php


class BaseController
{
    public function redirect($url=null)
    {
        header("Location: /$url");
    }

    public function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}