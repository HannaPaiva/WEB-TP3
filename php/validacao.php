<?php

require_once "conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


 
    $fileid = $_POST["fileid"];
    $password = $_POST["password"];

    $sql = "SELECT a.password_ficheiro AS dbpassword
            FROM acessos a
            JOIN ficheiros f ON a.fileid = f.id
            WHERE f.id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $fileid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    die($result["dbpassword"]);
    if ($result) {
        $dbPassword = $result['dbpassword'];

        if (password_verify($password, $dbPassword)) {
            echo ("ok");
        } else {
            echo ("no");
        }
    }
}
