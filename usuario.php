<?php 
    require 'includes/app.php';
    $db = ConectarDB();

    //crear email y pwd

    $email = "correo@correo.com";
    $pwd = "1234";

    $passwordHash = password_hash($pwd,PASSWORD_DEFAULT);
    
    //query para crear el usuario
    $query = "INSERT INTO usuario(email,pwd) values('${email}','${passwordHash}')";

    echo $query;

    
    mysqli_query($db,$query);
?>