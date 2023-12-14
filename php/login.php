<?php
    require 'conn.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $email = $_POST["email"];
      $password = $_POST["password"];
  }
    $sql = "SELECT email, password FROM utilizadores WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Store email and password in variables
        $dbEmail = $result['email'];
        $dbPassword = $result['password'];

        echo "Email from database: $dbEmail<br>";
        echo "Password from database: $dbPassword";
    } else {
        echo "No matching record found for email: $email";
    }
?>
