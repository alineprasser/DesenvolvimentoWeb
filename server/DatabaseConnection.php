<?php

class Database
{
    private const HOST = "localhost";
    private const DBNAME = "devweb";
    private const PORT = "3306";
    private const USER = "root";
    private const PASSWORD = "";

    public static function Conection()
    {
        try {
            return new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";port=" . self::PORT, self::USER, self::PASSWORD);
        } catch (\PDOException $error) {
            echo $error->getMessage();
            die();
        }
    }
}
