<?php

    function verificarUserRegistrado($con,$user,$pass){

        //VARIABLES GLOBALES
        $contraOriginal = $pass;

        $userOriginal = $user;

        $auxPassword = "";

        //CONSULTA PARA TRAER Y VERIFICAR LA CONTRASEÑA
        $sql = "SELECT contrasenha FROM clientes WHERE nick_user = ? LIMIT 1";

        $valor1 = $user;

        $consulta = $con->prepare($sql);

        $consulta->bind_param("s",$valor1);

        $consulta->execute();

        $consulta->bind_result($pass);

        while ($consulta->fetch()) {

            $auxPassword = $pass;
        }

        //validacion usuario existe redireccion dashboard no existe login nuevamente
        if (password_verify($contraOriginal, $auxPassword)) {

            session_start();

            $_SESSION["logueado"] = $userOriginal;

            header("Location: https://localhost/Proyectophp/views/dashboard/principal.php");
            
        }else{
           
            header("Location: https://localhost/Proyectophp/views/login.php");
        }
    }

    function insertarCliente($con,$nick,$contrasenha,$nombre,$correo,$telefono,$direccion,$ciudad,$recuerdame,$foto){

        //CONSULTA PARA VERIFICAR SI EL USUARIO EXISTE EN LA TABLA
        $userSql = "SELECT nick_user FROM clientes WHERE nick_user = ?";

        $valorUser = $nick;

        $consultaUser = $con->prepare($userSql);

        $consultaUser->bind_param("s",$valorUser);

        $consultaUser->execute();

        $consultaUser->store_result();

        $filas = $consultaUser->num_rows;

        //VALIDAMOS SI EXISTE EL USUARIO EN LA BASE DE DATOS
        if ($filas > 0) {

            echo "<h1 style='text-align: center;margin-top: 100px;font-size: 50px;'>USUARIO YA ESTA SIENDO USADO<H1>";

        }else{
            //SI NO EXISTE EL USUARIO REALIZAMOS LA INSERCION
            $fecha = new DateTime();
    
            $valor1 = 0;
    
            $valor2 = $nick;
    
            $valor3 = $contrasenha;
    
            $valor4 = $nombre;
    
            $valor5 = $correo;
    
            $valor6 = $telefono;
    
            $valor7 = $direccion;
    
            $valor8 = $ciudad;
    
            $valor9 = $recuerdame;
    
            $valor10 = "on";
    
            $valor11 = $foto;
    
            $valor12 = $fecha->format('D-d-m-Y');
    
            $sql = "INSERT INTO `clientes`(`id`, `nick_user`, `contrasenha`, `nombre`, `correo`, `telefono`, `direccion`, `ciudad`, `recuerdame`, `estado`, `foto`, `alta`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
           
            $consultaPreparada = $con->prepare($sql);
    
            $consultaPreparada->bind_param("isssssssssss",$valor1,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11,$valor12);
    
            //REGISTRAMOS AL CLIENTE Y LUEGO LO REDIRECCIONAMOS AL INDEX
            if($consultaPreparada->execute()){
                
                header('Location: https://localhost/Proyectophp/index.php');
    
            }else{

                header('Location: http://localhost/Proyectophp/views/404.php');
                //echo "no se pudo insertar revisa los datos" . mysqli_error($con);
            }
        }
    }

    function selectSessionId($con,$user){

        $idUsuario = "--";

        $sql = "SELECT id FROM clientes WHERE nick_user = ? LIMIT 1";

        $valor = $user;

        $consulta = $con->prepare($sql);

        $consulta->bind_param("s",$valor);

        $consulta->execute();

        $consulta->bind_result($user);

        while($consulta->fetch()){

            $idUsuario = $user;
        }

        return $idUsuario;
    }

    function selectMisProductos($con,$usuario){

        $arrayMisProductos = array();

        $idUsuario = selectSessionId($con,$usuario);

        $sql = "SELECT producto.nombre, producto.precio, producto.categoria, producto.estado, producto.numero_visitas, producto.fecha, producto.imagen_front FROM producto JOIN clientes ON clientes.id = producto.id_cliente WHERE clientes.id = ?";

        $valorUsuario = $idUsuario;

        $consulta = $con->prepare($sql);

        $consulta->bind_param("i",$valorUsuario);

        $consulta->execute();

        $productosMios = $consulta->get_result();

        while ($row = $productosMios->fetch_assoc()) {

            array_push($arrayMisProductos,$row);
        }

        return $arrayMisProductos;
    }

    function insertarProducto($con,$user,$foto1,$foto2,$foto3,$nombre,$precio,$descripcion,$peso,$dimension,$marca,$color,$envase,$categoria,$estado){

        $fecha = new DateTime();

        //URL UPLOADS 
        $link = "https://localhost/Proyectophp/uploads/";

        //VARIABLE OBTIENE ID DEL USUARIO QUE ESTA EN LA SESSION
        $idUsuario = selectSessionId($con,$user);

        //llenamos los valores a insertar
        $valor1 = 0;

        $valor2 = $link.$foto1;

        $valor3 = $link.$foto2;

        $valor4 = $link.$foto3;

        $valor5 = $nombre;

        $valor6 = $precio;

        $valor7 = $descripcion;

        $valor8 = $peso;

        $valor9 = $dimension;

        $valor10 = $marca;

        $valor11 = $color;

        $valor12 = $envase;

        $valor13 = $categoria;

        $valor14 = $estado;

        $valor15 = $fecha->format('d-m-Y');

        $valor16 = 0;

        $valor17 = $idUsuario;

        $sql = "INSERT INTO `producto`(`id`, `imagen_front`, `imagen_back`,`imagen_left`, `nombre`, `precio`, `descripcion`, `peso`, `dimension`, `marca`, `color`, `envase`, `categoria`, `estado`, `fecha`,`numero_visitas`, `id_cliente`)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $consultaPreparada = $con->prepare($sql);

        $consultaPreparada->bind_param("issssdsdsssssssii",$valor1,$valor2,$valor3,$valor4,$valor5,$valor6,$valor7,$valor8,$valor9,$valor10,$valor11,$valor12,$valor13,$valor14,$valor15,$valor16,$valor17);

        if($consultaPreparada->execute()){

            return true;

        }else{

            return false;
        }
    }
?>