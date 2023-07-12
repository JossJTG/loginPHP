<?php
function validarFoto ($nombre){
    global $dirSubida;
    global $rutaSubida;
    global $error;
    
    $dirSubida = "fotos/$nombre/"; //La foto será subida a la carpeta 

    //Crea para subir la direccion de la foto
    /* if(!file_exists($dirSubida)){
        mkdir($dirSubida, 0777);
    }
 */
    $foto = $_FILES['foto']; //Extrae los datos del archivo foto
    //var_dump($foto);
    $nombreFoto = $foto['name']; //Almacena nombre de la foto
    $nombreTmp = $foto['tmp_name']; //Almacena nombre temporal
    $rutaSubida = "{$dirSubida}profile.jpg"; 
    $extArchivo = preg_replace('/image\//','',$foto['type']); //Verifica si el archivo es jpeg o png

    
    //Lo guardado arriba tiene que ser jpeg o png, para mover y actualizar el archivo

    if($extArchivo == 'jpeg' || $extArchivo == 'png'){ //verifica si la extensión del archivo es "jpeg" o "png"
        if(!file_exists($dirSubida)){ 
            mkdir("$dirSubida", 0777); 
        }
        
        //para mover el archivo cargado temporalmente a la ruta de destino
        if(move_uploaded_file($nombreTmp, $rutaSubida)){
            //echo "<img class='img-responsive' src='$rutaSubida' alt=''>";
            return true;
        }else{
            trigger_error("No se pudo mover el archivo, intente de nuevo", E_USER_ERROR);
            /* $error = "No se pudo mover el archivo"; */
        }
    }else{
        trigger_error("No es un archivo de imagen valido", E_USER_ERROR);
        /* $error =  "No es un archivo de imagen valido"; */
    }
    return $error;
}

?>