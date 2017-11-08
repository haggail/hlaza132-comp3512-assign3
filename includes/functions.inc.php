<?php

function getDatabaseData($sql) {
    
    try {
        $connString="mysql:dbname=book";
        $user="hlazaro"; $pass="";
        
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $result = $pdo->query($sql);
    
        return $result;

        $pdo=null;
    } 
    catch (Exception $e) {
        $return = false;
        return $result;
    }
    
    
}

?>