<?php

// Supondo que você já tenha uma conexão PDO chamada $pdo
require 'conn.php';
$query = "
    SELECT
        p.idpasta,
        p.nomepasta,
        GROUP_CONCAT(f.nomeficheiro) AS lista_de_ficheiros,
        GROUP_CONCAT(f.id) AS lista_de_ids,
        GROUP_CONCAT(f.tipo) AS lista_de_tipos,
        GROUP_CONCAT(f.dataficheiro) AS lista_de_datas,
        MAX(f.enviado_em) AS enviado_em_ultima_atualizacao
    FROM
        pasta p
        LEFT JOIN acessos a ON p.idpasta = a.idpasta
        LEFT JOIN ficheiros f ON a.fileid = f.id
    GROUP BY
        p.idpasta, p.nomepasta
    ORDER BY
        p.idpasta, enviado_em_ultima_atualizacao
";

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// Formatar os campos de lista como arrays
foreach ($result as &$row) {
    $row['lista_de_ficheiros'] = explode(',', $row['lista_de_ficheiros']);
    $row['lista_de_ids'] = explode(',', $row['lista_de_ids']);
    $row['lista_de_tipos'] = explode(',', $row['lista_de_tipos']);
    $row['lista_de_datas'] = explode(',', $row['lista_de_datas']);
}

// Transformando o resultado em um formato JSON
$jsonResult = json_encode($result);

// Enviando o JSON para o frontend
header('Content-Type: application/json');
var_dump( $result);

// Certifique-se de adicionar 'exit' após o 'echo'
exit;
