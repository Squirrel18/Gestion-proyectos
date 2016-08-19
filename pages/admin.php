<?php
    require_once '../php/session.php';
    $obj = new sesion();

    if(!$obj->getSession()) {
        //echo "usuario desconocido";
        header('Location: ../');
    } else {
        $nombre = obtenNamePag($_SERVER['PHP_SELF']);
        #PASAR ESTAS DOS FUNCIONES A PRIVADAS
        echo $obj->getId();
        print_r($obj->getPer());
    }
?>