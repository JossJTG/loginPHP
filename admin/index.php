<?php
    /* require 'inc/cabecera.inc'; */
?>

<?php
$ok = false;
if($_POST){
    extract($_POST, EXTR_OVERWRITE);
    
    $nombre = strtolower($nombre);

    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $validarEmail = $db->validarDatos('email', 'usuarios', $email);
    $validarContrasena = $db->validarDatos('contrasena', 'usuarios', $contrasena);

    if(preg_match($expreg, $email)){
        if($validarEmail == 0){
            
        }
    }
}
?>
    
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Portal Web</h3>
                
                
            </div>
        </div>
        <div class="col-md-6 caja col-centrar">
                <form action="admin" method="POST">
                    <legend>Logueate</legend>
                    <div class="form-group">
                        <input type="text"
                        class="form-control" id=""
                        placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password"
                        class="form-control" id=""
                        placeholder="Su contraseña...">

                    </div>
                    <button type="submit" class="btn btn-success">Ingresar</button>
                    <a class=pull-right
                    href="registrar.php">Registrate</a>
                </form>
                
                
        </div>
        </div>
        
    </div> -->
    
    
<?php
    /* require 'inc/footer.inc'; */
?>

