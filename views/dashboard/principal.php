<?php 
    
    //verificamos la variable de sesion creada al hacer login
    if (!isset($_SESSION["logueado"])) {
        
        print "<script>window.location = '../login.php';</script>";

    }else{

        $arrayProductos = selectMisProductos($conn,$_SESSION["logueado"]);
    }

    require_once('../../templates/header.php');

    require_once('../../models/conexion.php');

    require_once('../../models/consultas.php');

    $conn = conexion();
?>

<div class="content-dashboard d-flex">

    <?php require_once('../../templates/sidebarsecond.php');?>

    <div class="content-rigth p-5">
        <table class="table table-striped table-hover">
            <thead>
                <tr style='text-align: center;'>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estado</th>
                <th scope="col">Visitas</th>
                <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $contador = 1;

                foreach($arrayProductos as $elemento){

                    echo "<tr style='text-align: center;'>
                            <th scope='row' style='vertical-align: inherit;'>$contador</th>
                            <th scope='row' style='vertical-align: inherit;'>".$elemento['nombre']."</th>
                            <td style='vertical-align: inherit;'>".$elemento['precio']."</td>
                            <td style='vertical-align: inherit;'>".$elemento['categoria']."</td>
                            <td style='vertical-align: inherit;'>".$elemento['estado']."</td>
                            <td style='vertical-align: inherit;'>".$elemento['numero_visitas']."</td>
                            <td>
                                <img style='width: 250px;height: 150px;' src='".$elemento['imagen_front']."' class='img-thumbnail'  alt='...'>
                            </td>
                            </tr>";
                    $contador++;
                }
            ?>
            </tbody>
        </table>    
    </div>
</div>

<?php include_once('../../templates/footer.php');?>