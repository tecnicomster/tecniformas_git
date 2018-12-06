<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['fabricacion']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Procesos de Fabricacion</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped dt-responsive table-hover">
                          <thead> 
                             <th># Orden</th>
                            <th>Prioridad</th>
                            <th>Articulo</th>
                            <th>Linea</th>
                            <th>Peso</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                            <th>Fecha Entrega</th>
                            <th>Estado</th>
                            <th>Inicio / Fin</th>
                            <th>Almacen / Pausa</th>
                            <th>Entrega</th>
                          </thead>
                          <tbody>   
                          </tbody>
                          <tfoot> 
                            <th># Orden</th>
                            <th>Prioridad</th>
                            <th>Articulo</th>
                            <th>Linea</th>
                            <th>Peso</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                            <th>Fecha Entrega</th>
                            <th>Estado</th>
                            <th>Inicio / Fin</th>
                            <th>Almacen / Pausa</th>
                            <th>Entrega</th>
                          </tfoot>
                        </table>
                    </div>
                   
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>

<script type="text/javascript" src="scripts/fabricacion.js"></script>
<?php 
}
ob_end_flush();
?>