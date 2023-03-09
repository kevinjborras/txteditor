<?php

    $dir = realpath($_POST['folder']);
    $files = scandir($dir);

    foreach($files as $file){
        if ($file === '.') {continue;}
        if ($file === '..'){
            echo '<div id="'.dirname($dir).'" onclick="openFolder(this.id)" class="file" style="background-image: url(resources/folder.svg);">Regresar..</div>';  
            continue;
        }
        $path = $dir . '/' . $file; 
        if (is_dir($path)) {
            echo '<div id="'.$path.'" onclick="openFolder(this.id)" class="file" style="background-image: url(resources/folder.svg);">'.$file.'</div>';  
        }
    }
       

    foreach($files as $file){
        if ($file === '.' || $file === '..') {continue;}

        else {
            $path = $dir . '/' . $file; 
            if (is_file($path)) {
                $ext = pathinfo($path) ['extension'];
                echo '<div id="'.$path.'" onclick="openFile(this.id)" class="file" style="background-image: url(resources/'.$ext.'.svg);">'.$file.'</div>';  
            }
        }
       
    }

    /*   
    <div class="file" style="background-image: url(resources/folder.svg);">Uno.text</div>
    <div class="file" style="background-image: url(resources/folder.svg);">Dos.text</div>
    <div class="file" style="background-image: url(resources/txt.svg);">Tres.text</div>
    <div class="file" style="background-image: url(resources/txt.svg);">Cuatro.text</div>
    <div class="file" style="background-image: url(resources/txt.svg);">Cinco.text</div>
     */
?>

