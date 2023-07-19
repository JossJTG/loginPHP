<?php session_start();?>
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
        $validarEmail = $db->validarDatos('email', 'usuarios', $email);
        $expreg = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
        if(preg_match($expreg, $email)){
            if($validaremail == 0){
                $db->preparar("SELECT idUsuario, CONCAT(nombre, ' ', apellido) AS nombrecompleto, contrasena, email, imagen FROM usuarios WHERE email = '$email'");
                $db->ejecutar();
                $db->prep()->bind_result($id, $dbnombrecompleto, $dbcontrasena, $dbemail, $dbrutaimg);
                $db->resultado();
                if($email == $dbemail){
                    if($contrasena == $dbcontrasena){
                        $_SESSION['idUsuario'] = $id;
                        $_SESSION['nombre'] = $dbnombrecompleto;
                        $_SESSION['imagen'] = $dbrutaimg;
                        $ok = true;
                        $db -> cerrar();
                        header("Location: admin.php"); //Se redirecciona
                    }else{
                        trigger_error("La contraseña no coincide con la del correo, intente nuevamente, y seras redireccionado en 5 segundos.", E_USER_ERROR);
                        header("Refresh:5; url=index.php");
                    }
                }else{
                    trigger_error("Este email no existe, ingrese otro o registrate y seras redireccionado en 5 segundos.", E_USER_ERROR);
                    header("Refresh:5; url=index.php");
                }
            }else{
                trigger_error("Email erroneo, por favor ingresa un email valido y seras redireccionado en 5 segundos.", E_USER_ERROR);
                header("Refresh:5; url=index.php");
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
            </div>
        </div>
    </div>

    
    
<?php
    require 'inc/footer.inc';
?>

