<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

if (!empty($_POST['title_information'])) {
    $title_information = $_POST['title_information'];
    $description_information = $_POST['description_information'];
    $link_video = $_POST['link_video'];
    $step_information = $_POST['step_information'];
    $tools_materials = $_POST['tools_materials'];

    $query = "INSERT INTO information(title_information, description_information, link_video, step_information, tools_materials) 
        VALUES ('$title_information', '$description_information', '$link_video', '$step_information', ARRAY['$tools_materials'])";

    $insert = pg_query($connect, $query);

    if ($insert) {
        set_response(true, "Success Create Information");
    } else {
        set_response(false, "Failed Create Information");
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
