<?php
    $dato = $_POST["datoBus"];
    $d = dir("../proyectos");
    //echo "Handle: " . $d->handle . "<br>";
    //echo "Path: " . $d->path . "<br>";
    while (false !== ($entry = $d->read())) {
        if($entry != "." && $entry != "..") {
            if(!is_file($d->path."/".$entry)) {
                echo "<a class='listCarp' href='".$d->path."/".$entry."'><p class='lista'>".$entry."</p></a><br>";
                //echo $d->path."/".$entry;
            } else {

            }
        }
    }
    $d->close();
?>