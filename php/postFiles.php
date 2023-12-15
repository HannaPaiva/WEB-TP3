<?php
require_once "conn.php";

session_start();

if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {

        $dataficheiro = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

        // Informações sobre o arquivo
        $nomeficheiro = $_FILES["fileToUpload"]["name"];
        $enviado_em = date("Y-m-d H:i:s");

        // Obter o tipo MIME do arquivo
        $tipo = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);

        // Preparar a consulta SQL para inserir os dados na base de dados
        $stmt = $pdo->prepare("INSERT INTO ficheiros (nomeficheiro, dataficheiro, enviado_em, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $nomeficheiro);
        $stmt->bindParam(2, $dataficheiro, PDO::PARAM_LOB);
        $stmt->bindParam(3, $enviado_em);
        $stmt->bindParam(4, $tipo);

        
        // Executar a consulta SQL
        if ($stmt->execute()) {
            echo "O arquivo $nomeficheiro foi enviado com sucesso e registrado na base de dados.";
        } else {
            echo "Erro ao registrar na base de dados.";
        }

        $fileid = $pdo->lastInsertId();

        $password_ficheiro ="asdhuasyuidhasdasd";
        $publico = 1;

        $stmt2 = $pdo->prepare("INSERT INTO acessos (userid, fileid, password_ficheiro, publico) VALUES (?, ?, ?, ?)");
        $stmt2->bindParam(1, $user);
        $stmt2->bindParam(2, $fileid, PDO::PARAM_LOB);
        $stmt2->bindParam(3, $password_ficheiro);
        $stmt2->bindParam(4, $publico);

        if ($stmt2->execute()) {
            echo "sucesso";
        } else {
            echo "Erro";
        }
        
    } else {
        echo "Erro no envio do arquivo.";
    }
}
