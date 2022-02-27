<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/purchaseHistory.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate purchaseHistory object
$purchaseHistory = new PurchaseHistory($db);

$purchaseHistory->id = isset($_GET['id']) ? $_GET['id'] : die();

$purchaseHistory->read_single();

$purchaseHistory_arr = array(     
    'id' => $purchaseHistory->id,
    'user_id' => $purchaseHistory->user_id,
    'cart_id' => $purchaseHistory->cart_id,
    'purchase_success' => $purchaseHistory->purchase_success
);
    //Turn to JSON
    print_r(json_encode($purchaseHistory_arr));

