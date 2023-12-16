<?php

require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["fileid"]) && isset($_POST["password"])) {
        $fileid = $_POST["fileid"];
        $password = $_POST["password"];

        try {
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
                    return "ok";
                } else {
                    return "no";
                }
            } else {
                echo "Erro: ID do arquivo não encontrado.";
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
        }

    } else {
        echo "Erro: Variáveis não definidas.";
    }
}
