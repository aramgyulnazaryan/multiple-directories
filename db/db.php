<?php

class Db
{
    public static function getConnection()
    {
        $dsn = 'mysql:host='.DBHOST.'; dbname='.DBNAME.'';
        $db = new PDO($dsn, DBUSER, DBPASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $db;
    }
}