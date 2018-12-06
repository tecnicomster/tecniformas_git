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
                          <h1 class="box-title">Ordenes de produccion 
                            <!--<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>-->
                              <a href="orden_produccion.php"><button class="btn btn-success" ><i class="fa fa-plus-circle"></i> Nuevo pedido</button></a>
                            </h1>
                        <div class="box-tools pull-right">
                        </div>
                            
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th># Orden</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Fecha de entrega</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Factura </th>
                            <th>Cotizacion</th>
                            <th>prioridad</th>
                            <th>Entrega</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th># Orden</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Fecha de entrega</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Factura </th>
                            <th>Cotizacion</th>
                            <th>prioridad</th>
                            <th>Entrega</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            <label>Cliente:</label>
                            <input type="hidden" name="idorden" id="idorden">
                             <select id="cliente" name="cliente" class="form-control selectpicker" data-live-search="true" ></select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha">
                          </div>
                         <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <label>Fecha de entrega:</label>
                          <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
                          </div>
                               <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <label>Prioridad:</label>
                        <select id="prioridad" name="prioridad" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                           <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <label>Entrega:</label>
                         <select id="entrega" name="entrega" class="form-control selectpicker" data-live-search="true" required>
                           <option value="Recoge">Se recoge</option>
                           <option value="Envie">Se envia</option>
                         </select>
                        </div>
                         <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <label>Total:</label>
                          <input type="text" class="form-control" name="total" id="total">
                          </div>
                         

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button id="guardar" class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                     <button class="btn btn-danger" onclick="cancelarform()"
                            type="button"><i class="fa fa-arrow-circle-left"></i>
                              Cancelar</button>
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
<script type="text/javascript" src="scripts/pedido.js"></script>
<?php 
}
ob_end_flush();
?>


