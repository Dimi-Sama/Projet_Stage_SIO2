<?php

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();

$sql = "SELECT * FROM users ORDER BY id ASC";
// Pour éviter les injections SQL
$result = $conn->prepare($sql);
$result->bindparam(':user', $user);
$result->execute();

    $delimiter = ";";
    $filename = "user_liste_" . date('d-m-Y') . ".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('ID', 'Nom', 'Prenom', 'UserName', 'Email', 'Numero Telephone', 'Adresse Rue', 'Ville','Code Postal');
    fputcsv($f, $fields, $delimiter);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['id'], $row['nom'], $row['prenom'], $row['username'], $row['mail'], $row['numTel'], $row['adrRue'],$row['ville'],$row['codePostal']);
        fputcsv($f, $lineData, $delimiter);
    }
 
    fseek($f, 0);


    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
exit;
