<?php

// Obtém o array de cookies e converte para PHP array
$cookiesArray = isset($_COOKIE['filecookies']) ? json_decode($_COOKIE['filecookies'], true) : array();

// Envia a resposta como JSON
header('Content-Type: application/json');
echo json_encode($cookiesArray);

?>