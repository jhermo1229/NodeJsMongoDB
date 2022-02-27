<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: cart');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/PurchaseHistory.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate purchaseHistory object
$purchaseHistory = new PurchaseHistory($db);
// Get raw purchaseHistory data
$data = json_decode(file_get_contents("php://input"));

$purchaseHistory->user_id = $data->user_id;
$purchaseHistory->cart_id = $data->cart_id;

$purchaseHistory->purchase_success = $data->purchase_success;

// Create purchaseHistory
if($purchaseHistory->create()) {
echo json_encode(
    array('message' => 'Purchase History Created')
);
}else{
    echo json_encode(
        array('message' => 'Purchase History not Created')
    );
}