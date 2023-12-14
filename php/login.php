<?php
    require 'conn.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $email = $_POST["email"];
      $password = $_POST["password"];
  }
    $sql = "SELECT * FROM utilizadores WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
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
        header("Location: ../html/index.html");
    } else {
        echo "No matching record found for email: $email";
    }
?>
