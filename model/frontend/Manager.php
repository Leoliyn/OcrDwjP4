<?php

namespace OpenClassrooms\DWJP4\frontend\Model;

class Manager
{
    protected function dbConnect()
    {
        /*$db = new \PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root', '');*/
        $db =new \PDO('mysql:host=localhost;dbname=jeanforteroche;charset=utf8', 'root',
    '');
        return $db;
    }
}