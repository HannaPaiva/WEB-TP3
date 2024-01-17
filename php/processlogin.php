<?php
require 'conn.php';
require 'cookie-login.php'; 
function verify_password($input_password, $hashed_password_from_database) {
    return password_verify($input_password, $hashed_password_from_database);
}
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
           
            $response['status'] = "200";
            echo json_encode($response);
        } else {
            $response['status'] = "500";
            echo json_encode($response);
        }
    } else {
        echo "E-mail inserido não encontrado: $email";
    }
}
?>
