<?php
require_once "conn.php";

session_start();

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];

    $password_ficheiro = $_POST["password"];
    $password_encriptada = password_hash($password_ficheiro, PASSWORD_DEFAULT);
    $nomepasta = $_POST["nomepasta"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"][0])) {

            $total_files = count($_FILES['fileToUpload']['name']);
            $max_allowed_size = 10 * 1024 * 1024; // 10 MB (ajuste conforme necessário)

            $contador = 0;
            for ($i = 0; $i < $total_files; $i++) {
                $file_size = $_FILES["fileToUpload"]["size"][$i];

                if ($file_size > $max_allowed_size) {
                    echo "Erro: Arquivo excede o limite permitido.";
                    continue; // Pula para o próximo arquivo
                }

                $dataficheiro = file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);
                $nomeficheiro = $_FILES["fileToUpload"]["name"][$i];
                date_default_timezone_set('Europe/Lisbon');

                
                $cookiesArray = isset($_COOKIE['filecookies']) ? json_decode($_COOKIE['filecookies'], true) : array();

                // Adiciona os novos dados ao array de cookies
                $cookiesArray[] = array(
                    'mensagem' => "Submeteu ficheiros",
                    'hora' => date('Y-m-d H:i:s')
                );

                setcookie('filecookies', json_encode($cookiesArray), time() + 3600, '/'); // expira em 1 hora


                $enviado_em = date("Y-m-d H:i:s");
                $tipo = mime_content_type($_FILES["fileToUpload"]["tmp_name"][$i]);

                $stmt = $pdo->prepare("INSERT INTO ficheiros (nomeficheiro, dataficheiro, enviado_em, tipo) VALUES (?, ?, ?, ?)");
                $stmt->bindParam(1, $nomeficheiro);
                $stmt->bindParam(2, $dataficheiro, PDO::PARAM_LOB);
                $stmt->bindParam(3, $enviado_em);
                $stmt->bindParam(4, $tipo);

                if ($stmt->execute()) {
                    $publico = empty($password_ficheiro) ? 0 : 1;
                    $fileid = $pdo->lastInsertId();

                    if ($total_files > 1 && $contador == 0) {
                        $inserirpasta = $pdo->prepare("INSERT INTO pasta (nomepasta, passwordpasta) VALUES (?, ?)");
                        $inserirpasta->bindParam(1, $nomepasta);
                        $inserirpasta->bindParam(2, $password_encriptada);
                        $inserirpasta->execute();

                        $idpasta = $pdo->lastInsertId();
                        $contador++;
                    }

                    $stmt2 = $pdo->prepare("INSERT INTO acessos (userid, fileid, password_ficheiro, publico, idpasta) VALUES (?, ?, ?, ?, ?)");
                    $stmt2->bindParam(1, $user);
                    $stmt2->bindParam(2, $fileid);
                    $stmt2->bindParam(3, $password_encriptada);
                    $stmt2->bindParam(4, $publico);
                    $stmt2->bindParam(5, $idpasta);

                    if (!$stmt2->execute()) {
                        $response['message'] = "Erro ao registrar na base de dados.";
                        $response['status'] = "error";
                    }
                }
            }

            echo json_encode($response);
        }
    } else {
        $response['message'] = "Um ou todos os arquivos excedem o tamanho permitido.";
        $response['status'] = "error";

        echo json_encode($response);
    }
}
?>
