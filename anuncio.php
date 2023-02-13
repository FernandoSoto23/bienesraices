<?php
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: ./index.php");
    }
    require 'includes/app.php';
    $db = ConectarDB();

    $query = "SELECT * FROM propiedades where id = ${id}";
    $respuesta = mysqli_query($db,$query);
    if($respuesta->num_rows === 0){
        header("Location: ./index.php");
    }

    
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <?php while($propiedad = mysqli_fetch_assoc($respuesta)) : ?>
        <h1><?php echo $propiedad["titulo"] ?></h1>
        
        <img loading="lazy" src="./imagenes/<?php echo $propiedad["imagen"] ?>" alt="imagen de la propiedad">
        
        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad["precio"] ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                    <p><?php echo $propiedad["wc"] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                    <p><?php echo $propiedad["estacionamiento"]?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_habitaciones">
                    <p><?php echo $propiedad["habitaciones"]?></p>
                </li>
            </ul>
            <p><?php echo $propiedad["descripcion"] ?></p>

        </div>
        <?php endwhile; ?>
    </main>
<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>