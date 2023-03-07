<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/category.php";
$database = new Database();
$db = $database->Connection();
$model = new Category($db);
$statement = $model->SelectAll();
$json = array();
$json["categories"] = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $e = array(
        "id" => $id,
        "title" => $title,
    );
    array_push($json["categories"], $e);
}
echo json_encode($json);
