<?php 
    require_once('../templates/header.php');

    require_once('../models/conexion.php');

    require_once('../models/consultasPublic.php');

    $conn = conexion();

    if (isset($_GET['param'])) {

        $idUser = $_GET['param'];
    }

    $arraySingle = selectSinglePageProducto($conn,$idUser);

    if (strlen($arraySingle[0]['imagen_back']) == 38) {

        $arraySingle[0]['imagen_back'] .= "nofoto.png";
    }


    if (strlen($arraySingle[0]['imagen_left']) == 38) {

        $arraySingle[0]['imagen_left'] .= "nofoto.png";
    }
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
    <h3 class="text-center mt-3">Datos del Producto</h3>
</div>

<style>
    /*carrousel singlepage*/
    /*object-fit:cover*/
    html body #carouselExampleDark,
    html body #carouselExampleDark .carousel-inner,
    html body #carouselExampleDark .carousel-inner .carousel-item,
    html body #carouselExampleDark .carousel-inner .carousel-item img{
        height: 500px;
    }
</style>

<?php require_once('../templates/footer.php');?>