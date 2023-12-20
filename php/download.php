<?php
require_once "conn.php";

if (isset($_GET['idpasta'])) {
    $idpasta = $_GET['idpasta'];

    // Busca os nomes dos arquivos na base de dados
    $stmt = $pdo->prepare("SELECT nomeficheiro, dataficheiro FROM ficheiros WHERE idpasta = ?");
    $stmt->execute([$idpasta]);
    $files = $stmt->fetchAll();

    $zip = new ZipArchive();
    $zip_name = tempnam('tmp', 'zip');
    $zip->open($zip_name, ZipArchive::CREATE);

    foreach ($files as $file) {
        $zip->addFromString($file['nomeficheiro'], $file['dataficheiro']);
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="arquivos.zip"');
    header('Content-Length: ' . filesize($zip_name));

    readfile($zip_name);
    unlink($zip_name);
}
?>
