<?php
class Comment
{
    private $connection;
    private $db_table = "comment";
    public $id;
    public $body;
    public $status;
    public $product_id;
    public $user_id;
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
        $this->body = $data['body'];
        $this->status = $data['status'];
        $this->product_id = $data['product_id'];
        $this->user_id = $data['user_id'];
    }
    public function Insert()
    {
        $sql = "INSERT INTO " . $this->db_table . " SET body = :body , product_id = :product_id , user_id = :user_id";
        $statement = $this->connection->prepare($sql);
        $this->body = htmlspecialchars(strip_tags($this->body));
        $statement->bindParam(":body", $this->body);
        $statement->bindParam(":product_id", $this->product_id);
        $statement->bindParam(":user_id", $this->user_id);
        if ($statement->execute()) {
            return true;
        }
        return false;
    }
    public function Update()
    {
        $sql = "UPDATE " . $this->db_table . " SET status = :status WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":status", $this->status);
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
