<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate post object
$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

echo($_GET['id']);

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'product_name' => $post ->product_name,
    'description' => $post->description,
    'image_url' => $post->url,
    'cost' => $post->cost
);


    //Turn to JSON
    print_r(json_encode($post_arr));

