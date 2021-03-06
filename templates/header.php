<?php session_start();?>
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon para barra de herramientas -->
        <link rel="icon" type="image/png" href="https://jfiorilo123.000webhostapp.com/Tiendaphp/img/logophp.png"/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- style css -->
        <link rel="stylesheet" href="https://jfiorilo123.000webhostapp.com/Tiendaphp/css/style.css">

        <!-- redireccion a heroku -->
        <!-- <link rel="stylesheet" href="https://mystores1.herokuapp.com/css/style.css"> -->
        <!-- <link rel="stylesheet" href="../../css/dashboard.css"> -->
        <!-- <link rel="stylesheet" href="./css/style.css"> -->
        
        <title>My Store</title>

    </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <a class='navbar-brand' style='letter-spacing: 3px;' href='https://jfiorilo123.000webhostapp.com/Tiendaphp/index.php'>LOGO</a>

        <!-- navbar mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <div class="botones-register" style="margin-right: 30px;">
                    
                <?php
                    if (!isset($_SESSION['logueado'])) {

                        echo "<a href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/login.php' class='btn btn-outline-success ml-5 mr-2' style='font-size:14px;'>AREA PRIVADA</a>"; 
                        
                        echo "<a href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/registrate.php' class='btn btn-outline-success' style='font-size:14px;'>REGISTRATE</a>";

                    }else{
                        
                        echo "<a href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/dashboard/principal.php' class='btn btn-outline-success ml-5 mr-2' style='font-size:14px;'>AREA PRIVADA</a>";
                    }
                ?>
            </div>
            
            <div class="imagen-user d-flex">
            <?php 

                if (isset($_SESSION["logueado"])) {

                    echo "<a class='nav-link mt-1' href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/dashboard/principal.php'>".$_SESSION["logueado"]."</a>";

                    echo "<a href=''><img src='https://jfiorilo123.000webhostapp.com/Tiendaphp/img/logophp.png' width='50' height='50' alt='...' class='rounded-circle'></a>";

                }else{

                    echo "<a class='nav-link mt-1' href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/login.php'>No identificado</a>";
                }
                
                if (isset($_SESSION["logueado"])) {

                    echo "<a class='nav-link mt-1' href='https://jfiorilo123.000webhostapp.com/Tiendaphp/controllers/cerrarSesion.php'> cerrar sesion</a>";
                }
            ?>
            </div>
        </div>
    </nav>