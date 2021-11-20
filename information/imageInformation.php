<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

if (!empty($_GET['id_information'])) {
    $id_information = $_GET['id_information'];

    if (empty($_FILES['image_information'])) {
        http_response_code(404);
        set_response(false, "Image Dont Empty!");
    } else {
        $image_information = $_FILES['image_information']['name'];
        $file = $_FILES['image_information']['tmp_name'];
        $dir = "image_information/";
        move_uploaded_file($file, $dir . $image_information);

        $query = "UPDATE information set image_information = '$image_information' WHERE id_information = '$id_information'";
        $insert = pg_query($connect, $query);

        if ($insert) {
            set_response(true, "Update Image Success");
        } else {
            http_response_code(400);
            set_response(false, "Update Image Failed");
        }
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
