<?php 
session_start();
if(!$_SESSION['idUsuario'] && !$_SESSION['nombre']){
    header("Location: index.php");
    exit;
}
?>

<?php
    require 'inc/cabecera.inc';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 caja col-centrar">
<?php
if($_POST){
    require 'lib/errores.php';
    require 'lib/validarfoto.php';
    require 'lib/config.php';
    
    spl_autoload_register(function($clase){
        require_once "lib/$clase.php";
    });

    extract($_POST, EXTR_OVERWRITE);    
    $nombre = strtolower($nombre);

    /* */
    if($email && $contrasena){
        $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $validaremail = $db->validarDatos('email', 'usuarios', $email);
        $expreg = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
        if(preg_match($expreg, $email)){
            if($validarEmail == 0){
                $db->preparar("SELECT nombre, apellido, contrasena, email, imagen FROM usuarios WHERE email = '$email'");
                $db->ejecutar();
                $db->prep()->bind_result($dbnombre, $dbapellido, $dbcontrasena, $dbemail, $dbrutaimg);
                $db->resultado();
                if($email == $dbemail){
                    if($contrasena == $dbcontrasena){
                        $ok = true;
                        $db -> cerrar();
                    }else{
                        trigger_error("Esta contraseña no coincide con la del correo.", E_USER_ERROR);
                    }
                }else{
                    trigger_error("Este email no existe, ingrese otro o registrate.", E_USER_ERROR);
                }
            }else{
                trigger_error("Email erroneo, por favor ingresa un email valido", E_USER_ERROR);
            }
        }
    }
    
}
?>
            </div>
        </div>        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 caja text-center col-centrar">
                <h2>Hola, <?php echo ucwords($_SESSION['nombre']);?>
                <br>Bienvenidos a la administracion</h2>
                <img class="img-responsive img-thumbnail" src='<?php echo $_SESSION['imagen'];?>' alt="">
                <br>
                <br>
                <a class="btn btn-danger" href="logout.php">Cerrar Sesion</a>
            </div>
        </div>
    </div>

    
    
<?php
    require 'inc/footer.inc';
?>

