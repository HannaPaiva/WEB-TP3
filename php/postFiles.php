<?php
require_once "conn.php";

session_start();

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"][0])) {

        $total_files = count($_FILES['fileToUpload']['name']);

        for ($i = 0; $i < $total_files; $i++) {
            $dataficheiro = file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);

            $nomeficheiro = $_FILES["fileToUpload"]["name"][$i];
            $enviado_em = date("Y-m-d H:i:s");
            $tipo = mime_content_type($_FILES["fileToUpload"]["tmp_name"][$i]);

        // Preparar a consulta SQL para inserir os dados na base de dados
        $stmt = $pdo->prepare("INSERT INTO ficheiros (nomeficheiro, tipo, dataficheiro, enviado_em) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $nomeficheiro);
        $stmt->bindParam(2, $tipo);
        $stmt->bindParam(3, $dataficheiro, PDO::PARAM_LOB);
        $stmt->bindParam(4, $enviado_em);

        // Executar a consulta SQL
        if ($stmt->execute()) {
            echo "O arquivo $nomeficheiro foi enviado com sucesso e registrado na base de dados.";
        } else {
            echo "Erro ao registrar na base de dados.";
        }

            $fileid = $pdo->lastInsertId();

        // Verificar se o arquivo é privado
        $isPrivate = isset($_POST['isPrivate']) ? $_POST['isPrivate'] : 0;
        $password_ficheiro = ($isPrivate == 1) ? $_POST["passwordFicheiro"] : null;

        $stmt2 = $pdo->prepare("INSERT INTO acessos (userid, fileid, password_ficheiro, publico) VALUES (?, ?, ?, ?)");
        $stmt2->bindParam(1, $user);
        $stmt2->bindParam(2, $fileid, PDO::PARAM_LOB);
        $stmt2->bindParam(3, $password_ficheiro);
        $stmt2->bindParam(4, $isPrivate);

        if ($stmt2->execute()) {
            echo "Sucesso";
        } else {
            echo "Erro";
        }
    } else {
        echo "Erro no envio do arquivo.";
    }
}
?>