<?php

    require_once('../models/conexion.php');

    require_once('../models/consultas.php');

    if (isset($_POST['user'])) {
        $user = $_POST['user'];
    }

    if (isset($_POST['password'])) {
        //encriptado contraseña
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }

    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['telefono'])) {
        $telefono = $_POST['telefono'];
    }

    if (isset($_POST['direccion'])) {
        $direccion = $_POST['direccion'];
    }

    if (isset($_POST['ciudad'])) {
        $ciudad = $_POST['ciudad'];
    }

    if (!isset($_POST['fotoperfil'])) {
        $foto = "sin foto";
    }else{
        $foto = $_POST['fotoperfil'];
    }

    if (!isset($_POST['check'])) {
        $check = "of";
    }else{
        $check = $_POST['check'];
    }

    $conn = conexion();

    insertarCliente($conn,$user,$password,$nombre,$email,$telefono,$direccion,$ciudad,$check,$foto);

    mysqli_close($conn); 
?>