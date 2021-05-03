<?php

class Db
{
    public $conn;

    function __construct()
    {
        try {
            // $conn_str = "host=******** port=**** dbname=********* user=******* password=*********";
            $this->conn = pg_connect(
                "host=".DB_HOST. " port=5432 
                dbname=".DB_DATABASE.
                " user=". DB_USER .
                " password=" . intval(DB_PASS)
            ) or die('failed');
           // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed" . $e->getMessage();
        }
    }
}