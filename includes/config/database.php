<?php
    
    function ConectarDB() : mysqli{
        
        $db = mysqli_connect('localhost', 'root', 'fernando1234', 'bienesraices');
         if(!$db){
            echo 'Error no se pudo conectar';
            exit;
        } 
        return $db;
    }
