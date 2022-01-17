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

// Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die(); //turnary statement, shorthand for: if () ... else ...

// Get post
$post->read_single();

//Create array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'author' => $post->author,
    'body' => html_entity_decode($post->body),
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
);

//Make JSON
print_r(json_encode($post_arr));
