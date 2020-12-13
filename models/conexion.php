<?php

    function conexion(){

        $user = "root";

        $password = "";

        $serve = "localhost";

        $db = "jordi";

        //$con = mysqli_connect($serve,$user,$password,$db);

        $con =new mysqli($serve,$user,$password,$db);

        if (!$con) {

            return "no se pudo establecer la conexion con la base de datos";

        }else{

            return $con;
        }
    }
?>
