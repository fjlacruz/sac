<?php
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<style>
   .modal-header{
   background-color:#3d9970 !important;
   }
   .modal-title{
   color:#ffffff;
   }
   #mdialTamanio{
   width: 60% !important;
   }
</style>
<html>
   <body onload="nobackbutton();">
      
      <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
      <section class="content"   style="width: 95%; align-content: center">
         <div class="box box-success collapsed-box" id="section">
            <div class="box-header with-border">
               <span tooltip="Regresar">
      <a href="<?php echo base_url() ?>principal/bienvenida" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
      </span>
               
               <h3 class="box-title">Registrar Nuevo Cheque</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
               </div>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                     <form id="formulario" action="" name="formulario" >
                        <div class="form-group col-sm-4">
                           <label>Nro de Cheque</label> 
                           <input type="text" autocomplete="off" class="form-control redondeado" id="nro_cheque"  name="nro_cheque" placeholder="Indique el Nombre Nro de Cheque" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="form-group col-sm-2">
                           <label>&Uacute;ltimos dos Digitos</label> 
                           <input type="text" autocomplete="off" onblur="return validar();" class="form-control redondeado" id="dos_digitos"  name="dos_digitos" placeholder="Ultimos Digitos" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="form-group col-sm-4">
                           <label>Nro de Talonario</label> 
                           <input type="text"  class="form-control redondeado" id="talonario"  name="talonario" placeholder="Indique el Nombre Nro de Talonario" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="form-group col-sm-2">
                           <label>Cantidad a Generar</label> 
                           <input type="text"  class="form-control redondeado" id="cantidad"  name="cantidad" placeholder="Cantidad a Generar" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="form-group col-sm-6">
                           <span tooltip="Regresar">
                           <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
                           </span>
                           <span tooltip="Guardar">
                           <button type="" id="guardar" class="btn bg-olive btn-circle"><span class='glyphicon glyphicon-pencil'></span></button>
                           </span>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
      
      
      
      <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
      <div class="box-header with-border">
         <span tooltip="Regresar">
      <a href="<?php echo base_url() ?>principal/bienvenida" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
      </span>
         <h3 class="box-title">Administraci&oacute;n de Cheques</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div class="box-body">
      <div class="row">
      <div class="col-md-12">
      <div class='filterable'>
         <div class='panel-heading'>
            <div class='pull-right'>
               <span tooltip="Filtrar">
               <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
               </span>
            </div>
         </div>
         <?php if ($variablesSesion['rol'] == 1) { ?>
         <table id="nueva" class="table" >
            <thead>
               <tr class="filters">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>id_cheque </th>
                  <th onkeypress="return soloNumeros(event)">Comunidad</th>
                  <th onkeypress="return soloNumeros(event)">Nro de Cheque</th>
                  <th onkeypress="return soloNumeros(event)">Nro de Talonario</th>
                  <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                  <th onkeypress="return soloLetras(event)">Estatus</th>
                  <th onkeypress="return soloLetras(event)">Editar</th>
               </tr>
            </thead>
            <?php
               if ($resultados != "") {
               $contenido = "";
               foreach ($resultados as $resultado) {
               
               $contenido.="<tr>      
               
                 <td style='display:none'>" . "$resultado->id_cheque" . "</td>
                  <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                  <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                  <td align='center'>" .  "$resultado->talonario" . "</td>
                  <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                  <td align='center'>" .  "$resultado->estatus" . "</td>
                  <td align='center'><button type='button' title='Editar Cheque' data-id='$resultado->id_cheque' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                </td> 
                 </tr>";
                  }
               } else {
                 $contenido = '
               
                        </div>
                              <div class="alert alert-danger">
                              <strong>No se Encontraron datos para esta busquedad!</strong>
                              <a class="alert-link" href="#">Volver a consultar.</a>
               
                       </div>';
                     }
                  ?>
            <tbody>                  
               <?php
                  echo $contenido;
                  ?>
            </tbody>
         </table>
         <?php } ?>
         
          <?php if ($variablesSesion['rol'] == 2) { ?>
         <table id="nueva" class="table" >
            <thead>
               <tr class="filters">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>id_cheque </th>
                  <th onkeypress="return soloNumeros(event)">Nro de Cheque</th>
                  <th onkeypress="return soloNumeros(event)">Nro de Talonario</th>
                  <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                  <th onkeypress="return soloLetras(event)">Estatus</th>
                  <th onkeypress="return soloLetras(event)">Editar</th>
               </tr>
            </thead>
            <?php
               if ($resultados != "") {
               $contenido = "";
               foreach ($resultados as $resultado) {
               
               $contenido.="<tr>      
               
                 <td style='display:none'>" . "$resultado->id_cheque" . "</td>
                  <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                  <td align='center'>" .  "$resultado->talonario" . "</td>
                  <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                  <td align='center'>" .  "$resultado->estatus" . "</td>
                  <td align='center'><button type='button' title='Editar Cheque' data-id='$resultado->id_cheque' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                </td> 
                 </tr>";
                  }
               } else {
                 $contenido = '
               
                        </div>
                              <div class="alert alert-danger">
                              <strong>No se Encontraron datos para esta busquedad!</strong>
                              <a class="alert-link" href="#">Volver a consultar.</a>
               
                       </div>';
                     }
                  ?>
            <tbody>                  
               <?php
                  echo $contenido;
                  ?>
            </tbody>
         </table>
         <?php } ?>
         
          <?php if ($variablesSesion['rol'] == 3) { ?>
         <table id="nueva" class="table" >
            <thead>
               <tr class="filters">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>id_cheque </th>
                  <th onkeypress="return soloNumeros(event)">Nro de Cheque</th>
                  <th onkeypress="return soloNumeros(event)">Nro de Talonario</th>
                  <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                  <th onkeypress="return soloLetras(event)">Estatus</th>
                  
               </tr>
            </thead>
            <?php
               if ($resultados != "") {
               $contenido = "";
               foreach ($resultados as $resultado) {
               
               $contenido.="<tr>      
               
                 <td style='display:none'>" . "$resultado->id_cheque" . "</td>
                  <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                  <td align='center'>" .  "$resultado->talonario" . "</td>
                  <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                  <td align='center'>" .  "$resultado->estatus" . "</td>
                  
                </td> 
                 </tr>";
                  }
               } else {
                 $contenido = '
               
                        </div>
                              <div class="alert alert-danger">
                              <strong>No se Encontraron datos para esta busquedad!</strong>
                              <a class="alert-link" href="#">Volver a consultar.</a>
               
                       </div>';
                     }
                  ?>
            <tbody>                  
               <?php
                  echo $contenido;
                  ?>
            </tbody>
         </table>
         <?php } ?>
         
         
         
      </div>
      <div class="col-sm-12">&nbsp;</div>
      
      <form id="userForm" method="post" class="form-horizontal" style="display: none;">
         <div class="col-sm-12"  id='resultado'></div>
         <div class="col-sm-12"  id='resultado2'></div>
         <div class="form-group col-sm-12">
            <label>Nro de Cheque</label> 
            <input type="text"  class="form-control" id="nro_cheque" onKeyPress="return soloNumeros(event)" name="nro_cheque" placeholder="Nro de Cheque">
         </div>
         <div class="form-group col-sm-12">
            <label>Talonario</label> 
            <input type="text"  class="form-control" id="talonario" onKeyPress="return soloNumeros(event)" name="talonario" placeholder="Nro de Cheque">
         </div>
         <div class="col-sm-12"></div>
         <div class="form-group col-sm-12">
            <label>Fecha Registro</label> 
            <input type="text" readonly="readonly" class="form-control" id="fecha_registro" onKeyPress="return soloLetras(event)" name="fecha_registro" placeholder="Motivo" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="form-group col-sm-12">
            <label>Estatus</label>
            <select name="estatus" id="estatus"  class="form-control">
               <option value="">Selecione...</option>
               <option value="1">ACTIVO</option>
               <option value="2">DESACTIVADO</option>
            </select>
         </div>
         <div class="col-sm-12">&nbsp;</div>
         <input type="hidden"  class="form-control" id="id"  name="id" >
         <div class="form-group">
            <div class="col-xs-12">
               <span tooltip="Guardar">
               <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
            </div>
         </div>
      </form>
      <input type="hidden" id="F" value="<?php echo base_url() ?>egresos/buscarDatosCheque">
   </body>
</html>
<script>
   $(document).ready(function() {
       $("#dos_digitos").keyup(function()
       {
           if ($("#dos_digitos").val() != '' && $("#dos_digitos").val().length > 2)
           {
               $("#dos_digitos").val('');
           }
       });
   });
    $(document).ready(function() {
       $("#cantidad").keyup(function()
       {
           if ($("#cantidad").val() != '' && $("#cantidad").val().length > 2)
           {
               $("#cantidad").val('');
           }
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#userForm')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       nro_cheque: {
                           row: '.col-sm-12',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                        talonario: {
                           row: '.col-sm-12',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          }
                   }
               })
               .on('success.form.fv', function (e) {
                   // Save the form data via an Ajax request
                   e.preventDefault();
                   var $form = $(e.target),
                           id = $form.find('[name="id"]').val();
                   // The url and method might be different in your application
   
                   $.ajax({
                       url: "<?php echo base_url() . 'index.php/egresos/actualizar_cheque'; ?>",
                       method: 'POST',
                       data: $form.serialize()
                   }).success(function (response) {
   
                       alertify.log("Datos Actualizados...!!!"); 
                   setInterval(function() {
                           location.reload();
                       }, 3000);
   
                       $form.parents('.bootbox').modal('hide');
   
                   });
               });
       $('.editButton').on('click', function () {
           // Get the record's ID via attribute
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'index.php/egresos/consultarChequeId/'; ?>" + id,
               method: 'GET'
   
           }).success(function (data) {
               // Populate the form fields with the data returned from server
   
               var obj = JSON.parse(data);
               $('#userForm')
                       .find('[name="id"]').val(obj.id_cheque).end()
                       .find('[name="nro_cheque"]').val(obj.nro_cheque).end()
                       .find('[name="talonario"]').val(obj.talonario).end()
                       .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                       .find('[name="estatus"]').val(obj.estatus).end();
               // Show the dialog
               bootbox
                       .dialog({
                           title: 'Editar Cheque',
                           message: $('#userForm'),
                           show: false // We will show it manually later
                       })
                       .on('shown.bs.modal', function () {
                           $('#userForm')
                                   .show()                             // Show the login form
                                   .formValidation('resetForm'); // Reset form
                       })
                       .on('hide.bs.modal', function (e) {
                           // Bootbox will remove the modal (including the body which contains the login form)
                           // after hiding the modal
                           // Therefor, we need to backup the form
                           $('#userForm').hide().appendTo('body');
                       })
                       .modal('show');
           });
       });
   });
   $(document).ready(function () {
   
       $('#nueva thead th').each(function () {
           var title = $(this).text();
           $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
       }
       );
       // DataTable
       var table = $('#nueva').DataTable({
           "scrollY": "500px",
           "scrollCollapse": true,
           "paging": true,
           retrieve: true
       });
       //Apply the search
       table.columns().every(function () {
           var that = this;
           $('input', this.header()).on('keyup change', function () {
               if (that.search() !== this.value) {
                   that
                           .search(this.value)
                           .draw();
               }
           });
       });
   });
   //------------------------------------------------- Solo Letra-------------------------------------------------//
   
   function soloLetras(e) {
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " qwertyuiop�lkjhgfdsazxcvbnm";
       especiales = "8-37-39-46";
       tecla_especial = false
       for (var i in especiales) {
           if (key == especiales[i]) {
               tecla_especial = true;
               break;
           }
       }
   
       if (letras.indexOf(tecla) == -1 && !tecla_especial) {
           return false;
       }
   }
   
   function soloNumeros(e)
   {
       var key = window.Event ? e.which : e.keyCode
       return ((key >= 48 && key <= 57) || (key == 8))
   }
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   $(document).ready(function () {
       $('.filterable .btn-filter').click(function () {
           var $panel = $(this).parents('.filterable'),
                   $filters = $panel.find('.filters input'),
                   $tbody = $panel.find('.table tbody');
           if ($filters.prop('disabled') == true) {
               $filters.prop('disabled', false);
               $filters.first().focus();
           } else {
               $filters.val('').prop('disabled', true);
               $tbody.find('.no-result').remove();
               $tbody.find('tr').show();
           }
       });
       $('.filterable .filters input').keyup(function (e) {
           /* Ignore tab key */
           var code = e.keyCode || e.which;
           if (code == '9')
               return;
           /* Useful DOM data and selectors */
           var $input = $(this),
                   inputContent = $input.val().toLowerCase(),
                   $panel = $input.parents('.filterable'),
                   column = $panel.find('.filters th').index($input.parents('th')),
                   $table = $panel.find('.table'),
                   $rows = $table.find('tbody tr');
           /* Dirtiest filter function ever ;) */
           var $filteredRows = $rows.filter(function () {
               var value = $(this).find('td').eq(column).text().toLowerCase();
               return value.indexOf(inputContent) === -1;
           });
           /* Clean previous no-result if exist */
           $table.find('tbody .no-result').remove();
           /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
           $rows.show();
           $filteredRows.hide();
           /* Prepend no-result row if all rows are filtered */
           if ($filteredRows.length === $rows.length) {
               $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
           }
       });
   });
</script>
<!--============= script para registar usuarios ============================================== -->
<script>
   $(document).ready(function () {
       $('#formulario').formValidation({
           framework: 'bootstrap',
           fields: {
               nro_cheque: {
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               
               dos_digitos: {
                    row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       },
                       stringLength: {
                           min: 2,
                           max: 2,
                           message: 'M&iacute;nimo 2 m&aacute;ximo 2 d&iacute;gitos'
                       }
   
                   }
               },
               talonario: {
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               cantidad: {
                   row: '.col-sm-2',
                   validators: {
                       between: {
                           min: 1,
                           max: 80,
                           message: 'M&iacute;nimo 1 y m&aacute;ximo 80'
                       },
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
           }
       });
   });
</script>
<script>
   $(document).on("keyup", '#nro_cheque', function ()
   {
       $.ajax({
           url: "<?php echo base_url() . 'index.php/egresos/consultar_existe_cheque'; ?>",
           data: {nro_cheque: $('#nro_cheque').val()},
           dataType: 'html',
           type: 'post',
           success: function (respuesta) {
   
               if (respuesta == 1)
               {
                   $('#nro_cheque').val('');
                   alertify.error( "El Nro de cheque ya se encuentra Registrado...!!!");
             
               }
           }
       });
   });
</script>
<script>
   $(document).on("keyup", '#dos_digitos', function ()
   {
       
   });
</script>
<script>
   $(document).ready(function() {
       $("#guardar").click(function() {
           var dataEgreso = {
               "nro_cheque": $("#nro_cheque").val(),
               "dos_digitos": $("#dos_digitos").val(),
               "talonario": $("#talonario").val(),
               "cantidad": $("#cantidad").val()
           };
   
           //validamos que no quede ningun campo vacio
           if (dataEgreso.proveedor === ''||dataEgreso.talonario === '') {
   
               // mensaje en caso de que exista un campo vacio del formulario
               $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
               //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
           } else {
               $.ajax({
                   url: "<?php echo base_url() . 'index.php/Egresos/registrar_cheque'; ?>",
                   type: "POST",
                   data: dataEgreso,
                   beforeSend: function() {
                       $("#resultado").show();
                       $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                   },
                   //Despues de enviar los datos limpiamos los campos del formulario
                   success: function(respuesta) {
                       // Enviamos un mensaje de exito al insertar los datos
                       $("#nro_cheque").val(''),
                       $("#dos_digitos").val(''),
                       $("#talonario").val(''),
                       $("#cantidad").val(''),
                       alertify.log("Datos Registrados...!!!");
                       //Redirijimos luego de enviar los datos 
                       setInterval(function() {
                          // location.reload();
                          window.location.href = $("#F").val();
                       }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                   }
               });
           }
       });
   });
</script>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<script>
   function nobackbutton(){
   
   window.location.hash="no-back-button";
   
   window.location.hash="Again-No-back-button" //chrome
   
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>