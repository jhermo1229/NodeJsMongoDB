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

//Blog comments query

$result = $comments->read();
//Get row count
$num = $result->rowCount();

// Check if any commentss
if($num > 0){
//comments array
    $comments_arr = array();
    $comments_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $comments_item = array(
                'id' => $id,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'comment' => $comment,    
                'rating' => $rating
            );

            // push to "data"
            array_push($comments_arr['data'], $comments_item);

    }

    //Turn to JSON
    echo json_encode($comments_arr);

}else{
    echo json_encode(array('message' => 'No comments found'));
}