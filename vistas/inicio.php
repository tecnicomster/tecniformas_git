<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';


?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="panel-body table-responsive" id="listadoregistros">
                          <div class="jumbotron">
                         <h1 class="text-red">Bienvenido - <?php echo $_SESSION["nombre"];?></h1>
                <div class="row">
                    <div class="col-md-12">
                    <p>Bienvenido al panel de control </p>
                    </div>
                    <div>
                </div>
                  
                    <!--Fin centro -->
                
          </div><!-- /.row -->
          
      </section><!-- /.content -->

    </div>
        
    


                            
    </div>

    
<?php


require 'footer.php';
?>

<?php 
}
ob_end_flush();
?>