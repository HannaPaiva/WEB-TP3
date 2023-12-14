<?php
    require 'conn.php';



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
}

    if ($email == $email_db && $password == $password_db){
        
    }
?>