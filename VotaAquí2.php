<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "super3";

$puntuacionaleatoria = rand(0, 10);

try {
    //OBTENER USUARIO DE FORMA ALEATORIA-----------------------------
    $conn = new PDO("mysql:host=$servername;dbname=webanimes", $username, $password);
    $query = $conn->prepare("select * from users");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $numrandom = rand(0,sizeof($result)-1); //número random desde 0 hasta el tamaño del resultado (ponemos -1 para arreglarlo)
    $result[$numrandom];
    $usuarioaleatorio = $result[$numrandom]["id"]; //de los resultados, cogemos una fila random y cogemos su "id"
     //print_r(json_encode($usuarioaleatorio));

    //OBTENER ANIME DE FORMA ALEATORIA---------------------------------
    $query = $conn->prepare("select * from animes");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $numrandom = rand(0,sizeof($result)-1); //número random desde 0 hasta el tamaño del resultado (ponemos -1 para arreglarlo)
    $result[$numrandom];
    $animealeatorio = $result[$numrandom]["idAnimes"];
    //print_r(json_encode($animealeatorio));


    //COMPROBAMOS SI EL USUARIO SE ENCUENTRA EN LA TABLA "usuarianime"
    $query = $conn->prepare("select * from usuarianime where idusuari=:usuarioaleatorio");
    $query ->bindParam("usuarioaleatorio",$usuarioaleatorio,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC); //Si hacemos un fetchAll tenemos que especificar abajo cuál resultado coger[]
    //print_r(json_encode($result[0]["usuarianimeratings"]));

    //ENCUENTRA AL USUARIO
    if ($query->rowCount() >= 1) {

        //VERIFICAMOS SI YA HA VALORADO EL ANIME
        $query = $conn->prepare("select usuarianimeratings from usuarianime where idusuari=:usuarioaleatorio");
        $query->bindParam("usuarioaleatorio", $usuarioaleatorio, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $animevotado = json_decode($result["usuarianimeratings"], true); //true es para hacerlo que devuelva como array

        //Cuando es true, los objects JSON devueltos serán convertidos a array asociativos, cuando es false los objects JSON devueltos
        // serán convertidos a objects. Cuando es null, los objects JSON serán convertidos a array asociativos u objects dependiendo
        // de si JSON_OBJECT_AS_ARRAY es establecida en los flags

        //print_r(json_encode($animevotado)); esto me da lo siguiente: del $animevotado fila 0 el "anime"

        $flag = false;
        foreach ($animevotado as $anime) {
            $a = $anime["anime"];
            if ($a == $animealeatorio) {
                $flag = true;
            }
        }

        //EL USUARIO YA HA VALORADO EL ANIME
        if ($flag) {
            $array_assoc = array("Estat" => "KO", "Error" => "El usuario ya ha votado este anime.", "Usuari" => $usuarioaleatorio, "Anime" => $animealeatorio);
            print_r(json_encode($array_assoc));
            exit();

            //EL USUARIO TODAVÍA NO HA VALORADO EL ANIME, LO INSERTAMOS
        }else {
            $parainsertar = '{"anime":'.$animealeatorio.', "rating":'.$puntuacionaleatoria.'}';
            //print_r(json_encode($parainsertar));
            array_push($animevotado, json_decode($parainsertar, true)); //en json_decode convertimos el string en objeto json
            $animevotadodef = json_encode($animevotado);

            $query = $conn->prepare("update usuarianime set usuarianimeratings=:animevotado where idusuari=:usuarioaleatorio");
            $query->bindParam("animevotado", $animevotadodef, PDO::PARAM_STR);
            $query->bindParam("usuarioaleatorio", $usuarioaleatorio, PDO::PARAM_STR);

            $resultinsert = $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $array_assoc = array("Estat" => "OK", "Error" => "Se han actualizado las votaciones del usuario.", "Usuari" => $usuarioaleatorio, "Anime" => $animealeatorio, "Puntuacion" => $puntuacionaleatoria);
            print_r(json_encode($array_assoc));

        }

    }


    ///SI NO ENCUENTRA AL USUARIO, AÑADE ANIME ALEATORIO Y RATING ALEATORIO
    else {
        $query = $conn->prepare("insert into usuarianime (idusuari) values (:usuarioaleatorio)");
        $query->bindParam("usuarioaleatorio",$usuarioaleatorio, PDO::PARAM_STR);

        $resultinsert = $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $parainsertar = '[{"anime":'.$animealeatorio.', "rating":'.$puntuacionaleatoria.'}]';
        $query = $conn->prepare("update usuarianime set usuarianimeratings=:animevotado where idusuari=:usuarioaleatorio");
        $query->bindParam("usuarioaleatorio",$usuarioaleatorio, PDO::PARAM_STR);
        $query->bindParam("animevotado",$parainsertar, PDO::PARAM_STR);

        $resultinsert = $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $array_assoc = array("Estat" => "OK", "Error" => "Se ha añadido un nuevo usuario en la BB.DD., junto con un anime y puntuación aleatoria.", "Usuari" => $usuarioaleatorio, "Anime" => $animealeatorio);
        print_r(json_encode($array_assoc));
    }

    //ACTUALIZAMOS LA TABLA DE ANIMES CON EL NUMERO DE VOTOS Y LOS PUNTOS TOTALES
    //(EN EL CASO DE QUE NO ESTUVIERA VALORADO YA ANTERIORMENTE POR EL USUARIO)
    //AQUÍ OBTENEMOS LOS VALORES ACTUALES DE "NumeroVots" y "PuntsTotales"
    $query = $conn->prepare("select NumeroVots, PuntsTotals from animes where idAnimes=:animealeatorio");
    $query->bindParam("animealeatorio",$animealeatorio, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $numerovots = $result["NumeroVots"]+1;
    $punttotals = $result["PuntsTotals"]+$puntuacionaleatoria;


    //Y AQUÍ HACEMOS UN UPDATE CON EL "NumeroVots" y "PuntsTotales" AUMENTADO
    $query = $conn->prepare("update animes set NumeroVots=:numerovots, PuntsTotals=:puntsTotals where idAnimes=:animealeatorio");
    $query->bindParam("animealeatorio",$animealeatorio, PDO::PARAM_INT);
    $query->bindParam("numerovots",$numerovots, PDO::PARAM_INT);
    $query->bindParam("puntsTotals",$punttotals, PDO::PARAM_INT);

    $resultupdate = $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    print_r("Connection failed: " . $e->getMessage());
}



