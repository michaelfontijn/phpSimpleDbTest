<?php
/**
 * Created by PhpStorm.
 * User: mich2
 * Date: 8-12-2018
 * Time: 20:28
 */

include 'DatabaseManager.php';
include 'Models/User.php';


$dbManager = new DatabaseManager();

switch ($_POST['action']) {
    case "insertUser":

        //convert the url encoded param string to an php array
        $params = array();
        parse_str($_POST['user'], $params);
        //echo(print_r($params));

        //retrieve the inputField values from the post request
        $username = $params['username'];
        $password = $params['password'];
        $firstName = $params['firstName'];
        $lastName = $params['lastName'];

        //create the user object, using the retrieve input field values
        $userObj = new User($username,$password,$firstName,$lastName);
        //$userObj->setUsername($data);

        //ask the dbManager to insert the new user into the database
        $dbManager->insertUser($userObj);
        break;
    case "getUsers":
        $dbManager->getUsers();
}


