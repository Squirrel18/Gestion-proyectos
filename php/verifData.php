<?php
    function verifDatos($dato) {
        if(isset($dato)) {
            $dato = trim($dato);
            $dato = stripslashes($dato);
            $dato = htmlspecialchars($dato);
            return $dato;
        } else {
            return false;
        }
    }
?>