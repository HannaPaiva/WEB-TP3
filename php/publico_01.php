<?php

require_once "conn.php";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fileid = $_POST["fileid"];
    $password =  ""; 

    $sql = "SELECT a.password_ficheiro AS dbpassword
            FROM acessos a
            JOIN ficheiros f ON a.fileid = f.id
            WHERE f.id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $fileid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result) {
        $dbPassword = $result['dbpassword'];

        if (password_verify($password, $dbPassword)) {
            $response['status'] = "publico";
            $response['message'] = "publico";
            echo json_encode($response);
        } else {
            $response['status'] = "privado";
            $response['message'] = "privado";
            echo json_encode($response);
        }
    }
}
