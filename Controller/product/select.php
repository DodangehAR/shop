<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/product.php";
$database = new Database();
$db = $database->Connection();
$model = new Product($db);
$model->id = isset($_GET['id']) ? $_GET['id'] : die();
$model->Select();
if ($model->name !== null) {
    $array = array(
        "id" =>  $model->id,
        "name" => $model->name,
        "image" => $model->image,
        "category_id" => $model->category_id,
    );
    http_response_code(200);
    echo json_encode($array);
} else {
    http_response_code(404);
    echo json_encode("Category not found.");
}
