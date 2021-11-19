<?php
$host = "ec2-52-7-58-253.compute-1.amazonaws.com";
$port = "5432";
$user = "lwnrdxoueuabae";
$password = "716fedefbee918da1dbc166daeac7444f2112934234f9366efc0868f0b917c17";
$dbname = "d7g11uq8p4u2cn";

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
$connect = pg_connect($connection_string);

// if (!$connect) {
//     echo "Database connection failed.";
// } else {
//     echo "Database connection success.";
// }
