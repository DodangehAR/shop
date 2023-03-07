<?php
class Database
{
    private $dsn = "mysql";
    private $host = "127.0.0.1";
    private $db_name = "shop";
    private $username = "root";
    private $password = "";
    public $connection;
    public function Connection()
    {
        try {
            $this->connection = new PDO($this->dsn . ":host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->connection;
    }
}
