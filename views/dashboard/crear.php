<?php 
    require_once('../../templates/header.php');

    //verificamos la variable de sesion creada al hacer login
    if (!isset($_SESSION["logueado"])) {

        header("Location: http://localhost/Tiendaphp/index.php");
    }
?>

<div class="content-dashboard d-flex">

    <?php require_once('../../templates/sidebarsecond.php');?>

    <div class="content-rigth p-5">
        
        <form action="http://localhost/Tiendaphp/controllers/crearProducto.php" method="POST" class="p-5 bg-white m-5" enctype="multipart/form-data">
            
            <h2 class="text-center mb-5">Crear Producto</h2>

            <div class="form-group">
                <label for="exampleFormControlFile1">Subir foto producto</label>
                <input type="file" class="form-control-file" name="foto1" id="foto1" required>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Subir foto producto</label>
                <input type="file" class="form-control-file" name="foto2" id="foto2">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Subir foto producto</label>
                <input type="file" class="form-control-file" name="foto3" id="foto3">
            </div>            

            <div class="form-group">
                <label for="exampleInputEmail1">Nombre producto</label>
                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">                
                <div class="input-group-prepend">                    
                    <span class="input-group-text">Precio €</span>
                    <span class="input-group-text">0.00</span>
                </div>               
                <input type="text" class="form-control" name="precio" id="precio" aria-label="Dollar amount (with dot and two decimal places)" required>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Descripción</label>
                <textarea class="form-control" placeholder="descripcion" name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
            </div>
            <div class="card p-4 mt-5 mb-5">
                <h5 class="text-center">Caracteristicas</h5>
                <div class="form-group">
                    <label for="exampleInputPassword1">Peso</label>
                    <input type="text" class="form-control" name="peso" id="peso" placeholder="0.00 Gr/Kg">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Dimensiones</label>
                    <input type="text" class="form-control" name="dimension" id="dimension" placeholder="00cm alto 00cm ancho">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Marca</label>
                    <input type="text" class="form-control" name="marca" id="marca" placeholder="marca blanca, etc.">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Color</label>
                    <input type="text" class="form-control" name="color" id="color" placeholder="rojo con blanco, etc.">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Envase</label>
                    <input type="text" class="form-control" name="envase" id="envase" placeholder="envase">
                </div>
            </div>
            




            <div class="form-group">
                <label for="exampleInputPassword1">Categoria</label>
                <div class="input-group mb-3">
                    <select class="custom-select" name="categoria" id="categoria">
                        <option value="trash">Selecciona categoria</option>
                        <option value="categoria #1">categoria #1</option>
                        <option value="categoria #2">categoria #2</option>
                        <option value="categoria #3">categoria #3</option>
                        <option value="categoria #4">categoria #4</option>
                        <option value="categoria #5">categoria #5</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Estado</label>
                <div class="input-group mb-3">
                    <select class="custom-select" name="estado" id="estado">
                        <option value="trash">Selecciona estado</option>
                        <option value="activo">activo</option>
                        <option value="reservado">reservado</option>
                        <option value="vendido">vendido</option>
                        <option value="stock">en stock</option>
                        <option value="stock">sin stock</option>
                        <option value="oferta">oferta</option>
                        <option value="descuento">descuento</option>
                    </select>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary mt-5">Submit</button>
            
        </form>
        
    </div>
</div>

<?php include_once('../../templates/footer.php');?>