<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "contoh_data_slave_ibbiz";

$db = mysqli_connect($host, $user, $pass, $name);

if(!$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>