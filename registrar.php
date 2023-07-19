<?php
    require 'inc/cabecera.inc';
    require 'lib/errores.php';
    require 'lib/validarfoto.php';
?> 
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-centrar">
<!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Portal Web</h3>
                
                
            </div>
        </div>
        
        <div class="col-md-12 caja col-centrar"> -->
                <?php
                    //Para poder llamar a la db
                    require_once 'lib/config.php';
                    spl_autoload_register(function($clase){
                        require_once "lib/$clase.php";
                    });

                    if($_POST){
                        extract($_POST, EXTR_OVERWRITE);
                        
                        //Devuelve la cadena para extraer (Si existe la foto crea una carpeta "fotos")
                        if(!file_exists("fotos")){
                            mkdir("fotos", 0777);
                        }
                        $nombre = strtolower($nombre);

                        

                        if($nombre && $email && $contrasena && $confircontrasena){
                            $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            $expreg = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

                            if(preg_match($expreg, $email)){
                                if(strlen($contrasena)>6){
                                    if($contrasena == $confircontrasena){
                                        $validarEmail = $db->validarDatos('email', 'usuarios', $email);
                                        if($validarEmail == 0){
                                            if(validarFoto($nombre)){
                                                //echo "<img class='img-responsive' src='$rutaSubida' alt=''>";
                                                
                                                if($db->preparar("INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellido', '$email', '$contrasena', '$dni', '$celular', '$direccion', '$edad', '$ciudad', '$departamento', '$codigopostal', '$rutaSubida')"));
                                                $db->ejecutar();
                                                trigger_error("Te has registrado correctamente", E_USER_NOTICE);
                                                $ok = true;
                                                $db-> cerrar();
                                        }   else{
                                            echo $error;
                                        }
                                    }else{
                                        trigger_error("este email ya esta registrado, por favor pruebe otro.", E_USER_ERROR);

                                        /* echo 
                                        "<div class='alerta alerta_error'>
                                            <div class='alerta_icon'>
                                                <i class='glyphicon glyphicon-exclamation-sign'></i>
                                            </div>
                                            <div class='alerta_wrapper'> Error: este email ya esta registrado, por favor pruebe otro.
                                            </div> <a href='#' class='colse err'><i class='glyphicon remove'></i></a>
                                                </div>
                                        ";    */                                     
                                    }
                                }else{
                                    trigger_error("Error: Las contraseñas no coinciden", E_USER_ERROR);

                                    /* echo 
                                    "<div class='alerta alerta_error'>
                                        <div class='alerta_icon'>
                                            <i class='glyphicon glyphicon-exclamation-sign'></i>
                                        </div>
                                        <div class='alerta_wrapper'> Error: Las contraseñas no coinciden
                                        </div> <a href='#' class='colse err'><i class='glyphicon remove'></i></a>
                                            </div>
                                    ";  */                                       
                                }
                            }else{
                                trigger_error("La contraseña tiene que ser mayor a 6 caracteres", E_USER_ERROR);

                                /* echo 
                                "<div class='alerta alerta_error'>
                                    <div class='alerta_icon'>
                                        <i class='glyphicon glyphicon-exclamation-sign'></i>
                                    </div>
                                    <div class='alerta_wrapper'> Error: La contraseña tiene que ser mayor a 6 caracteres
                                    </div> <a href='#' class='colse err'><i class='glyphicon remove'></i></a>
                                        </div>
                                ";   */                                      
                            }
                        }else{
                            trigger_error("email erroneo, por favor ingresa un email valido.", E_USER_ERROR);

                            /* echo 
                            "<div class='alerta alerta_error'>
                                <div class='alerta_icon'>
                                    <i class='glyphicon glyphicon-exclamation-sign'></i>
                                </div>
                                <div class='alerta_wrapper'> Error: email erroneo, por favor ingresa un email valido.
                                </div> <a href='#' class='colse err'><i class='glyphicon remove'></i></a>
                                    </div>
                            "; */                                        
                        }                        
                    }else {
                        echo "depurando";
                    }
                }
                    
                    //Conexion a la base de datos
                    
                    /*$array = $db->getUsuarios();
                    
                    //------------Todo lo comentado es para probar
                    echo "<table class ='table table-cell'>
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>nombre</td>
                                    <td>apellido</td>
                                    <td>email</td>
                                    <td>contraseña</td>
                                    <td>dni</td>
                                    <td>celular</td>
                                    <td>direccion</td>
                                    <td>edad</td>
                                    <td>ciudad</td>
                                    <td>departamento</td>
                                    <td>codigo postal</td>
                                </tr>
                            </thead>
                            <tbody>
                    ";

                    //var_dump($array);
                    foreach($array as $v){
                        echo "<tr>";
                        foreach($v as $v2){ //para mostrar todos los datos 
                            echo "<td>$v2</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>"; */

                    //$db->preparar("SELECT nombre, apellido, email FROM usuarios");
                    //$db->ejecutar();
                    //$db->prep()->bind_result(/* $id, */ $nombre, $apellido, $email/* , $a, $b, $c, $d, $e, $f, $g, $h */);
                    //echo "<table class ='table table-cell'>
                      //      <thead>
                        //        <tr>
                          //          "/* <td>nombre</td>
                            //        <td>apellido</td>
                              //      <td>email</td> */,"
                                //</tr>
                            //</thead>
                       // <tbody>";
                    //while($db->resultado()){ //Imprime los datos con diferentes va
                      //  echo "<tr>
                        //        <td>$nombre</td>
                          //      <td>$apellido</td>
                            //    <td>$email</td>                         
                           // </tr>";
                    //}
                    //echo "</tbody>";
                    //echo "</table>";

                    //echo $db->validarDatos('apellido', 'usuarios', 'toribio');
                ?>
                
        </div>
    </div>
</div>

                <?php if($ok): ?>
                <h2>Saludos</h2><?php echo $nombre ?></h2>
                <img class="img-responsive" src="<?php echo $rutaSubida?>" alt="">
                <p>
                    Te has registrado perfectamente, por favor hacer click en el boton para ir a la pagina de inicio
                </p>
                <a class="btn btn-success" href="index.php">Inicio de Sesion</a>
                <?php else: ?>

                <form action="" enctype="multipart/form-data" method="POST">
                    <legend>Registrate</legend>
                    
                    <div class="form-group">
                        <input name="nombre" type="text"
                        class="form-control" id=""
                        placeholder="Nombre">
                    </div>
                    
                    <div class="form-group">
                        <input name="apellido" type="text"
                        class="form-control" id=""
                        placeholder="Apellido">
                    </div>


                    <!-- /////////////AGREGAR EMAIL Y CONTRASEÑA/////////////// -->
                    <div class="form-group">
                        <input name="email" type="text"
                        class="form-control" id=""
                        placeholder="Email">
                    </div>
                    
                    <div class="form-group">
                        <input name="contrasena" type="password"
                        class="form-control" id=""
                        placeholder="Contraseña">
                    </div>

                    <div class="form-group">
                        <input name="confircontrasena" type="password"
                        class="form-control" id=""
                        placeholder="Confirmar Contraseña">
                    </div>
                    <!-- //////////////////////////////// -->
                    
                    <div class="form-group">
                        <input name="dni" type="text"
                        class="form-control" id=""
                        placeholder="Dni">
                    </div>

                    <div class="form-group">
                        <input name="celular" type="text"
                        class="form-control" id=""
                        placeholder="Celular">
                    </div>
                    
                    <div class="form-group">
                        <input name="direccion" type="text"
                        class="form-control" id=""
                        placeholder="Direccion">
                    </div>
                    
                    <div class="form-group">
                        <input name="edad" type="text"
                        class="form-control" id=""
                        placeholder="Edad">
                    </div>
                    
                    <div class="form-group">
                        <input name="ciudad" type="text"
                        class="form-control" id=""
                        placeholder="Ciudad">
                    </div>
                    
                    <div class="form-group">
                        <input name="departamento" type="text"
                        class="form-control" id=""
                        placeholder="Departamento">
                    </div>
                    
                    <div class="form-group">
                        <input name="codigoPostal" type="text"
                        class="form-control" id=""
                        placeholder="Codigo Postal">
                    </div>

                    <div class="form-group">
                        <label for="">Elija su foto de perfil</label>
                        <input name="foto" type="file"
                        class="form-control" id="">
                    </div>

                    <button type="submit" class="btn btn-success">Registrar</button>
                    <a class=pull-right
                    href="index.php">Click aqui si ya tienes una cuenta</a>
                </form>
            <?php endif; ?>
                
        </div>
        </div>
        
    </div>
    
    
<?php
    require 'inc/footer.inc';
?>

