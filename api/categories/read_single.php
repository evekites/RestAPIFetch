<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate posts object
$category = new Category($db);

// Get ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die(); //turnary statement, shorthand for: if () ... else ...

// Get category
$category->read_single();

//Create array
$categories_arr = array(
    'id' => $category->id,
    'name' => $category->name,
);

//Make JSON
print_r(json_encode($categories_arr));
