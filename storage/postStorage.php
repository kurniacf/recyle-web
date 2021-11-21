<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

if (!empty($_POST['id_user']) && !empty($_POST['name_storage'])) {
    $id_user = $_POST['id_user'];
    $name_storage = $_POST['name_storage'];
    $count_storage = $_POST['count_storage'];
    $progress_complete_storage = $_POST['progress_complete_storage'];


    $query = "INSERT INTO storage(id_user, name_storage, count_storage, progress_complete_storage) 
        VALUES ('$id_user', '$name_storage', '$count_storage', '$progress_complete_storage')";

    $insert = pg_query($connect, $query);

    if ($insert) {
        set_response(true, "Success Insert in Storage");
    } else {
        http_response_code(400);
        set_response(false, "Failed Insert in Storage");
    }
} else {
    http_response_code(400);
    set_response(false, "Dont Empty!!");
}

function set_response($isSuccess, $message)
{
    $result = array(
        'isSuccess' => $isSuccess,
        'message' => $message
    );

    echo json_encode($result);
}
