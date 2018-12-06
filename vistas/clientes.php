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
                          <h1 class="box-title">Clientes <button id="btnagregar" class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar Cliente</button><a  href="sucursal.php"> <button id="btnSede" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Nueva Sede</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-responsive ttable-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Razon social</th>
                            <th>Identificacion</th>
                            <th>Sede</th>
                            <th>Contacto</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                            <th>Localidad</th>
                            <th>Barrio</th>
                            <th>Tipo</th>
                            <th>Uso</th>
                            <th>Mercado</th>
                            <th>Obs</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>    

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Razon social</th>
                            <th>Identificacion</th>
                            <th>Sede</th>
                            <th>Contacto</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                            <th>Localidad</th>
                            <th>Barrio</th>
                            <th>Tipo</th>
                            <th>Uso</th>
                            <th>Mercado</th>
                            <th>Obs</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Razon social(*)</label> 
                           <input type="hidden" name="idcliente" id="idcliente">
                           <input type="text" class="form-control" name="razon_social" id="razon_social" maxlength="150" placeholder="Nombre de la empresa o cliente" required="">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Identificacion</label> 
                           <input type="text" class="form-control" name="identificacion" id="identificacion" maxlength="20" placeholder="Nit o CC">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Tipo(*)</label>
                            <select class="form-control select-picker" name="tipo" id="tipo" required>
                              <option value="Nuevo">Nuevo</option>
                              <option value="Antiguo">Antiguo</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Uso(*)</label>
                            <select class="form-control select-picker" name="uso" id="uso" required>
                              <option value="Residencial">Residencial</option>
                              <option value="Comercial">Comercial</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Mercado(*)</label>
                            <select class="form-control select-picker" name="mercado" id="mercado" required>
                              <option value="Espontaneo">Espontaneo</option>
                              <option value="Google">Google</option>
                              <option value="Referido">Referido</option>
                              <option value="E-mailing">E-mailing</option>
                              <option value="Contactado tel">Contactado tel</option>
                            </select>
                          </div>
                          <div id="campos_detalle"><!--Inicio Detalle-->
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Nombre de la sede(*)</label> 
                           <input type="hidden" name="idsucursal" id="idsucursal">
                           <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre de la sede" required="">
                          </div id="campos_detalle"><!--Inicio detalle-->
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Contacto</label> 
                           <input type="text" class="form-control" name="contacto" id="contacto" maxlength="100" placeholder="Nombre de contacto">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Correo(*)</label> 
                           <input type="email" class="form-control" name="correo" id="correo" maxlength="150" placeholder="correo@dominio.com" required="">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Telefono</label> 
                           <input type="text" class="form-control" name="telefono" id="telefono" maxlength="15" placeholder="Numero">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Direccion(*)</label> 
                           <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="Direccion" required="">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Ciudad(*)</label>
                            <select id="idciudad" name="idciudad" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Localidad</label>
                            <select id="idlocalidad" name="idlocalidad" class="form-control selectpicker" data-live-search="true" ></select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                           <label>Barrio</label> 
                           <input type="text" class="form-control" name="barrio" id="barrio" maxlength="100" placeholder="barrio">
                          </div>
                        </div><!--Fin detalle-->
                          <div class="form-group col-lg-8 col-md-8 col-sm-6 col-xs-12">
                           <label>Observaciones</label> 
                           <input type="text" class="form-control" name="obs" id="obs" maxlength="100" placeholder="obs">
                          </div>                        
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" id="btnGuardar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <!--Modal-->
  <div class="modal fade" id="FormularioM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hedden="true">&times;</button>
          <h4 class="modal-title">Agregar una sede</h4>
        </div>
        <div class="modal-body">
          <form name="formularioM" id="formularioM" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Nombre de la sede(*)</label> 
                           <input type="hidden" name="idsucursal" id="idsucursal">
                           <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre de la sede" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cliente(*)</label>
                            <select id="idcliente1" name="idcliente1" class="form-control selectpicker" data-live-search="true" required=""></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Contacto</label> 
                           <input type="text" class="form-control" name="contacto" id="contacto" maxlength="100" placeholder="Nombre de contacto">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Correo(*)</label> 
                           <input type="email" class="form-control" name="correo" id="correo" maxlength="150" placeholder="correo@dominio.com" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Telefono</label> 
                           <input type="text" class="form-control" name="telefono" id="telefono" maxlength="15" placeholder="Numero">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Direccion(*)</label> 
                           <input type="text" class="form-control" name="direccion" id="direccion" maxlength="100" placeholder="Direccion" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad(*)</label>
                            <select id="ciudad" name="ciudad" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localidad</label>
                            <select id="localidad" name="localidad" class="form-control selectpicker" data-live-search="true" ></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label>Barrio</label> 
                           <input type="text" class="form-control" name="barrio" id="barrio" maxlength="100" placeholder="barrio">
                          </div>
        </div>
        <div class="modal-footer">
          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardarSuc">
                            <button class="btn btn-primary" type="submit" id="btnGuardarM"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
        </div>        
      </div>      
    </div>    
  </div>

  <!--Fin Modal-->
  
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>

<script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>