<?php 


  require_once "conn.php";
  $stmt = $pdo->prepare("SELECT * FROM ficheiros");

  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



$product = [];

foreach ($result as $row) {
    $product[] = [
        'id'    => $row['id'],
        'name'  => $row['name'],
        'price' => $row['price'],
        'imageSrc' => $row['imageSrc']
    ];
};

print_r (json_encode($product));
?>




