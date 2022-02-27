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

$users->id = isset($_GET['id']) ? $_GET['id'] : die();

$users->read_single();

$users_arr = array(     
    'id' => $users->id,
    'username' => $users->username,
    'password' => $users->password,
    'first_name' => $users->first_name,    
    'last_name' => $users->last_name,
    'address' => $users->address,    
    'shipping_address' => $users->shipping_address,
    'email' => $users->email,
    'mobile_number' => $users->mobile_number
);
    //Turn to JSON
    print_r(json_encode($users_arr));

