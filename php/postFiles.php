<?php
require_once "conn.php";

session_start();

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"][0])) {

        $total_files = count($_FILES['fileToUpload']['name']);
        $max_allowed_size = 10 * 1024 * 1024; // 10 MB (ajuste conforme necessário)

        for ($i = 0; $i < $total_files; $i++) {
            $file_size = $_FILES["fileToUpload"]["size"][$i];

            if ($file_size > $max_allowed_size) {
                echo "Erro: Arquivo excede o limite permitido.";
                continue; // Pula para o próximo arquivo
            }

            $dataficheiro = file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);

            $nomeficheiro = $_FILES["fileToUpload"]["name"][$i];
            $enviado_em = date("Y-m-d H:i:s");
            $tipo = mime_content_type($_FILES["fileToUpload"]["tmp_name"][$i]);

            $stmt = $pdo->prepare("INSERT INTO ficheiros (nomeficheiro, dataficheiro, enviado_em, tipo) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $nomeficheiro);
            $stmt->bindParam(2, $dataficheiro, PDO::PARAM_LOB);
            $stmt->bindParam(3, $enviado_em);
            $stmt->bindParam(4, $tipo);

            if ($stmt->execute()) {
                echo "O arquivo $nomeficheiro foi enviado com sucesso e registrado na base de dados.";
            } else {
                echo "Erro ao registrar na base de dados.";
            }

            $fileid = $pdo->lastInsertId();

            // $password_ficheiro = "asdhuasyuidhasdasd";
            // $publico = 1;

            $publico = isset($_POST['publico']) ? $_POST['publico'] : 0;
            $password_ficheiro = isset($_POST["passwordFicheiro"]) ? $_POST["passwordFicheiro"] : "";
            print("PASSWORD INSERIDA: " . $password_ficheiro);
           
            $password_encriptada = password_hash($password_ficheiro, PASSWORD_DEFAULT);

            print("PASSWORD ENCRIPTADA: " .  $password_encriptada);

            $stmt2 = $pdo->prepare("INSERT INTO acessos (userid, fileid, password_ficheiro, publico) VALUES (?, ?, ?, ?)");
            $stmt2->bindParam(1, $user);
            $stmt2->bindParam(2, $fileid);
            $stmt2->bindParam(3, $password_encriptada );
            $stmt2->bindParam(4, $publico);

            if ($stmt2->execute()) {
                echo "sucesso";
                
            } else {
                echo "Erro";
            }
        }

    } else {
        echo "Erro: Nenhum arquivo enviado ou todos os arquivos excedem o tamanho permitido.";
    }
}
?>
