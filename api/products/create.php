<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: products');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate products object
$products = new Products($db);
// Get raw productsed data
$data = json_decode(file_get_contents("php://input"));

$products->description = $data->description;
$products->productName = $data->product_name;
$products->url = $data->image_url;
$products->cost = $data->cost;

// Create products
if($products->create()) {
echo json_encode(
    array('message' => 'Product Created')
);
}else{
    echo json_encode(
        array('message' => 'Product not Created')
    );
}