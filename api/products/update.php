<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// set ID to update
$post->id = $data->id;

$post->description = $data->description;
$post->productName = $data->product_name;
$post->url = $data->image_url;
$post->cost = $data->cost;

// Create Post
if($post->update()) {
echo json_encode(
    array('message' => 'Post Updated')
);
}else{
    echo json_encode(
        array('message' => 'Post not Updated')
    );
}