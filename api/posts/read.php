<?php

//headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate posts object
$post = new Post($db);

// Blog post query
$result = $post->read();
// Get row count  (doesn't work in SQLITE)
$num = $result->rowCount();

// Check if any posts
if ($num > 0) {
    // Posts array
    $post_arr = array();
    $post_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // this way you can use $title instead of $row['title']
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
            'created_at' => $created_at,
        );

        // Push to "data"
        array_push($post_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($post_arr);

} else {
    // No posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
