<?php
/**
 * Created by PhpStorm.
 * User: mich2
 * Date: 8-12-2018
 * Time: 14:31
 */
include_once 'Models/User.php';


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

        //get the user data from the user object
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstName = $user->getFirstname();
        $lastName = $user->getLastname();

        //build the transact SQL query to insert the user record
        $sql = "INSERT INTO User (firstName, lastName, password, username)
                VALUES ('$firstName', '$lastName', '$password', '$username')";

        //try to execute the query
        if($this->conn->query($sql) === TRUE){
            echo "The user was inserted :)";
        }else{
            echo "Error:" . $sql . "<br/>" . $this->conn->error;
        }


    }

    public function getUsers(){
        if(!$this->connectionActive)return;

        //build the transact SQL query to retrieve al users from the database
        $sql = "SELECT * FROM User";

        $users = array();

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            //iterate trough al the rows in the result set
            while($row = $result->fetch_object()){
                array_push($users,new User($row->username, $row->password, $row->firstName, $row->lastName));
            }
        }
        return $users;
    }



}






