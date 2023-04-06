<?php

class Database{
    private string $host = "127.0.0.1:3306";
    //private $host = "localhost";
    private string $db_name = "vooov";
    private string $username = "root";
    private string $password = "";
    public ?PDO $connection;

    //getter for connection
    public function getConnection(): ?PDO
    {
        //closing the connection if exists
        $this->connection = null;

        // try to connect
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->exec("set names utf8");  // force transaction in <UTF-8></UTF-8>
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connection;
    }
}
