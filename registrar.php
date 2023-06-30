<?php
    require 'inc/cabecera.inc';
?>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Portal Web</h3>
                
                
            </div>
        </div>
        
        <div class="col-md-12 caja col-centrar">
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
                        if(validarFoto($nombre)){
                            echo "<img class='img-responsive'
                            src='$rutaSubida' alt=''>";
                        } //El nombre de la foto lo convierte en minúscula
                        
                    }
                    
                    //Conexion a la base de datos
                    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

                    $db->preparar("SELECT nombre, apellido, email FROM usuarios");
                    $db->ejecutar();
                    $db->prep()->bind_result(/* $id, */ $nombre, $apellido, $email/* , $a, $b, $c, $d, $e, $f, $g, $h */);
                    echo "<table class ='table table-cell'>
                            <thead>
                                <tr>
                                    "/* <td>nombre</td>
                                    <td>apellido</td>
                                    <td>email</td> */,"
                                </tr>
                            </thead>
                        <tbody>";
                    while($db->resultado()){ //Imprime los datos con diferentes va
                        echo "<tr>
                                <td>$nombre</td>
                                <td>$apellido</td>
                                <td>$email</td>                         
                            </tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";

                    echo $db->validarDatos('apellido', 'usuarios', 'toribio');
                ?>

                <!-- <form action="" enctype="multipart/form-data" method="POST">
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
                    </div> -->


                    <!-- /////////////AGREGAR EMAIL Y CONTRASEÑA/////////////// -->
                    <!-- <div class="form-group">
                        <input name="email" type="text"
                        class="form-control" id=""
                        placeholder="Email">
                    </div>
                    
                    <div class="form-group">
                        <input name="contrasena" type="password"
                        class="form-control" id=""
                        placeholder="Contraseña">
                    </div> -->
                    <!-- //////////////////////////////// -->
                    
                    <!-- <div class="form-group">
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
                </form> -->
                
                
        </div>
        </div>
        
    </div>
    
    
<?php
    require 'inc/footer.inc';
?>

