<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate users object
$users = new Users($db);

//Blog users query

$result = $users->read();
//Get row count
$num = $result->rowCount();

// Check if any userss
if($num > 0){
//users array
    $users_arr = array();
    $users_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $users_item = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'first_name' => $first_name,    
                'last_name' => $last_name,
                'address' => $address,    
                'shipping_address' => $shipping_address,
                'email' => $email,
                'mobile_number' => $mobile_number
            );

            // push to "data"
            array_push($users_arr['data'], $users_item);

    }

    //Turn to JSON
    echo json_encode($users_arr);

}else{
    echo json_encode(array('message' => 'No users found'));
}