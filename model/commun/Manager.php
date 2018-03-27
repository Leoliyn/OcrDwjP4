<?php
namespace OpenClassrooms\DWJP4\Commun\Model;
require_once("model/commun/Config.php");

class Manager extends Config {
           
    protected function dbConnect() {
        try {
               $db = new \PDO("mysql:host=".self::DBHOST.";dbname=".self::DBNAME.";charset=".self::CHARSET,self::DBUSER,self::DBPASS);
               $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
               return $db;
              
        }
        catch (Exception $e)
        {
        echo '[Exception] : ', $e->getMessage();
        }
    }    
}