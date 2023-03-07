<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/user.php";
$database = new Database();
$db = $database->Connection();
$model = new User($db);
$model->id = isset($_GET['id']) ? $_GET['id'] : die();
$model->Select();
if ($model->name !== null) {
    $array = array(
        "id" =>  $model->id,
        "name" => $model->name,
        "email" => $model->email,
        "password" => $model->password,
    );
    http_response_code(200);
    echo json_encode($array);
} else {
    http_response_code(404);
    echo json_encode("User not found.");
}
