<?php

    function selectProductos($con,$variable){

        $resultado = array();

        if ($variable === 'descendente') {

            $sql = "SELECT * FROM producto ORDER by fecha DESC";

        }elseif($variable === 'ascendente'){

            $sql = "SELECT * FROM producto ORDER by fecha ASC";

        }else{

            $sql = "SELECT * FROM producto";
        }

        $consulta = $con->prepare($sql);

        $consulta->execute();

        $preCargaElementos = $consulta->get_result();

        while ($row = $preCargaElementos->fetch_assoc()) {

            array_push($resultado,$row);
        }

        return $resultado;
    }

    function selectFiltrados($con, $nombre){

        $resultado = array();

        $valorNombre = substr($nombre,0,1);

        $sql = "SELECT * FROM producto WHERE nombre LIKE CONCAT(?,'%')";

        $consulta = $con->prepare($sql);

        $consulta->bind_param("s",$valorNombre);

        $consulta->execute();

        $datos = $consulta->get_result();

        while ($row = $datos->fetch_assoc()) {

            array_push($resultado,$row);
        }

        return $resultado;
    }


    function selectSinglePageProducto($con, $id){
        
        $resultado = array();

        $valor = $id;

        $sql = "SELECT * FROM producto WHERE id = ?";

        $consulta = $con->prepare($sql);

        $consulta->bind_param("i",$valor);

        $consulta->execute();

        $getElementos = $consulta->get_result();

        while ($row = $getElementos->fetch_assoc()) {

            array_push($resultado,$row);
        }

        return $resultado;
    }
?>