<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Cart.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate cart object
$cart = new Cart($db);

$cart->id = isset($_GET['id']) ? $_GET['id'] : die();

$cart->read_single();

$cart_arr = array(     
    'id' => $cart->id,
    'product_id' => $cart->product_id,
    'user_id' => $cart->user_id,
    'quantity' => $cart->quantity,    
    'total_cost' => $cart->total_cost
);
    //Turn to JSON
    print_r(json_encode($cart_arr));

