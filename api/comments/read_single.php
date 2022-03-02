<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Comments.php';

//Instantiate DB and connect

$database = new Database();
$db = $database->connect();

//instantiate comments object
$comments = new Comments($db);

$comments->id = isset($_GET['id']) ? $_GET['id'] : die();

$comments->read_single();

$comments_arr = array(     
    'id' => $comments->id,
    'product_id' => $comments->product_id,
    'user_id' => $comments->user_id,
    'comment' => $comments->comment,    
    'rating' => $comments->rating
);
    //Turn to JSON
    print_r(json_encode($comments_arr));

