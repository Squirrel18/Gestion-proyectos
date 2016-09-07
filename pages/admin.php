<?php
    require_once '../php/session.php';
    $obj = new sesion();

    if(!$obj->getSession()) {
        //echo "usuario desconocido";
        header('Location: ../');
    } else {
        $nombre = obtenNamePag($_SERVER['PHP_SELF']);
        #PASAR ESTAS DOS FUNCIONES A PRIVADAS
        //echo $obj->getId();
        //print_r($obj->getPer());
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
        <script src="../js/menu.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <i class="material-icons md-48" id="menu" onclick="openMenu(this)">menu</i>
        <nav id="menuNav">
            <section id="headerMenu"></section>
            <section>
                <ul>
                    <li style="font-size: 24px;">Administrar usuarios</li>
                    <a href="nuevUsua.php">Crear usuario</a><br>
                    <a href="buscarUsua.php">Editar usuario</a>
                    <li style="font-size: 24px;">Administrar proyectos</li>
                    <a href="nuevProye.php">Nuevo proyecto</a><br>
                    <a href="buscarPro.php">Buscar proyecto</a>
                <ul>
            </section>
        </nav>
        <div id="contCard">
        <?php
            require_once '../php/adm.php';
            $obj1 = new genPag($obj->getPer());
            echo $obj1->relPagi();
        ?>
        </div>
    </body>
</html>