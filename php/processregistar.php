<?php
require 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
}

$sql = "INSERT into utilizadores VALUES(DEFAULT, :email, :password, :tipo, :nome)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password_encriptada);
$stmt->bindParam(':tipo', $tipo);
$stmt->bindParam(':nome', $nome);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo 'sucesso';
  
    exit();
} else {
    echo 'erro';
    header("Location: ../views/registar.php");
    exit();
}
