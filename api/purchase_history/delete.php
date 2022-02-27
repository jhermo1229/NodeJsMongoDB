<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/PurchaseHistory.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate purchaseHistory object
$purchaseHistory = new PurchaseHistory($db);
// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$purchaseHistory->id = $data->id;

// Create Post
if($purchaseHistory->delete()) {
echo json_encode(
    array('message' => 'Purchase History Deleted')
);
}else{
    echo json_encode(
        array('message' => 'Purchase History not Deleted')
    );
}