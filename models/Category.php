<?php
class Category
{
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Category properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Categories
    public function read()
    {
        // Create query
        $sql = 'SELECT
                    id,
                    name,
                    created_at
                FROM
                    ' . $this->table . '
                ORDER BY
                    created_at DESC';
        // Prepared statement
        $stmt = $this->conn->prepare($sql);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single Category
    public function read_single()
    {
        // Create query
        $sql = 'SELECT
                    id,
                    name,
                    created_at
                FROM
                    ' . $this->table . '
                WHERE
                    id = ?
                LIMIT 0,1';
        // Prepared statement
        $stmt = $this->conn->prepare($sql);
        //Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

    // Create Category
    public function create()
    {
        //create query
        $sql = 'INSERT INTO ' . $this->table . '
                    SET
                        name = :name';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("error: %s.\n", $stmt->error);
            return false;
        }
    }

    // Update Category
    public function update()
    {
        //create query
        $sql = 'UPDATE ' . $this->table . '
                    SET
                        name = :name
                WHERE
                    id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);
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

    // Delete Category
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
