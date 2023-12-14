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
        $dbEmail = $result['email'];
        $dbPassword = $result['password'];
            if ($email = $dbEmail && $password == $password){
                session_start();
                    if(isset($_SESSION["user"])){
                        $_SESSION["user"] = $result["userid"];
                        
          }
          
        }
        echo "Email from database: $dbEmail<br>";
        echo "Password from database: $dbPassword";
        echo "<script>window.alert('Registado com sucesso');</script>";
        header("Location: ../views/login.php");
    } else {
        echo "<script>window.alert('Erro na criação');</script>";
        header("Location: ../views/registar.php");

    }
?>
