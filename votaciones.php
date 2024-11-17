<?php

$servername = "localhost";
$username = "root";
$password = "super3";

try {
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select idAnimes,Nom, IFNULL(PuntsTotals/NumeroVots,0) as media from webanimes.animes order by IFNULL(PuntsTotals/NumeroVots,0) DESC, Nom, NumeroVots");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if($query->rowCount() >= 1) {

        print_r(json_encode($result));

    } else{
        print_r("No hi ha registres.");
    }


} catch(PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}
?>
