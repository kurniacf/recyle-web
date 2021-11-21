<?php
include_once('../routes/connect.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');

if (!empty($_POST['name_user']) && !empty($_POST['email_user']) && !empty($_POST['password'])) {
    $name_user = $_POST['name_user'];
    $email_user = $_POST['email_user'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE email_user = '$email_user'";
    $get = pg_query($connect, $query);


    if (pg_num_rows($get)) {
        set_response(true, "Email has Already");
    } else {
        $query = "INSERT INTO users(name_user, email_user, password) VALUES ('$name_user', '$email_user','$password')";

        $insert = pg_query($connect, $query);

        if ($insert) {
            set_response(true, "Register user success");
        } else {
            http_response_code(401);
            set_response(false, "Register user Failed");
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
