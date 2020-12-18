<?php require_once("./controllerPaginacion.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Paginacion Modulada</title>
  </head>
  <body>
      <div class="container">
        <h1 class="text-center my-5">Paginación</h1>



        <?php 

            if (isset($_GET['id'])) {

                $paginaActual = $_GET['id'];

            }else{

                $paginaActual = 1;
            }

            $arrayPelis = extraerAllPeliculas($paginaActual);

            for ($i=0; $i < count($arrayPelis) ; $i++) { 
                echo $arrayPelis[$i]['ID']." ".$arrayPelis[$i]['TITULO']."<br>";
            }

            echo "la pagina actual es ".$paginaActual."<br>";

            echo " <nav aria-label='Page navigation example'><ul class='pagination'>";
             
            $arrayCount = calculoPaginas();

            for ($i=1; $i <= $paginaActual+3 ; $i++) { 

                /*if ($) {
                    # code...
                }*/

                if ($paginaActual == $i) {

                    echo "<li class='page-item active'><a class='page-link' href='paginacion.php?id=$i'>$i</a></li>";

                }else{

                    echo "<li class='page-item'><a class='page-link' href='paginacion.php?id=$i'>$i</a></li>";
                }
            }
            
            echo "</ul></nav>";
        
        ?>
            
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
   
  </body>
</html>
