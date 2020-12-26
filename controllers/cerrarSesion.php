<?php

    //RETOMAMOS LA SESION PARA PODER CERRAR THIS SESSION Y REDIRECCIONAMOS
    session_start();

    if (isset($_SESSION["logueado"])) {

        session_destroy();
    }

    header("Location: https://jfiorilo123.000webhostapp.com/Tiendaphp/index.php");
?>