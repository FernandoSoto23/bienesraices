<?php
    require '../../includes/funciones.php';
    $auth = estaAutentificado();
    if(!$auth){
       header("Location: /bienesraices/index.php");
    }
    //base de datos
    require '../../includes/config/database.php';
    $db = ConectarDB();
    //consultar para obtener los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //arreglo con mensajes de errores
    $errores = [];
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

/*         echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>"; */



        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string($db,$_POST['precio']);
        $descripcion = mysqli_real_escape_string($db,$_POST['descripcion'] ) ;
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']) ;
        $wc = mysqli_real_escape_string($db, $_POST['wc'] ) ;
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']) ;
        $vendedor = mysqli_real_escape_string($db, $_POST['vendedor']) ;
        $creado = date('Y/m/d');
        $imagen = $_FILES["imagen"];
        
        if(!$titulo)
            $errores[] = "debes añadir un titulo";
        
        if(!$precio)
            $errores[] = "El precio es Obligatorio";
        
        if(strlen($descripcion) <10 )
            $errores[] = "La descripcion es obligatoria y debe tener al menos 10 caracteres";
        
        if(!$habitaciones)
            $errores[] = "El numero de habitaciones es obligatorio";
        
        if(!$wc)
            $errores[] = "El numero de baños es obligatorio";
        
        if(!$estacionamiento)
            $errores[] = "El numero de estacionamiento es obligatorio";
        if(!$vendedor)
            $errores[] = "Seleccione un vendedor";
        if(!$imagen["name"] || $imagen["error"] )
            $errores[] = "La imagen es obligatoria";

        //validar por tamaño
        $medida = 1000 * 1000;

        if($imagen["size"] > $medida)
            $errores[] = "La imagen es muy pesada";
        
        
     /*        echo "<pre>";
            var_dump($errores);
            echo "</pre>"; */
        
        if(empty($errores)){

            //crear carpeta

            $carpetaImagenes = "../../imagenes";

            if(!is_dir($carpetaImagenes))
                mkdir($carpetaImagenes);

                //generar un nombre unico
                $nombreImagen = md5(uniqid(rand(),true)) . ".jpg" ;
                //Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes ."/". $nombreImagen);
            


            //insertar en la base de datos
            $query = "INSERT INTO propiedades(titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedor) 
            VALUES('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedor')";
            
            $resultado1 = mysqli_query($db,$query);

            if($resultado1){
                //redireccionando al usuario
                header('Location: /bienesraices/admin/index.php?resultado=1');
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