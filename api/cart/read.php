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

//Blog cart query

$result = $cart->read();
//Get row count
$num = $result->rowCount();

// Check if any carts
if($num > 0){
//cart array
    $cart_arr = array();
    $cart_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $cart_item = array(
                'id' => $id,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'quantity' => $quantity,    
                'total_cost' => $total_cost
            );

            // push to "data"
            array_push($cart_arr['data'], $cart_item);

    }

    //Turn to JSON
    echo json_encode($cart_arr);

}else{
    echo json_encode(array('message' => 'No products found'));
}