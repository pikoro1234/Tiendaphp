<?php

    function conexion(){

        $user = "id8972026_hostjorge";

        $password = "L(K22yM/ddK!sG!R";

        $serve = "localhost";

        $db = "id8972026_webhost";

        //$con = mysqli_connect($serve,$user,$password,$db);

        $con =new mysqli($serve,$user,$password,$db);

        if (!$con) {

            return "no se pudo establecer la conexion con la base de datos";

        }else{

            return $con;
        }
    }
?>
