<?php

$ajax_contrasenya = $_POST["contrasenya"];
$ajax_email = $_POST["email"];

session_start();

$servername = "localhost";
$username = "root";
$password = "super3";


try {
    //SI TENEMOS UNA SESIÓN ACTIVA, NO DEJA REGISTRARSE
    if (isset($_SESSION['sessiousuari'])){ //isset TE DEVUELVE true SI LA VARIABLE TIENE VALOR/ESTÁ DEFINIDA
        $array_assoc = array("Estat" =>"KO", "Error" => "Hay un usuario loqueado. Hasta que no se desloguee no te puedes registrar.", "Usuari" => $ajax_email);
        print_r(json_encode($array_assoc));
        exit();
    }

    //COMPROBAMOS SI EL USUARIO YA EXISTE
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query =$conn->prepare ("select * from users where nom=:email");
    $query->bindParam("email",$ajax_email,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    //EL USUARIO YA EXISTE
    if ($query->rowCount() >= 1){
        $array_assoc = array("Estat" =>"KO", "Error" => "El usuario ya existe", "Usuari" => $ajax_email);
        print_r(json_encode($array_assoc));
        exit();
    }

    //E-MAIL ES INCORRECTO
    if (substr_compare($ajax_email, '@ies-sabadell.cat', -17, 17) != 0) {
    $array_assoc = array("Estat" => "KO", "Error" => "E-mail incorrecto:", "Usuari" => $ajax_email);
    print_r(json_encode($array_assoc));
    exit();
    }

    //COMO EL USUARIO NO EXISTE Y EL E-MAIL ES CORRECTO, LO INSERTAMOS
    else if (substr_compare($ajax_email, '@ies-sabadell.cat', -17, 17) == 0){
        $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
        $query =$conn->prepare ("insert into users (nom, password) values (:email, :contrasenya)");
        $query->bindParam("email",$ajax_email,PDO::PARAM_STR);
        $query->bindParam("contrasenya",$ajax_contrasenya,PDO::PARAM_STR);

        $resultinsert = $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        session_destroy();
        session_start();
        $_SESSION['sessiousuari'] = $ajax_email;

       $array_assoc = array("Estat" =>"OK", "Error" => "Registro correcto:", "Usuari" => $ajax_email);
       print_r(json_encode($array_assoc));

}
} catch(PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}

?>
