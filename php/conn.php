<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp3web";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conxão falhada: " . $conn->connect_error);
}
?>
