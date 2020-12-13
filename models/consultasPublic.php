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

        $valorNombre = "$nombre%";

        $sql = "SELECT * FROM producto WHERE nombre LIKE :nombre";

        $consulta = $con->pdo->prepare($sql);

        $consulta->bindParam(':nombre',$valorNombre,PDO::PARAM_STR);

        $consulta->execute();

        $datos = $consulta->fetchAll();

        var_dump($datos);

        foreach ($datos as $dato) {
            array_push($resultado,$dato);
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