<?php

    
    $db = ConectarDB();

    $query = "SELECT * FROM propiedades Limit ${limite}";
    $respuesta = mysqli_query($db,$query);

?>
        <div class="contenedor-anuncios">
            <?php while($res = mysqli_fetch_assoc($respuesta) ): ?>
            <div class="anuncio">
                <img loading="lazy" src="./imagenes/<?php echo $res["imagen"] ?>" alt="anuncio">
                <div class="contenido-anuncio">
                    <h3><?php echo $res["titulo"] ?></h3>
                    <p><?php echo $res["descripcion"]?></p>
                    <p class="precio"><?php echo $res["precio"] ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                            <p><?php echo $res["wc"] ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                            <p><?php echo $res["estacionamiento"] ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_habitaciones">
                            <p><?php echo $res["habitaciones"] ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php?id=<?php echo $res["id"] ?>" class="boton-amarillo-block">
                        ver propiedad
                    </a>
                </div> <!-- .contenido-anuncio -->
            </div> <!-- anuncio  -->
            <?php endwhile; ?>
        </div><!-- contenedor-anuncios-->

        <?php 
            mysqli_close($db);
        ?>