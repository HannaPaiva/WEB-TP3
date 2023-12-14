<?php
    require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
}

 
require_once "conn.php";
 
$sql = "SELECT * FROM utilizadores WHERE email = '$email'";

$stmt = $pdo->prepare($sql);


$result = $stmt->execute();

print_r($stmt);

    if ($email == $email_db && $password == $password_db){
        
    }




?>




 
 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
 
  $idCompra = $pdo->lastInsertId();
 
foreach ($produtosArray as $produto) {
  $nomeProduto = $produto["product"];
  $precoProduto = $produto["price"];
 
  // Obter o ID real do produto da tabela 'produtos'
  $stmtProduto = $pdo->prepare("SELECT id FROM produtos WHERE name = :nomeProduto");
  $stmtProduto->bindParam(':nomeProduto', $nomeProduto);
  $stmtProduto->execute();
  $produtoInfo = $stmtProduto->fetch(PDO::FETCH_ASSOC);
 
  if ($produtoInfo) {
    $idProduto = $produtoInfo['id'];
 
    // Inserir na tabela 'carrinho'
    $stmtCarrinho = $pdo->prepare("INSERT INTO carrinho (idProduto, precoProduto, idCompra) VALUES (:idProduto, :precoProduto, :idCompra)");
    $stmtCarrinho->bindParam(':idProduto', $idProduto);
    $stmtCarrinho->bindParam(':precoProduto', $precoProduto);
    $stmtCarrinho->bindParam(':idCompra', $idCompra);
    $stmtCarrinho->execute();
  }
}
 
echo ("sucesso");
 

$stmt = $pdo->prepare("SELECT
  c.nomeCliente,
  GROUP_CONCAT(p.name) AS produtos_comprados,
  c.total
FROM
  compras c
JOIN carrinho cr ON c.idcompra = cr.idCompra
JOIN produtos p ON cr.idProduto = p.id
GROUP BY
  c.nomeCliente, c.total;
");
 
  $stmt->execute();
 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);