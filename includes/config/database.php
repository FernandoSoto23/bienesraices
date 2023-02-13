<?php
    
    function ConectarDB() : mysqli{
        
        $db = new mysqli('localhost', 'root', 'fernando1234', 'bienesraices');
         if(!$db){
            echo 'Error no se pudo conectar';
            exit;
        } 
        return $db;
    }
