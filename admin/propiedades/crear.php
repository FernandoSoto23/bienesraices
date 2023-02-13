<?php
    require '../../includes/app.php';
    use App\propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    
    //fnChecar($propiedad);
    estaAutentificado();

    //base de datos
    $db = ConectarDB();
    //consultar para obtener los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //arreglo con mensajes de errores
    $errores = propiedad::getErrores();

    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedor = "";
    $imagen = "";

    //ejecuta el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        /* Crea una nueva Instancia */
        $propiedad = new propiedad($_POST);
        //generar un nombre unico
        $nombreImagen = md5(uniqid(rand(),true)) . ".jpg" ;

        //Realiza un resize a la imagen con Intervention
        //Setear la imagen
        if($_FILES["imagen"]['tmp_name']){
            $image = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validar();
        //Validar
        
        if(empty($errores)){
            //crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            //Guarda en la base de datos
            $respuesta = $propiedad->Guardar();

            //mensaje de exito o error
            
            if($respuesta){
                //redireccionando al usuario
                header('Location: ./../index.php?resultado=1');
            }
        }
    }

    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form class="formulario" method="POST"  enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value="<?php echo $titulo ?>">
            <p></p>
            <label for="precio">Precio</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" min="1000" name="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen"">

            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9" name="wc" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">---Seleccione---</option>
                <?php foreach($resultado as $res):?>
                    <option <?php echo $vendedor === $res["id"] ? 'selected' : ''; ?> value="<?php echo $res["id"] ?>"><?php echo $res["nombre"] ." ". $res["apellido"] ?></option>
                <?php endforeach ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>