<?php
class Database {
    //DB Params
    private $servername;
    private $username;
    Private $password;
    private $dbname;
    private $charset;
    private $conn;

    public function connect()
    {
        $this->servername ="localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "api";
        $this->charset="utf8mb4";

        $this->conn=null;
        

        try{
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
            $this->conn=new PDO($dsn,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e){
            echo "Connection failed: " .$e->getMessage();

        }
        return $this->conn;
    }
}
?>