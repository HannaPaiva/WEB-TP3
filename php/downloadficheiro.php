<?php
    require 'conn.php';
    include '../views/mostrarficheiros.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $password_ficheiro = $_POST["password"];
      $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
  }
    $sql = "SELECT * FROM acessos WHERE password_ficheiro = :password_ficheiro";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':password_ficheiro', $password_encriptada);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $dbPassword_ficheiro = $result['password_ficheiro'];
            if ($password_ficheiro == $dbPassword_ficheiro){
                echo ("");
            }
        header("Location: ../views/mostrarficheiros.php");
    } else {
        echo "Password do ficheiro errada: $password_ficheiro";
    }
?>
