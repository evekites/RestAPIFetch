<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-control-Allow-Headers: Access-control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //not all needed

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate categories object
$category = new Category($db);

//Get raw categoryed data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

//delete category
if ($category->delete()) {
    echo json_encode(
        array('message' => 'category Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'category not Deleted')
    );
}
