<?php 
    require_once('../templates/header.php');

    require_once('../models/conexion.php');

    require_once('../models/consultasPublic.php');

    $conn = conexion();

    if (isset($_GET['param'])) {

        $idUser = $_GET['param'];
    }

    $arraySingle = selectSinglePageProducto($conn,$idUser);

    if (strlen($arraySingle[0]['imagen_back']) == 35) {

        $arraySingle[0]['imagen_back'] .= "nofoto.png";
    }

    if (strlen($arraySingle[0]['imagen_left']) == 35) {

        $arraySingle[0]['imagen_left'] .= "nofoto.png";
    }


    /* if (isset($_COOKIE['prueba'])) {

        setcookie("prueba",$_COOKIE['prueba']+1,time()+60+60+60);
        
    }else{

        setcookie("prueba",1,time()+60+06+06);
    }*/

    $valor = $arraySingle[0]['numero_visitas']+1;

    contadorVisitas($conn,$idUser,$valor);
?>

<h1 class="text-center mt-2 mb-3"><?php echo $arraySingle[0]['nombre'];?></h1>
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1000">
            <img src="<?php echo $arraySingle[0]['imagen_front']?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
            <img src="<?php echo $arraySingle[0]['imagen_back']?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
            <img src="<?php echo $arraySingle[0]['imagen_left']?>" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

<div class="container">
    <h3 class="text-center my-3">Datos del Producto</h3>
    <div class="card w-100 mt-2 mb-5" style="box-shadow: 0 -6px 20px #00000059;">
        <div class="card-body">
            <h2 class="card-title text-center"><?php echo $arraySingle[0]['nombre']?></h2>
            <div class="datos-internos d-flex">
                <div class="content-left-card w-50 p-5">
                    <div class="cards-internos d-flex mb-3 justify-content-between">
                        <div class="cards-internos-left w-50">
                            <p class="card-text"><strong>categoria: </strong><?php echo $arraySingle[0]['categoria']?></p>
                            <p class="card-text"><strong>visitas: </strong><?php echo $valor?></p>
                        </div>
                        <div class="cards-internos-rigth w-50">
                            <p class="card-text"><strong>stock: </strong><?php echo $arraySingle[0]['estado']?></p>
                            <p class="card-text"><strong>fecha: </strong><?php echo $arraySingle[0]['fecha']?></p>
                        </div>
                    </div>
                    <h3 class="card-text text-center">descripcion</h3>
                    <p class="card-text"><?php echo $arraySingle[0]['descripcion']?></p>
                </div>
                <div class="content-rigth-card w-50 p-5">
                    <div class="contenedor-rigth d-flex justify-content-around">
                        <div class="contenedor-left-fond">
                            <p class="card-text"><strong>precio: </strong><?php echo $arraySingle[0]['precio']?></p>
                            <p class="card-text"><strong>peso: </strong><?php echo $arraySingle[0]['peso']?></p>
                            <p class="card-text"><strong>color: </strong><?php echo $arraySingle[0]['color']?></p>
                        </div>
                        <div class="contenedor-rigth-fond">
                            <p class="card-text"><strong>marca: </strong><?php echo $arraySingle[0]['marca']?></p>
                            <p class="card-text"><strong>envase: </strong><?php echo $arraySingle[0]['envase']?></p>
                            <p class="card-text"><strong>dimensiones: </strong><?php echo $arraySingle[0]['dimension']?></p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
    /*carrousel singlepage*/
    /*object-fit:cover*/
    html body #carouselExampleDark,
    html body #carouselExampleDark .carousel-inner,
    html body #carouselExampleDark .carousel-inner .carousel-item,
    html body #carouselExampleDark .carousel-inner .carousel-item img{
        height: 500px;
        box-shadow: 0 -6px 20px #00000059;
    }
</style>

<?php require_once('../templates/footer.php');?>