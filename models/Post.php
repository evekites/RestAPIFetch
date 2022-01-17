<?php

class Post
{
    // DB stuff
    private $conn;
    private $table = 'posts';

    // Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get posts
    public function read()
    {
        // Create query
        $sql = 'SELECT
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.category_id DESC';
        // Prepared statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single post
    public function read_single()
    {
        // Create query
        $sql = 'SELECT
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT 0,1';
        // Prepared statement
        $stmt = $this->conn->prepare($sql);
        //Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    // Create post
    public function create()
    {
        //create query
        $sql = 'INSERT INTO ' . $this->table . '
                    SET
                        title = :title,
                        body = :body,
                        author = :author,
                        category_id = :category_id';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("error: %s.\n", $stmt->error);
            return false;
        }
    }

    // Update post
    public function update()
    {
        //create query
        $sql = 'UPDATE ' . $this->table . '
                    SET
                        title = :title,
                        body = :body,
                        author = :author,
                        category_id = :category_id
                WHERE
                    id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("error: %s.\n", $stmt->error);
            return false;
        }
    }

    // Delete post
    public function delete()
    {
        // Query
        $sql = 'DELETE FROM ' . $this->table . '
                    WHERE id = :id';
        //prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        //execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("error: %s.\n", $stmt->error);
            return false;
        }

    }
}
