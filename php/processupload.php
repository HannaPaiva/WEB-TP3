<?php
    require "conn.php";
if ($_SERVER["POST"]){
    $ficheiro = $_FILES["ficheiro"];
    move_uploaded_file($ficheiro["tmp_name"], "../assets/ficheiros/" .$ficheiro["name"]);
    header("Location: ../views/mostrarficheiros.php");
}
?>