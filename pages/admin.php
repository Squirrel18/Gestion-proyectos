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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaData.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaAdmin.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" onmouseover="btnAccount()" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <?php
            require_once '../php/adm.php';
            $obj1 = new genPag($obj->getPer());
            echo $obj1->relPagi();
        ?>
    </body>
</html>