<?php

namespace threemuskateers\hw3\models;

use mysqli;
require_once(realpath(dirname(__FILE__) . '/../configs/Config.php'));
require_once(realpath(dirname(__FILE__) . '/../configs/CreateDB.php'));

abstract class Model {
    private $connection;
    /**
     * Connect to the database
    */
    public function connectToDB() {
        //Establish connection to database
        $this->connection = mysqli_connect("localhost","root","");

        // Create database
        //$sql = "CREATE DATABASE hw3";
        /*if ($this->connection->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $this->connection->error;
        }
*/
        //$this->connection = mysqli_connect("localhost","root",null,"hw3");

        //Check connection was successful
        if($this->connection->connect_error) {
            echo "Connection failed: " . $this->connection->connect_error . "\n";
        }
        mysqli_select_db($this->connection, 'writingRating');
        return $this->connection;
    }
}

?>


