<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

if (!empty($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $query = "SELECT * FROM storage WHERE id_user = '$id_user'";
} else if (!empty($_GET['id_storage'])) {
    $id_storage = $_GET['id_storage'];
    $query = "SELECT * FROM storage WHERE id_storage = '$id_storage'";
} else {
    $query = "SELECT * FROM storage";
}

$get = pg_query($connect, $query);
$data = array();

if (pg_num_rows($get) > 0) {
    while ($row = pg_fetch_assoc($get)) {
        $data[] = $row;
    }
    set_response(true, "Storage Found", $data);
} else {
    http_response_code(404);
    set_response(false, "Storage Not Found", $data);
}

function set_response($isSuccess, $message, $data)
{
    $result = array(
        'isSuccess' => $isSuccess,
        'message' => $message,
        'data' => $data
    );

    echo json_encode($result);
}
