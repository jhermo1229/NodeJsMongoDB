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

$products->id = isset($_GET['id']) ? $_GET['id'] : die();


$products->read_single();

$products_arr = array(
    'id' => $products->id,
    'product_name' => $products ->product_name,
    'description' => $products->description,
    'image_url' => $products->image_url,
    'cost' => $products->cost
);


    //Turn to JSON
    print_r(json_encode($products_arr));

