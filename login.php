<?php

session_start();
$ajax_nom = $_POST["nom"];
$ajax_contrasenya = $_POST["contrasenya"];


$servername = "localhost";
$username = "root";
$password = "super3";

try {
    //PRIMERO MIRAMOS SI TENEMOS ALGUNA SESIÓN ACTIVA
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select * from users where nom=:nom");
    $query->bindParam("nom",$_SESSION['sessiousuari'],PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() >= 1){ //SI HAY ALGUNA SESIÓN ACTIVA, NOS INFORMARÁ MEDIANTE EL ERROR
        $array_assoc = array("Estat" =>"KO", "Error" => "Ya existe una sesión activa. Primero tendrás que desloguearte' para loguearte con otro usuario", "User" => $ajax_nom);
        print_r(json_encode($array_assoc));
        exit(); //esto funciona como un "break", si entra aquí, sale del código, ya no continua
    }

    //SI NO TENEMOS NINGUNA SESIÓN ACTIVA, COMPROBAMOS QUE EL USUARIO COINCIDA CON LA CONTRASEÑA DE LA BB.DD.
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select * from users where nom=:nom && password=:contra");
    $query->bindParam("nom",$ajax_nom,PDO::PARAM_STR);
    $query->bindParam("contra",$ajax_contrasenya,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() >= 1){ //SI EL USUARIO Y CONTRASEÑA COINCIDE, HACEMOS LOGIN INICIANDO UNA SESIÓN
        session_destroy();
        $array_assoc = array("Estat" => "OK", "Error" => "", "User" => $ajax_nom);
        print_r(json_encode($array_assoc));
        session_start();
        $_SESSION['sessiousuari'] = $ajax_nom;
        exit(); //esto funciona como un "break", si entra aquí, sale del código, ya no continua
    }

    //SI EL USUARIO ESTÁ EN LA BB.DD. PERO NO COINCIDE LA CONTRASEÑA
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select * from users where nom=:nom && password<>:contra");
    $query->bindParam("nom",$ajax_nom,PDO::PARAM_STR);
    $query->bindParam("contra",$ajax_contrasenya,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() >= 1){ //SI NOS DEVUELVE 1 O MÁS DE UNO, ES QUE LA CONTRASEÑA ES INCORRECTA
        $array_assoc = array("Estat" => "KO", "Error" => "Credencial incorrecta para el usuario:", "User" => $ajax_nom);
        print_r(json_encode($array_assoc));
        exit();
    }

    //FINALMENTE, SI NO LO ENCUENTRA EN LA BB.DD. INDICARÁ QUE EL USUARIO NO EXISTE
    $array_assoc = array("Estat" =>"KO", "Error" => "El usuario no existe:", "User" => $ajax_nom);
    print_r(json_encode($array_assoc));


} catch(PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}
?>
