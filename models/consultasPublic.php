<?php

    function selectProductos($con,$variable){

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        //$sql = "";

        $resultado = array();

        switch ($variable) {
            case 'descendente':
                $sql = "SELECT * FROM producto ORDER by fecha DESC";
                break;

            case 'ascendente':
                $sql = "SELECT * FROM producto ORDER by fecha ASC";
                break;

            case 'barato':
                $sql = "SELECT * FROM producto order by precio ASC";
                break;

            case 'caro':
                $sql = "SELECT * FROM producto order by precio DESC";
                break;
            
            default:
                $sql = "SELECT *FROM producto";
                break;
        }

        //echo $sql;

        $consulta = $con->prepare($sql);

        $consulta->execute();

        $preCargaElementos = $consulta->get_result();

        while ($row = $preCargaElementos->fetch_assoc()) {

            array_push($resultado,$row);
        }

        return $resultado;
    }

    function selectFiltradosNombre($con, $nombre){

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

    function selectFiltradosCategoria($con, $categoria){

        $resultado = array();
            
        $valorNombre = $categoria;

        $sql = "SELECT * FROM producto WHERE categoria = ?";

        $consulta = $con->prepare($sql);

        $consulta->bind_param("s",$valorNombre);

        $consulta->execute();

        $datos = $consulta->get_result();

        while ($row = $datos->fetch_assoc()) {

            array_push($resultado,$row);
        }

        return $resultado;
    }

    //SELECT * FROM `producto` WHERE precio BETWEEN 10 AND 40
    function selectFiltradosBettween($con,$primero,$segundo){

        $resultado = array();

        $desde = $primero;

        $hasta = $segundo;

        $sql = "SELECT * FROM producto WHERE precio BETWEEN ? AND ?";
        
        $consulta = $con->prepare($sql);

        $consulta->bind_param("ii",$desde,$hasta);

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


    function contadorVisitas($con,$parametro,$valor){

        $valorVisitas = $valor;

        $idProducto = $parametro;

        $sql = "UPDATE producto SET numero_visitas = ? WHERE id = ?";

        $consulta = mysqli_prepare($con,$sql);

        mysqli_stmt_bind_param($consulta,'ii',$valorVisitas,$idProducto);

        mysqli_stmt_execute($consulta);

    }

?>