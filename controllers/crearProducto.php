<?php
    require_once('../models/conexion.php');

    require_once('../models/consultas.php');

    //RECOGEMOS EL USUARIO DE LA SESSION YA INICIADA
    session_start();

    if (isset($_SESSION["logueado"])) {
       $user = $_SESSION["logueado"];
    }

    if (isset($_FILES['foto1'])) {
        $foto1 = $_FILES['foto1']['name'];
    }
 
    if(isset($_FILES['foto2'])){
        $foto2 = $_FILES['foto2']['name'];
    }

    if(isset($_FILES['foto3'])){
        $foto3 = $_FILES['foto3']['name'];
    }

    if (isset($_POST['nombreProducto'])) {
        $nombre = $_POST['nombreProducto'];
    }
    if (isset($_POST['precio'])) {
        $precio = $_POST['precio'];
    }

    if (isset($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
    }

    if (isset($_POST['peso'])) {
        $peso = $_POST['peso'];
    }

    if (isset($_POST['dimension'])) {
        $dimension = $_POST['dimension'];
    }

    if (isset($_POST['marca'])) {
        $marca = $_POST['marca'];
    }

    if (isset($_POST['color'])) {
        $color = $_POST['color'];
    }

    if (isset($_POST['envase'])) {
        $envase = $_POST['envase'];
    }

    if (isset($_POST['categoria'])) {
        $categoria = $_POST['categoria'];
    }

    if (isset($_POST['estado'])) {
        $estado = $_POST['estado'];
    }

    $conn = conexion();

    if(insertarProducto($conn,$user,$foto1,$foto2,$foto3,$nombre,$precio,$descripcion,$peso,$dimension,$marca,$color,$envase,$categoria,$estado)){

        $directorio = "../uploads/";

        $fichero1 = $directorio.basename($_FILES['foto1']['name']);

        $fichero2 = $directorio.basename($_FILES['foto2']['name']);

        $fichero3 = $directorio.basename($_FILES['foto3']['name']);

        move_uploaded_file($_FILES['foto1']['tmp_name'],$fichero1);

        move_uploaded_file($_FILES['foto2']['tmp_name'],$fichero2);

        move_uploaded_file($_FILES['foto3']['tmp_name'],$fichero3);
        
        header('Location: https://jfiorilo123.000webhostapp.com/Tiendaphp/views/dashboard/principal.php');
    }else{

        header('Location: https://jfiorilo123.000webhostapp.com/Tiendaphp/views/404.php');

    }   
?>