<?php 

require_once "conn.php";
$stmt = $pdo->prepare("SELECT
u.userid AS userid,
u.nome AS username,
f.id AS fileid,
f.nomeficheiro AS nomeficheiro,
f.dataficheiro AS dataficheiro,
f.enviado_em AS enviado_em
FROM acessos a
INNER JOIN utilizadores u ON a.userid = u.userid
INNER JOIN ficheiros f ON a.fileid = f.id;
ORDER by f.enviado_em ASC
");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$files = [];

foreach ($result as $row) {
    $files[] = [
        'fileid' => $row['fileid'],
        'userid' => $row['userid'],
        'username' => $row['username'],
        'nomeficheiro' => $row['nomeficheiro'],
        'dataficheiro' => base64_encode($row['dataficheiro']),
        'enviado_em' => $row['enviado_em'],

    ];
}

echo json_encode($files);

?>




