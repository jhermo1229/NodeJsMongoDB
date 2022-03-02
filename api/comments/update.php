<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comments.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate comments object
$comments = new Comments($db);
// Get raw commentsed data
$data = json_decode(file_get_contents("php://input"));

// set ID to update
$comments->id = $data->id;
$comments->product_id = $data->product_id;
$comments->user_id = $data->user_id;
$comments->comment = $data->comment;
$comments->rating = $data->rating;

// Create comments
if($comments->update()) {
echo json_encode(
    array('message' => 'Comments Updated')
);
}else{
    echo json_encode(
        array('message' => 'Comments not Updated')
    );
}