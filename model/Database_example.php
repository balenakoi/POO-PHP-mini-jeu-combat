<?php
require 'Data.php';
class Database
{
//conection settings
    const HOST = "localhost",
        DBNAME = "",
        LOGIN = "",
        PWD = "";


    static public function DB()
    {
        $db = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME, self::LOGIN, self::PWD);
        return $db;
    }
}