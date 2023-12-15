<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM utilizadores WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $dbEmail = $result['email'];
        $dbPassword = $result['password'];

        if (verify_password($password, $dbPassword)) {
            session_start();
            $_SESSION["user"] = $result["userid"];
            header("Location: ../views/index.php");
            exit(); // Importante: Encerre o script após redirecionamento para evitar execução adicional
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "E-mail inserido não encontrado: $email";
    }
}

// Função para verificar a senha
function verify_password($input_password, $hashed_password_from_database) {
    // Lógica para verificar a senha, por exemplo, usando password_verify
    return password_verify($input_password, $hashed_password_from_database);
}
?>
