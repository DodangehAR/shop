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
$data = json_decode(file_get_contents("php://input"));
$model->id = $data->id;
if (isset($data->name)) {
    $model->name = $data->name;
    if ($model->Update()) {
        echo 'Product updated successfully.';
    } else {
        echo 'Product could not be update.';
    }
} else {
    echo 'Product could not be update.';
}
