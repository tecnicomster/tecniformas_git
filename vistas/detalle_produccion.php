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

if ($_SESSION['produccion']==1)
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
                          <h1 class="box-title">Producción</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped dt-responsive table-hover">
                          <thead> 
                            <th># Orden</th>
                            <th>Cliente</th>
                            <th>Articulo</th>
                            <th>Peso</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                            <th>Prioridad</th>
                            <th>Observacion</th>
                            <th>Linea</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>   
                          </tbody>
                          <tfoot> 
                            <th># Orden</th>
                            <th>Cliente</th>
                            <th>Articulo</th>
                            <th>Peso</th>
                            <th>Color</th>
                            <th>Cantidad</th>
                            <th>Prioridad</th>
                            <th>Observacion</th>
                            <th>Linea</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                           <label>Nombre</label> 
                           <input type="hidden" name="iddetalle" id="iddetalle">
                           <select type="text" class="form-control" name="idnombre" id="idnombre" required=""></select> 
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-2 col-xs-6">
                           <label>Peso:</label> 
                           <input type="text" class="form-control" name="peso" id="peso" required="" ">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-2 col-xs-6">
                           <label>Color:</label> 
                           <input type="text" class="form-control" name="color" id="color" required="">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-2 col-xs-63">
                           <label>Cantidad</label> 
                           <input type="text" class="form-control" name="cantidad" id="cantidad" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-63">
                            <label>Estado:</label>
                            <select id="estado" name="estado" class="form-control selectpicker" data-live-search="true" required=""></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Observacion</label> 
                           <input type="text" class="form-control" name="observacion" id="observacion">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" id="btnGuardar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div> 
                        

                      </form>
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

<script type="text/javascript" src="scripts/detalle_produccion.js"></script>
<?php 
}
ob_end_flush();
?>