<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate categories object
$category = new Category($db);

// Blog category query
$result = $category->read();
// Get row count  (doesn't work in SQLITE)
$num = $result->rowCount();

// Check if any categories
if ($num > 0) {
    // categories array
    $category_arr = array();
    $category_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // this way you can use $title instead of $row['title']
        $category_item = array(
            'id' => $id,
            'name' => $name,
        );

        // Push to "data"
        array_push($category_arr['data'], $category_item);
    }

    // Turn to JSON & output
    echo json_encode($category_arr);

} else {
    // No posts
    echo json_encode(
        array('message' => 'No Categories Found')
    );
}
