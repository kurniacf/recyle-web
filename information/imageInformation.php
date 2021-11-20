<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

if (!empty($_GET['id_information']) && !empty($_POST['image_information'])) {
    $id_information = $_GET['id_information'];
    $image_information = $_POST['image_information'];

    $query = "UPDATE information set image_information = '$image_information' WHERE id_information = '$id_information'";
    $update = pg_query($connect, $query);

    if ($update) {
        set_response(true, "Image Update Information Success");
    } else {
        http_response_code(400);
        set_response(false, "Image Update Information Failed!");
    }
} else {
    http_response_code(400);
    set_response(false, "Dont Empty");
}

function set_response($isSuccess, $message)
{
    $result = array(
        'isSuccess' => $isSuccess,
        'message' => $message
    );

    echo json_encode($result);
}
