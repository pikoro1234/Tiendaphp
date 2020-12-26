<?php 
    include_once('templates/header.php'); 

    include_once('models/conexion.php');

    include_once('models/consultasPublic.php');
?>

<div class="container">

  <h1 class="text-center mt-5 mb-3">My store</h1>

  <div class="post-header mb-4 d-flex justify-content-between ml-2 mr-2">
    <div class="content-forms">
      <form method="POST" action="https://jfiorilo123.000webhostapp.com/Tiendaphp/index.php" class="form-inline my-2 my-lg-0 mr-4 w-100" style="margin-bottom: 10px!important;">

        <select class="form-select mr-2" name="fecha" aria-label="Default select example">
          <option value="">Ordenar por Fecha</option>
          <option value="descendente">nuevo - antiguo</option>
          <option value="ascendente">antiguo - nuevo</option>
        </select>

        <select class="form-select mr-2" name="precio" aria-label="Default select example">
          <option value="">Ordenar por Precio</option>
          <option value="barato">barato - caro</option>
          <option value="caro">caro - barato</option>
        </select>

        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ordenar</button>

      </form>
 
      <form action="https://jfiorilo123.000webhostapp.com/Tiendaphp/index.php" method="GET" class="form-inline my-2 my-lg-0 mr-4 w-100" style="margin-top: 20px !important;">
        <input name="producto" class="form-control mr-sm-2 mb-2 mt-4" style="width: 96%;" type="search" placeholder="Buscar" aria-label="Search" required>

        <button class="btn btn-outline-success my-2 my-sm-0 mt-4" style="width: 96%;" type="submit">Buscar</button>
      </form>
    </div>
  
    <form action="https://jfiorilo123.000webhostapp.com/Tiendaphp/index.php" method="GET" class="form-inline my-2 my-lg-0 mr-4 w-50">

      <div class="elements-bottom w-100 d-flex">

        <select class="form-select mr-2 w-100" name="categoria" aria-label="Default select example">
          <option value="">Filtrar Categorias</option>
          <option value="1">Categoria #1</option>
          <option value="2">Categoria #2</option>
          <option value="3">Categoria #3</option>
          <option value="4">Categoria #4</option>
          <option value="5">Categoria #5</option>
        </select>
      </div>

      <div class="elements-top d-flex justify-content-center flex-wrap w-100">
        <div class="content-inputs d-flex flex-wrap w-100">
          <p class="text-center w-100 mb-0 mt-3">filtra por el precio</p>
          <div class="input-group mb-3 w-50">          
            <input type="number" name="desde" class="form-control ml-1 mr-1" placeholder="desde" aria-label="Username" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 w-50">
            <input type="number"  name="hasta" class="form-control ml-1 mr-1" placeholder="hasta" aria-label="Username" aria-describedby="basic-addon1">
          </div>
        </div>

        <button class="btn btn-outline-success my-2 my-sm-0 w-100" type="submit">Filtrar</button>
      </div>

    </form>
  </div>
    
  <div class="content-productos d-flex mb-5">

    <?php
        $conn = conexion();

        $arrayProductos = selectProductos($conn,"");

        //validacion para filtrar por nombre
        if (isset($_GET['producto'])) {

          if (!empty($_GET['producto'])) {

            $producto = $_GET['producto'];

            $arrayProductos = selectFiltradosNombre($conn,$producto);
          }
        }

        //validacion para filtrar por categoria
        if (isset($_GET['categoria'])) {

          if (!empty($_GET['categoria'])) {

            $categoria = $_GET['categoria'];
            
            $arrayProductos = selectFiltradosCategoria($conn,$categoria);
          }          
        }

        //validacion para filtrar por precio desde || hasta
        if ((isset($_GET['desde']) && (isset($_GET['hasta'])))) {

          if (!empty(($_GET['desde']) && ($_GET['hasta']))) {

            $desde = $_GET['desde'];

            $hasta = $_GET['hasta'];

            $arrayProductos = selectFiltradosBettween($conn,$desde,$hasta);
          }
        }

        //validacion ordenar por precio
        if (isset($_POST['precio'])) {

          if (!empty($_POST['precio'])) {

            $precio = $_POST['precio'];

            $arrayProductos = selectProductos($conn,$precio);
          }
        }

        //validacion para ordenar por fecha
        if (isset($_POST['fecha'])) {

          if (!empty($_POST['fecha'])) {
            
            $fecha = $_POST['fecha'];
            
            $arrayProductos = selectProductos($conn,$fecha);
          }                     
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

                if ($prod['estado'] === 'oferta') {
                  echo "<span class='pt-2 pb-2 pl-3 pr-3 badge bg-warning text-white' style='position: absolute;z-index: 115;top: -1px;right: -12px; font-size: 18px;'>".$prod['estado']."</span>";
                }

                if ($prod['estado'] === 'activo') {
                  echo "<span class='pt-2 pb-2 pl-3 pr-3 badge bg-primary text-white' style='position: absolute;z-index: 115;top: -1px;right: -12px; font-size: 18px;'>".$prod['estado']."</span>";
                }

                if ($prod['estado'] === 'stock') {
                  echo "<span class='pt-2 pb-2 pl-3 pr-3 badge bg-dark text-white' style='position: absolute;z-index: 115;top: -1px;right: -12px; font-size: 18px;'>".$prod['estado']."</span>";
                }

                if ($prod['estado'] === 'vendido') {

                  echo "<div class='spam-stock' style='position: relative;'>
                    <div class='text-stock' style='background-color: #fff; height: 100%; width: 100%;
                    text-align: center;position: absolute;z-index: 100;opacity: 0.5;font-size: 40px;font-weight: bold;padding-top: 60px;'>";

                  echo "<p class='card-text'>".$prod['estado']."</p>";

                }else{

                  echo "<div class='spam-stock' style='position: relative;'>
                    <div class='text-stock' height: 100%; width: 100%;
                    text-align: center;position: absolute;z-index: 100;opacity: 0.2;font-size: 40px;font-weight: bold;padding-top: 60px;'>";
                }

                    echo"</div>
                    <img style='height: 180px!important;' src='".$prod['imagen_front']."' class='card-img-top' alt='...'>
                  </div>
                  <div class='card-body'>
                    <h5 class='card-title'>".$prod['nombre']."</h5>
                      <p class='card-text'><strong>categoria: </strong>".$prod['categoria']."</p>
                      <p class='card-text'>".$prod['descripcion']."</p>
                      <div class='pree-footer mb-3' style='display:flex;'>
                        <h2 style='display: flex;justify-content: end;'> 
                          <span class=' text-white badge bg-secondary'>€ ".$prod['precio']."</span>
                        </h2>                        
                      </div>                      
                      <a href='https://jfiorilo123.000webhostapp.com/Tiendaphp/views/singlepage.php?param=".$prod['id']."' class='btn btn-primary'>Leer mas...</a>
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