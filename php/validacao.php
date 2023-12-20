<?php

require_once "conn.php";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {


 
    $fileid = $_POST["fileid"];
    $password = $_POST["filepassword"];

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

        $cookiesArray = isset($_COOKIE['filecookies']) ? json_decode($_COOKIE['filecookies'], true) : array();

        // Adiciona os novos dados ao array de cookies
        $cookiesArray[] = array(
            'mensagem' => "Descarregou ficheiros",
            'hora' => date('Y-m-d H:i:s')
        );

        setcookie('filecookies', json_encode($cookiesArray), time() + 3600, '/'); // expira em 1 hora


        if (password_verify($password, $dbPassword)) {
            $response['status'] = "ok";
            $response['message'] = "Sucesso";
            echo json_encode($response);
        } else {
            $response['status'] = "erro";
            $response['message'] = "Error";
            echo json_encode($response);
        }
    }
}
