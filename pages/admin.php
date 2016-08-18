<?php
    require_once '../php/session.php';
    $obj = new sesion();

    echo $obj->getSession();
    echo "<br>";
    $cont = array();
    $itera = 0;

    $cont = $obj->getPermi();
    for($i = 0; $i < count($cont); $i++) {
        echo $cont[$i]["idPermiso"]."<br>";
    }
    //$obj->setPermi($cont);
    //print_r($obj->getPermi());
?>