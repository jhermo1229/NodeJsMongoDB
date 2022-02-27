<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Cart.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate cart object
$cart = new Cart($db);
// Get raw carted data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$cart->id = $data->id;

$cart->product_id = $data->product_id;
$cart->user_id = $data->user_id;
$cart->quantity = $data->quantity;
$cart->total_cost = $data->total_cost;

// Create cart
if($cart->update()) {
echo json_encode(
    array('message' => 'Cart Updated')
);
}else{
    echo json_encode(
        array('message' => 'Cart not Updated')
    );
}