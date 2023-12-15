<?php
require "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ficheiro = $_FILES["ficheiro"];

    // verificacao de erro
    if ($ficheiro["error"] == UPLOAD_ERR_OK) {

        // Lê o conteudo
        $conteudoFicheiro = file_get_contents($ficheiro["tmp_name"]);

        // Insere na base de dados
        $sql = "INSERT INTO files (nomeficheiro, tipo, dataficheiro, enviado_em) VALUES (:nomeficheiro, :tipo, :dataficheiro, CURRENT_TIMESTAMP)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nomeficheiro', $ficheiro["name"]);
        $stmt->bindParam(':tipo', $ficheiro["type"]);
        $stmt->bindParam(':dataficheiro', $conteudoFicheiro, PDO::PARAM_LOB);

        // Verificação de inserção
        if ($stmt->execute()) {
            header("Location: ../views/mostrarficheiros.php");
        } else {
            echo "Erro ao inserir o ficheiro, por favor tente de novo!";
        }

    } else {
        echo "Erro: " . $ficheiro["error"];
    }
}
?>
