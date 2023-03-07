<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/product.php";
$database = new Database();
$db = $database->Connection();
$model = new Product($db);
$statement = $model->SelectAll();
$json = array();
$json["products"] = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $e = array(
        "id" => $id,
        "name" => $name,
        "image" => $image,
        "category_id" => $category_id,
    );
    array_push($json["products"], $e);
}
echo json_encode($json);
