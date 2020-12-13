<?php

    require_once('../models/conexion.php');

    require_once('../models/consultas.php');

    $conn = conexion();

    if (isset($_POST['userRegister'])) {
        $user = $_POST['userRegister'];
    }

    if (isset($_POST['passRegister'])) {
        $password = $_POST['passRegister'];
    }

    verificarUserRegistrado($conn,$user,$password);


?>