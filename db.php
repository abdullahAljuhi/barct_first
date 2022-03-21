<?php

class ConnectedDb
{
    public $serverName = 'localhost';
    public $userName = 'root';
    public $password = '';
    public $dbname = 'Productdb';
    public static $con;

    /**
     *  connection to DB
     */
    public function __construct()
    {
        try {

            // create connection
            self::$con = mysqli_connect($this->servername, $this->username,
                $this->password, $this->dbname);

        } catch (PDOException $e) {
            $e->getMessage();
        }

    }

/**
 * @return [PDO Conection]
 */
    public function concted()
    {
        return self::$con;
    }

}
