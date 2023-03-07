<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once "/xampp/htdocs/projects/SHOP/Model/database.php";
require_once "/xampp/htdocs/projects/SHOP/Model/user.php";
$database = new Database();
$db = $database->Connection();
$model = new User($db);
$statement = $model->SelectAll();
$json = array();
$json["users"] = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $e = array(
        "id" => $id,
        "name" => $name,
        "email" => $email,
        "password" => $password,
    );
    array_push($json["users"], $e);
}
echo json_encode($json);
