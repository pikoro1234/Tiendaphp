<?php 
    include_once('templates/header.php'); 

    include_once('models/conexion.php');

    include_once('models/consultasPublic.php');
?>

<div class="container">

  <h1 class="text-center mt-5 mb-3">My store</h1>

  <div class="post-header mb-4 d-flex justify-content-between ml-2 mr-2">
    <form  action="https://localhost/Proyectophp/index.php" method="POST" class="form-inline my-2 my-lg-0 mr-4">
      <select class="form-select mr-2" name="precio" aria-label="Default select example">
        <option value="trash">Ordenar por Precio</option>
        <option value="1">barato - caro</option>
        <option value="2">caro - barato</option>
      </select>
    
      <select class="form-select mr-2" name="fecha" aria-label="Default select example">
        <option value="trash">Ordenar por Fecha</option>
        <option value="descendente">nuevo - antiguo</option>
        <option value="ascendente">antiguo - nuevo</option>
      </select>

      <select class="form-select mr-2" name="categoria" aria-label="Default select example">
        <option value="trash">Filtrar Categorias</option>
        <option value="#1">Categoria #1</option>
        <option value="#2">Categoria #2</option>
        <option value="#3">Categoria #3</option>
        <option value="#4">Categoria #4</option>
        <option value="#5">Categoria #5</option>
      </select>

    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
    </form>

    <form action="https://localhost/Proyectophp/index.php" method="GET" class="form-inline my-2 my-lg-0 mr-4">
      <input name="producto" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" required>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
    
  <div class="content-productos d-flex mb-5">

    <?php
        $conn = conexion();

        $fecha = "";

        //validacion para filtrar por nombre
        if (isset($_GET['producto'])) {

          $producto = $_GET['producto'];

          echo substr($producto,0,1);

          $arrayProductos = selectFiltrados($conn,$producto);

        }else{

          $arrayProductos = selectProductos($conn,$fecha);
        }

        //validacion para filtrar por fecha
        if (isset($_POST['fecha'])) {
          
            $fecha = $_POST['fecha'];
            
            $arrayProductos = selectProductos($conn,$fecha);
        }

        foreach($arrayProductos as $prod){

          echo "
                <div class='card' style='width: 18rem;'>
                  <img src='".$prod['imagen_front']."' class='card-img-top' alt='...'>
                  <div class='card-body'>
                    <h5 class='card-title'>".$prod['nombre']."</h5>
                      <p class='card-text'>".$prod['descripcion']."</p>
                      <a href='https://localhost/Proyectophp/views/singlepage.php?param=".$prod['id']."' class='btn btn-primary'>Leer mas...</a>
                  </div>
                </div>";

        }
    ?>
      
  </div>
</div><!-- fin container -->

<?php include_once('./templates/footer.php');?>