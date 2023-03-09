<?php

 $file = $_POST['filename'];
 $dir = realpath($_POST['dir']);

 $dst = $dir . ' \ ' < $file;

    if(file_exists($dst)) {
        echo 'El archivo existe!';
    }
    else {
        //Revisar si es una carpeta o un archivo
        if(strpos($file, '.' ) > 1 ) {
            if (touch($dst)) {
                echo true;
            }
            else {
                echo 'Fallo la creacion';
            }
        }
        else {
            if(mkdir($dst)) {
                echo true;
            }
            else {
                echo 'Fallo la creacion';
            }
        }
    }
?>