<?php
/**
 * Created by PhpStorm.
 * User: mich2
 * Date: 8-12-2018
 * Time: 14:31
 */



class DatabaseManager
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "SimpleDbApp";

    private $conn;

    private $connectionActive;

    public function __construct()
    {
        //create connection
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->databaseName );

        //check if the connection was successfully established
        if($this->conn->connect_error){
            die("Connection failed:" . $this->conn->connect_error);
        }else{
            echo "Connected successfully";
            $this->connectionActive = true;
        }
    }

    public function insertUser(User $user){
        if(!$this->connectionActive)return;

        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstName = $user->getFirstname();
        $lastName = $user->getLastname();

        $sql = "INSERT INTO User (firstName, lastName, password, username)
                VALUES ('$firstName', '$lastName', '$password', '$username')";

        if($this->conn->query($sql) === TRUE){
            echo "The user was inserted :)";
        }else{
            echo "Error:" . $sql . "<br/>" . $this->conn->error;
        }


    }

    public function getUsers(){

    }



}






