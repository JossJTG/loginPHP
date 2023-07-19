<?php 
session_start();
session_unset();
session_destroy();
header("Refresh:5; url=index.php");
?>
<?php
    require 'inc/cabecera.inc';
?>  
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 caja text-center col-centrar">
            <h4>
                Has cerrado sesion y seras redireccionado en 5 segundos a la pagina de inicio
            </h4>
        </div>
    </div>
</div>
<?php
    require 'inc/footer.inc';
?>