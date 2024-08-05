<?php
class PDOConnect
{
    protected $hot_name = "localhost";
    protected $prot = "8000";
    protected $username = "root";
    protected $password = "";
    protected $database_name = "duanmau";
    protected $db;
    function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->hot_name;dbname=$this->database_name", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stml = $this->db->prepare($sql);
            $stml->execute($sql_args);
            return $stml;
        } catch (PDOException $e) {
            http_response_code($e->getCode());
            trigger_error($e->getMessage() . "\n $sql", E_USER_ERROR);
            die;
        }
    }
}
