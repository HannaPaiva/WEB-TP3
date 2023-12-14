<?php
    include "php/conn.php";

$ficheiro = $_FILES["ficheiro"];
move_uploaded_file($ficheiro["tmp_name"], "ficheiros/" .$ficheiro["name"]);
header("Location: index.php");
?>