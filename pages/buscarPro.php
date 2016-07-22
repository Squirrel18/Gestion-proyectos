<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaFindP.js" type="text/javascript"></script>
    </head>
    <body>
        <input type="search" id="buscar" oninput="ejecutar()">
        <div id="contenedor"></div>
    </body>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .lista {
            width: 300px;
            height: 30px;
            text-align: left;
            top: 0;
            left: 0;
            margin: 15px 0;
            padding: 0;
            font-family: 'Roboto-Regular';
            font-size: 24px;
            color: #696969;
        }

        .lista:hover {
            background: rgba(20, 164, 217, 0.5);
        }

        .listCarp {
            text-decoration: none;
        }
    </style>
</html>