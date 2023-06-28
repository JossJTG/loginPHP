<?php
    require 'inc/cabecera.inc';
?>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Portal Web</h3>
                
                
            </div>
        </div>
        
        <div class="col-md-6 caja col-centrar">
                <?php
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
                ?>

                <form action="" enctype="multipart/form-data" method="POST">
                    <legend>Registrate</legend>

                    <div class="form-group">
                        <input name="usuario" type="text"
                        class="form-control" id=""
                        placeholder="Usuario">
                    </div>
                    
                    <div class="form-group">
                        <input name="contrasena" type="text"
                        class="form-control" id=""
                        placeholder="Contrasena">
                    </div>
                    
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
                
                
        </div>
        </div>
        
    </div>
    
    
<?php
    require 'inc/footer.inc';
?>

