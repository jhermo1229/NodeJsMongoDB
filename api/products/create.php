<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate post object
$post = new Post($db);
echo(">>>>>>>>>>>>>>>>.");
// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->description = $data->description;
$post->productName = $data->product_name;
$post->url = $data->image_url;
$post->cost = $data->cost;

// Create Post
if($post->create()) {
echo json_encode(
    array('message' => 'Post Created')
);
}else{
    echo json_encode(
        array('message' => 'Post not Created')
    );
}