<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/PurchaseHistory.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate purchaseHistory object
$purchaseHistory = new PurchaseHistory($db);

//Blog purchaseHistory query

$result = $purchaseHistory->read();
//Get row count
$num = $result->rowCount();

// Check if any purchaseHistorys
if($num > 0){
//purchaseHistory array
    $purchaseHistory_arr = array();
    $purchaseHistory_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $purchaseHistory_item = array(
                'id' => $id,
                'user_id' => $user_id,
                'cart_id' => $cart_id,
                'purchase_success' => $purchase_success
            );

            // push to "data"
            array_push($purchaseHistory_arr['data'], $purchaseHistory_item);

    }

    //Turn to JSON
    echo json_encode($purchaseHistory_arr);

}else{
    echo json_encode(array('message' => 'No Purchase History found'));
}