<?php
    require '../includes/funciones.php';
    $auth = estaAutentificado();

    if(!$auth){
        header("Location: /bienesraices/index.php");
    }
    //importar la conexion
    require '../includes/config/database.php';
    $db = ConectarDB();

    //Escribir el Query
    $query = "SELECT * FROM propiedades";

    $resultadoConsulta = mysqli_query($db,$query);


    //Consultar da DB


    //muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST["id"];
        $id = filter_var($id,FILTER_VALIDATE_INT);

        if($id){

            //eliminar archivoi
            $query = "SELECT imagen from propiedades where id = ${id}";
            $resultado = mysqli_query($db,$query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/'.'/'. $propiedad["imagen"]);
            //eliminar propiedad

            $query = "Delete from propiedades where id= ${id}";
            $resultado = mysqli_query($db,$query);
            if($resultado){
                header('Location: ../admin/index.php?resultado=3');
            }
        }
    }
    //incluye un template
    
    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if( intval( $resultado ) === 1): ?>
        <p class="alerta exito"> Anuncio Creado Correctamente</p>
    <?php elseif(intval( $resultado ) === 2): ?>
        <p class="alerta exito"> Anuncio Actualizado Correctamente</p>
    <?php elseif(intval( $resultado ) === 3): ?>
        <p class="alerta exito"> Anuncio Eliminado Correctamente</p>
    <?php endif; ?>
    <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--  Mostrar Los Resultados -->
            <?php while($res = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $res["id"] ?></td>
                <td><?php echo $res["titulo"] ?></td>
                <td><img src="../imagenes/<?php echo $res["imagen"] ?>" class="imagen-tabla"></td>
                <td>$  <?php echo $res["precio"] ?> </td>
                <td>
                    <form method="POST" class="w-100">

                        <input type="hidden" name="id" value="<?php echo $res["id"]?>">

                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="propiedades/actualizar.php?id=<?php echo $res["id"] ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
    mysqli_close($db);
    //Cerrar la conexion
    incluirTemplate('footer');
?>