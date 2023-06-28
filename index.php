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
                <form action="admin.php" method="POST">
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
        
    </div>
    
    
<?php
    require 'inc/footer.inc';
?>

