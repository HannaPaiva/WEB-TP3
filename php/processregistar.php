<?php
    require 'conn.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
  }
    
    $sql = "INSERT into utilizadores VALUES(DEFAULT, :email, :password)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password_encriptada);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<script>alert("Usuário inserido com sucesso!");</script>';
        header("Location: ../views/login.php");
    } else {
        echo '<script>alert("Erro na criação");</script>';
        header("Location: ../views/registar.php");

    }
?>
