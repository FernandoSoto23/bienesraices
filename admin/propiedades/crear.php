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
    <form class="formulario" method="POST" action="./crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>