<?php
require_once "conn.php";

if (isset($_GET['idpasta'])) {
    $idpasta = $_GET['idpasta'];

    // Busca os arquivos na base de dados usando a consulta SQL fornecida
    $stmt = $pdo->prepare("
        SELECT
            p.idpasta,
            p.nomepasta,
            u.nome as utilizador,
            GROUP_CONCAT(f.nomeficheiro) AS lista_de_ficheiros,
            GROUP_CONCAT(f.id) AS lista_de_ids,
            GROUP_CONCAT(f.tipo) AS lista_de_tipos,
            GROUP_CONCAT(f.dataficheiro) AS lista_de_datas,
            MAX(f.enviado_em) AS enviado_em_ultima_atualizacao
        FROM
            pasta p
        LEFT JOIN acessos a ON p.idpasta = a.idpasta
        LEFT JOIN ficheiros f ON a.fileid = f.id
        LEFT JOIN utilizadores u ON a.userid = u.userid
        WHERE
            p.idpasta = ?
        GROUP BY
            p.idpasta, p.nomepasta, u.userid
        ORDER BY
            p.idpasta, enviado_em_ultima_atualizacao
    ");
    $stmt->execute([$idpasta]);
    $files = $stmt->fetchAll();

    $zip = new ZipArchive();
    $zip_name = tempnam('tmp', 'zip');
    $zip->open($zip_name, ZipArchive::CREATE);

    foreach ($files as $file) {
        $file_names = explode(',', $file['lista_de_ficheiros']);
        $file_datas = explode(',', $file['lista_de_datas']);
        for ($i = 0; $i < count($file_names); $i++) {
            $zip->addFromString($file_names[$i], $file_datas[$i]);
        }
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="arquivos.zip"');
    header('Content-Length: ' . filesize($zip_name));

    readfile($zip_name);
    unlink($zip_name);
}
?>
