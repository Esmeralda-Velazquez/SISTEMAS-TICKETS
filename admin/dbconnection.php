<?php
$host = "192.168.1.251";
$user = "Esmeralda";
$password = "147123";
$database = "ivra-tickets";
$port = "3306"; 

$con = mysqli_connect($host, $user, $password, $database, $port);

if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
