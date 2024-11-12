<?php

/*
 * Calling Database Connection
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Db {

    // private $host = 'localhost';
    // private $user = 'root';
    // private $pass = '';
    // private $dbName = 'c1_b';
    // private $port = '3306';
    // private $db_Conn;
    // private $stmt;   
    
    // private $host = HOST;
    // private $user = USER;
    // private $pass = PASS;
    // private $dbName = DB_NAME;
    // private $port = PORT;
    // private $db_Conn;
    // private $stmt;    

    private $host = db['HOST'];
    private $user = db['USER'];
    private $pass = db['PASS'];
    private $dbName = db['DB_NAME'];
    private $port = db['PORT'];
    private $db_Conn;
    private $stmt;    

    public function __construct()
    {

        // data source with necessary info to database connection
        $dsn = 
            'mysql:host='.$this->host.
            ';port='.$this->port.
            ';dbname='.$this->dbName;
        $options = [
            // cache of connection, avoids override, more quick app
            PDO::ATTR_PERSISTENT => true,
            // if an error occurs, launch Exception
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            // PDO instance
            $this->db_Conn = new PDO(
                $dsn, $this->user, 
                $this->pass, $options);
        } catch (PDOException $e) {
            // print "Error!: " . $e->getMessage() . "<br/>";
            // this phpErr (function) is only recommended in delepment enviroment
            // put as comment if you deploy
            phpErr(
                $e->getCode(), 
                $e->getMessage(), 
                $e->getFile(), 
                $e->getLine()
            );
            die();
        }
    }

    // Query Prepared Statements
    public function query($sql) {
        // prepares sql query
        $this->stmt = $this->db_Conn->prepare($sql);
    }

    // Link/Attaches a value to a param
    public function bind($param, $value, $type = null) {
        if (is_null($type)):
            switch (true):
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                $type = PDO::PARAM_STR;
            endswitch;        
        endif;

        $this->stmt->bindValue($param, $value, $type);
    }

    // execute Prepared Statement
    public function exec(){
        return $this->stmt->execute();
    }

    // obtain an unique record
    public function result(){
        $this->exec();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // obtain a set of records
    public function results(){
        $this->exec();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // returns affected rows by last SQL instruction
    public function totalResults(){
        return $this->stmt->rowCount();
    }

    // returns last inserted ID from database
    public function lastInserted(){
        return $this->db_Conn->lastInsertId();
    }

}

