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
  $usu= $_SESSION['idusuario']
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="form-group col-lg-12 col-md-3 col-sm-3 col-xs-12">
                  <div class="box">
                    <div class="box-header with-border" id="cliente">
                          <h1 class="box-title">Orden de produccion </h1>
                          <div class="box-tools pull-right">
                          </div>
                      </div>
                    
                    <!-- /.box-header -->
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label>Cliente - Sede:</label>
                        <select id="idsucursal" name="idsucursal" class="form-control selectpicker" data-live-search="true" required></select><input type="hidden" class="form-control" name="iddetalle" id="iddetalle" required=""> 
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label>Articulo</label>
                        <select id="idnombre" name="idnombre" class="form-control selectpicker" data-live-search="true" ></select>
                        </div>
                     
                         <div class="form-group col-log-3 col-md-3 col-sm-6 col-xs-12">
                          <label>Prioridad:</label>
                          <select id="prioridad" name="prioridad" class="form-control selectpicker" data-live-search="true" required></select>
                          </div> 
                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <label>Fecha entrega:</label>
                        <input type="date" class="form-control" name="fechae" id="fechae" >
                        </div>

                        <div class="form-group col-lg-12 col-md-3 col-sm-3 col-xs-12">
                        <legend>Detalle del articula</legend> 
                        </div>

                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Peso:</label>
                        <input type="number" class="form-control" name="peso" id="peso" >
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Color:</label>
                        <input type="text" class="form-control" name="color1" id="color1">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Cantidad:</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Valor:</label>
                        <input type="number" class="form-control" name="valor" id="valor">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Observaciones:</label>
                        <input type="text" class="form-control" name="observacion" id="observacion">
                        </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-6">
                            <br>
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          </div>

                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed dt-responsive table-hover">
                          <thead>
                           
                            <th>Articulo</th>
                            <th>peso</th>
                            <th>color</th>
                            <th>cantidad</th>
                            <th>valor</th>
                            <th>observacion</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                           
                            <th>Articulo</th>
                            <th>peso</th>
                            <th>color</th>
                            <th>cantidad</th>
                            <th>valor</th>
                            <th>observacion</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                            <label>Iva:</label>
                            <input type="number" class="form-control" name="iva" id="iva" readonly="">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                            <label>Total:</label>
                            <input type="number" class="form-control" name="total" id="total" readonly="">
                          </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="botones"><button class="btn btn-primary" id="confirmar" onclick="adpedido()"><i class="fa fa-plus-circle"></i> Confirmar Pedido</button> <button class="btn btn-danger" onclick="borrarTodo()" type="button"><i class="fa fa-arrow-circle-left"></i> Borrar</button>
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
<script type="text/javascript" src="scripts/orden_produccion.js"></script>
<?php 
}
ob_end_flush();
?>


