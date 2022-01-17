<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-control-Allow-Headers: Access-control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //not all needed

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate categories object
$category = new Category($db);

//Get raw category data
$data = json_decode(file_get_contents("php://input"));

$category->name = $data->name;

//create category
if ($category->create()) {
    echo json_encode(
        array('message' => 'category Created')
    );
} else {
    echo json_encode(
        array('message' => 'category not Created ')
    );
}
