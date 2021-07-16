<?php


class DB
{
    private $host = "localhost";
    private $db = "shop";
    private $user = "root";
    private $pass = "";
    private $charset = NULL;
    private $opt = NULL;
    private $dsn = NULL;
    private $connection = NULL;
    private static $database = NULL;

    private function __construct()
    {
        $this->createConnection();
    }

    private function createConnection():void
    {
        $this->charset = "utf8mb4";
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->connection = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

     public static function getInstance():DB
     {
        if (NULL == self::$database) {
            self::$database = new DB();
        }
        return self::$database;
     }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
