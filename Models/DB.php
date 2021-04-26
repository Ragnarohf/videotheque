<?php

namespace App\Models;

use PDO;
use PDOException;

class DB extends PDO
{
    // instance unique de la classe
    private static $instance;
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const PWD = "";
    private const DBNAME = "videotheque";

    private function __construct()
    {
        //DSN
        $_dsn = "mysql:host=" . self::DBHOST . ";dbname=" . self::DBNAME;
        try {
            parent::__construct($_dsn, self::DBUSER, self::PWD);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
}
