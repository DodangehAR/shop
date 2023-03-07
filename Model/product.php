<?php
class Product
{
    private $connection;
    private $db_table = "product";
    public $id;
    public $name;
    public $image;
    public $category_id;
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
        $this->name = $data['name'];
        $this->image = $data['image'];
        $this->category_id = $data['category_id'];
    }
    public function Insert()
    {
        $sql = "INSERT INTO " . $this->db_table . " SET name = :name , image = :image , category_id = :category_id";
        $statement = $this->connection->prepare($sql);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":image", $this->image);
        $statement->bindParam(":category_id", $this->category_id);
        if ($statement->execute()) {
            return true;
        }
        return false;
    }
    public function Update()
    {
        $sql = "UPDATE " . $this->db_table . " SET name = :name WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $statement->bindParam(":name", $this->name);
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
