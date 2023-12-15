<?php
//     require 'conn.php';
//     if ($_SERVER["REQUEST_METHOD"] == "POST"){
//       $email = $_POST["email"];
//       $password = $_POST["password"];
//   }
//     $sql = "SELECT * FROM utilizadores WHERE email = :email";

//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':email', $email);
//     $stmt->execute();

//     $result = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($result) {
//         $dbEmail = $result['email'];
//         $dbPassword = $result['password'];
//             if ($email = $dbEmail && $password == $password){
//                 session_start();
//                     if(isset($_SESSION["user"]) && isset($_SESSION["tipo"]) ){
//                         $_SESSION["user"] = $result["userid"];
//                         $_SESSION["user"] = $result["tipo"];
//           }
          
//         }
//         header("Location: ../views/index.php");
//     } else {
//         echo "E-mail inserido não encontrado: $email";
//     }


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

        // Password verification using password_verify
        if (password_verify($password, $dbPassword)) {
            session_start();
            if (isset($_SESSION["user"]) && isset($_SESSION["tipo"])) {
                $_SESSION["user"] = $result["userid"];
                $_SESSION["tipo"] = $result["tipo"];
            }
            header("Location: ../views/index.php");
            exit(); // It's a good practice to exit after a header redirect
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "E-mail inserido não encontrado: $email";
    }
}
?>

