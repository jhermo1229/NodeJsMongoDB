<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate products object
$products = new Products($db);

//Blog products query

$result = $products->read();
//Get row count
$num = $result->rowCount();

// Check if any productss
if($num > 0){
//products array
    $products_arr = array();
    $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $products_item = array(
                'id' => $id,
                'product_name' => $product_name,
                'description' => $description,
                'image_url' => $image_url,    
                'cost' => $cost
            );

            // push to "data"
            array_push($products_arr['data'], $products_item);

    }

    //Turn to JSON
    echo json_encode($products_arr);

}else{
    echo json_encode(array('message' => 'No products found'));
}