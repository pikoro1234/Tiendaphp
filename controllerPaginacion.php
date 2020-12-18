<?php
    require_once("models/conexion.php");

    $conn = conexion();

    define("PELIS_PAGINA",10);

    function countPeliculas(){

        global $conn;

        $sql = "SELECT count(*) as totales FROM PELICULA";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $consulta = $stmt->get_result();

        $resultado = $consulta->fetch_assoc();

        $totales = $resultado['totales'];

        return $totales; 

    }

    function calculoPaginas(){

        $totalPeliculas = countPeliculas();

        $calTotalPaginas = ceil($totalPeliculas/PELIS_PAGINA);

        return $calTotalPaginas;
    }

    function extraerAllPeliculas($paginaActual){

        global $conn;

        $valor = ($paginaActual-1) * PELIS_PAGINA;

        $arrayPelis = array();

        $sql = "SELECT * FROM PELICULA LIMIT $valor,".PELIS_PAGINA;

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $elementos = $stmt->get_result();

        while ($row = $elementos->fetch_assoc()) {

            array_push($arrayPelis,$row);
        }

        return $arrayPelis;
        
    }
?>