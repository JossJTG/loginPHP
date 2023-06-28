<?php
function validarFoto ($nombre){
    global $dirSubida;
    global $rutaSubida;
    
    $dirSubida = "fotos/$nombre/"; //La foto será subida a la carpeta 

    //Crea para subir la direccion de la foto
    if(!file_exists($dirSubida)){
        mkdir($dirSubida, 0777);
    }

    $foto = $_FILES['foto']; //Extrae los datos del archivo foto
    //var_dump($foto);
    $nombreFoto = $foto['name']; //Almacena nombre de la foto
    $nombreTmp = $foto['tmp_name']; //Almacena nombre temporal
    $rutaSubida = "{$dirSubida}profile.jpg"; 
    $extArchivo = preg_replace('/image\//','',$foto['type']); //Verifica si el archivo es jpeg o png

    //Lo guardado arriba tiene que ser jpeg o png, para mover y actualizar el archivo
    if($extArchivo == 'jpeg' || $extArchivo == 'png'){
        if(!file_exists($dirSubida)){
            mkdir("$dirSubida", 0777);
        }

        if(move_uploaded_file($nombreTmp, $rutaSubida)){
            //echo "<img class='img-responsive' src='$rutaSubida' alt=''>";
            return true;
        }else{
            return false;
        }
    }else{
        trigger_error("No es un archivo de imagen valido",
        E_USER_WARNING);
        exit;
    }
}

?>