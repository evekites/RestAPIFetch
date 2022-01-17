<?php
//headers

use PhpParser\Node\Stmt\TryCatch;

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-control-Allow-Headers: Access-control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //not all needed

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate posts object
$post = new Post($db);

//Get raw posted data

$data = json_decode(file_get_contents("php://input"));

// Set ID to delete
$post->id = $data->id;

//delete post
if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post not Deleted')
    );
}
