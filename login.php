<?php
    require 'includes/funciones.php';
    echo "hola";
    $auth = estaAutentificado();

    if($auth){
        header("Location: ./admin/index.php");
    }

    require 'includes/config/database.php';
    $db = ConectarDB();
    //autenticar el usuario
    $errores = [];
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
/*         echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
 */
        $email = mysqli_real_escape_string( $db ,filter_var( $_POST["email"] , FILTER_VALIDATE_EMAIL ) )  ;
        $pwd = mysqli_real_escape_string( $db , $_POST["pwd"] ) ;

        if(!$email){
            $errores[] = "email es obligatorio o no es valido";
        }
        if(!$pwd){
            $errores[] = "El password es obligatorio";
        }

/*         echo "<pre>";
        var_dump($errores);
        echo "</pre>"; */

        if(empty($errores)){
            $query = "SELECT * FROM usuario WHERE email = '${email}'";
            $resultado = mysqli_query($db,$query);


            if($resultado->num_rows){
                //revisar que el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //verificar si el password es correcto o no

                $auth = password_verify($pwd ,$usuario['pwd']);

                var_dump($auth);
                if($auth){
                    //el usuario esta autentificado
                    session_start();

                    $_SESSION['usuario'] = $usuario["email"];
                    $_SESSION["login"] = true;

                    header("Location: ./admin/index.php");
                }else{
                    $errores[] = "La Contraseña es incorrecta";
                }

            }else{
                $errores[] = "El usuario no existe";
            }
        }

    }

    //incluye el header
    
    incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
    <?php foreach($errores as $error) :?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="email">E-mail:</label>
                <input type="email" placeholder="Tu Email" id="email" name="email" required>

                <label for="pwd">Password:</label>
                <input type="password" placeholder="Tu Password" id="pwd" name="pwd" required>

                <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
                
            </fieldset>
    </form>
</main>
<?php
    incluirTemplate('footer');
?>