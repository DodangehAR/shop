<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/comment.php";
$database = new Database();
$db = $database->Connection();
$model = new Comment($db);
$data = json_decode(file_get_contents("php://input"));
$model->id = $data->id;
if (isset($data->status)) {
    $model->status = $data->status;
    if ($model->Update()) {
        echo 'Comment updated successfully.';
    } else {
        echo 'Comment could not be update.';
    }
} else {
    echo 'Comment could not be update.';
}
