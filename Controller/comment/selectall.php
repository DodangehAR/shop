<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/comment.php";
$database = new Database();
$db = $database->Connection();
$model = new Comment($db);
$statement = $model->SelectAll();
$json = array();
$json["comments"] = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $e = array(
        "id" => $id,
        "body" => $body,
        "status" => $status,
        "product_id" => $product_id,
        "user_id" => $user_id,
    );
    array_push($json["comments"], $e);
}
echo json_encode($json);
