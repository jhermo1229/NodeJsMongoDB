<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate users object
$users = new Users($db);
// Get raw usersed data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$users->id = $data->id;

$users->username = $data->username;
$users->password = $data->password;
$users->first_name = $data->first_name;
$users->last_name = $data->last_name;
$users->address = $data->address;
$users->shipping_address = $data->shipping_address;
$users->email = $data->email;
$users->mobile_number = $data->mobile_number;

// Create users
if($users->update()) {
echo json_encode(
    array('message' => 'User Updated')
);
}else{
    echo json_encode(
        array('message' => 'User not Updated')
    );
}