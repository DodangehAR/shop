<?php
class Category
{
    private $connection;
    private $db_table = "category";
    public $id;
    public $title;
    public function __construct($db)
    {
        $this->connection = $db;
    }
    public function SelectAll()
    {
        $sql = "SELECT * FROM " . $this->db_table;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement;
    }
    public function Select()
    {
        $sql = "SELECT * FROM " . $this->db_table . " WHERE id = :id LIMIT 0,1";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $this->id);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $data['id'];
        $this->title = $data['title'];
    }
    public function Insert()
    {
        $sql = "INSERT INTO " . $this->db_table . " SET title = :title";
        $statement = $this->connection->prepare($sql);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $statement->bindParam(":title", $this->title);
        if ($statement->execute()) {
            return true;
        }
        return false;
    }
    public function Update()
    {
        $sql = "UPDATE " . $this->db_table . " SET title = :title WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $statement->bindParam(":title", $this->title);
        $statement->bindParam(":id", $this->id);
        if ($statement->execute()) {
            return true;
        }
        return false;
    }
    public function Delete()
    {
        $sql = "DELETE FROM " . $this->db_table . " WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $this->id);
        if ($statement->execute()) {
            return true;
        }
        return false;
    }
}
