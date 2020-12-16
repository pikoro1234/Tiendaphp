<?php 
    include_once('templates/header.php'); 

    include_once('models/conexion.php');

    include_once('models/consultasPublic.php');
?>

<div class="container">

  <h1 class="text-center mt-5 mb-3">My store</h1>

  <label for="customRange2" class="form-label">Example range</label>
  <input type="range" class="form-range" min="0" max="5" id="customRange2">

  <div class="post-header mb-4 d-flex justify-content-between ml-2 mr-2">
    <form  action="http://localhost/Tiendaphp/index.php" method="POST" class="form-inline my-2 my-lg-0 mr-4">
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

    <form action="http://localhost/Tiendaphp/index.php" method="GET" class="form-inline my-2 my-lg-0 mr-4">
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

          $arrayProductos = selectFiltrados($conn,$producto);

        }else{

          $arrayProductos = selectProductos($conn,$fecha);
        }

        //validacion para filtrar por fecha
        if (isset($_POST['fecha'])) {
          
            $fecha = $_POST['fecha'];
            
            $arrayProductos = selectProductos($conn,$fecha);
        }

        if (isset($_POST['precio'])) {

            $precio = $_POST['precio'];
        }

        foreach($arrayProductos as $prod){

          echo "
                <div class='card' style='width: 18rem; position: relative;'>";
                if ($prod['estado'] === 'descuento') {
                  echo "<span class='pt-2 pb-2 pl-3 pr-3 badge bg-danger text-white' style='position: absolute;z-index: 115;top: -1px;right: -12px; font-size: 18px;'>".$prod['estado']."</span>";
                }

                if ($prod['estado'] === 'reservado') {
                  echo "<span class='pt-2 pb-2 pl-3 pr-3 badge bg-success text-white' style='position: absolute;z-index: 115;top: -1px;right: -12px; font-size: 18px;'>".$prod['estado']."</span>";
                }

                 echo "<div class='spam-stock' style='position: relative;'>
                    <div class='text-stock' style='background-color: #fff; height: 100%; width: 100%;
                    text-align: center;position: absolute;z-index: 100;opacity: 0.2;font-size: 40px;font-weight: bold;padding-top: 60px;'>
                      <p class='card-text'>".$prod['estado']."</p>
                    </div>
                    <img src='".$prod['imagen_front']."' class='card-img-top' alt='...'>
                  </div>
                  <div class='card-body'>
                    <h5 class='card-title'>".$prod['nombre']."</h5>
                      <p class='card-text'><strong>categoria: </strong>".$prod['categoria']."</p>
                      <p class='card-text'><strong>estado: </strong>".$prod['estado']."</p>
                      <p class='card-text'>".$prod['descripcion']."</p>
                      <div class='pree-footer mb-3' style='display:flex;justify-content: space-between;'>
                        <p class='card-text mb-0 mt-2 ml-4'>
                          <small class='text-muted' style='font-weight: bold;font-size: 15px;'>".$prod['fecha']."</small>
                        </p>
                        <h2 style='display: flex;justify-content: end;'> 
                          <span class=' text-white float-rigth badge bg-secondary'>€ ".$prod['precio']."</span>
                        </h2>                        
                      </div>                      
                      <a href='http://localhost/Tiendaphp/views/singlepage.php?param=".$prod['id']."' class='btn btn-primary'>Leer mas...</a>
                  </div>
                </div>";

        }

        if (count($arrayProductos) == 0) {
          echo "<div class='alert alert-secondary w-100 text-center' role='alert'>
          No se encontraron resultados para la busqueda '' <spam style='font-weight: bold;'>".strtoupper($_GET['producto'])."</spam> ''
        </div>";
        }
    ?>
      
  </div>
</div><!-- fin container -->

<?php include_once('./templates/footer.php');?>