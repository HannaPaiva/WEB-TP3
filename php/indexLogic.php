<?php
function buscarUsername()
{
    require 'conn.php';
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        $sql = "SELECT nome FROM utilizadores WHERE userid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ucwords($result["nome"]);
    }
}

function buscarFicheirosporEu()
{
    require 'conn.php';

    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        $sql = "SELECT COUNT(*) AS total FROM acessos WHERE userid = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["total"];
    }
}


function buscarFicheirosProtegidos()
{
    require 'conn.php';
    if (isset($_SESSION["user"])) {
        $sql = "SELECT COUNT(*) AS total FROM acessos WHERE publico = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["total"];
    }
}

function buscarFicheirosPublicos()
{
    require 'conn.php';
    if (isset($_SESSION["user"])) {
        $sql = "SELECT COUNT(*) AS total FROM acessos WHERE publico = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["total"];
    }
}

// logica de buscar o nome sem funcao
require 'conn.php';

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $sql = "SELECT nome, tipo FROM utilizadores WHERE userid = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if $result is not empty before encoding to JSON
    if ($result) {
        echo ucwords($result["nome"]);
        echo $result["tipo"];
    } else {
        // Handle the case where no data is found
        echo json_encode(array('error' => 'No data found'));
    }
} else {
    // Handle the case where the user is not authenticated
    echo json_encode(array('error' => 'User not authenticated'));
}
?>