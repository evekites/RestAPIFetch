<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-control-Allow-Headers: Access-control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); //not all needed

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate posts object
$category = new Category($db);

//Get raw categoryed data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

$category->name = $data->name;

//create category
if ($category->update()) {
    echo json_encode(
        array('message' => 'category Updated')
    );
} else {
    echo json_encode(
        array('message' => 'category not Updated')
    );
}
