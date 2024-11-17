<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "super3";

try {
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select * from users where nom=:nom");
    $query->bindParam("nom",$_SESSION['sessiousuari'],PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() >= 1){
        $array_assoc = array("Estat" =>"OK", "Error" => "", "Usuari" => $_SESSION['sessiousuari']);
        print_r(json_encode($array_assoc));
        session_destroy();
        exit(); //esto funciona como un "break", si entra aquí, sale del código, ya no continua
    }
    else{
        $array_assoc = array("Estat" =>"KO", "Error" => "No hay ninguna sesión activa", "Usuari"=> $_SESSION['sessiousuari']);
        print_r(json_encode($array_assoc));
    }

} catch(PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}