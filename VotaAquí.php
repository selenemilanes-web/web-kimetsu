<?php


$nomanime = $_POST["nom"];

session_start();

$servername = "localhost";
$username = "root";
$password = "super3";

try {
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query = $conn->prepare("select * from animes where nom=:nomanime");
    $query->bindParam("nomanime", $nomanime, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() >= 1) {
        $array_assoc = array("Estat" => "KO", "Error" => "El anime ya existe en la BB.DD.", "Usuari" => $nomanime);
        print_r(json_encode($array_assoc));
        exit();
    }

    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query = $conn->prepare("insert into animes (Nom) values (:nomanime)");
    $query->bindParam("nomanime", $nomanime, PDO::PARAM_STR);

    $resultinsert = $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $array_assoc = array("Estat" => "OK", "Error" => "El anime se ha registrado correctamente en la BB.DD.", "Usuari" => $nomanime);
    print_r(json_encode($array_assoc));


} catch (PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}


