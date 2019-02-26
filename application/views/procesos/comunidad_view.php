<style>
   .modal-header{
   background-color:#942349 !important;
   }
   .modal-title{
   color:#ffffff;
   }
   #mdialTamanio{
   width: 60% !important;
   }
</style>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<script type="text/javascript">
   $(document).ready(function() {
       setTimeout(function() {
           $(".col-xs-12").fadeOut(3500);
       },6000);
   });
   
</script>
<script>
   function myFunction(idButton) {
      var comunidades = document.getElementById('comunidades');
      var registrar_comunidad = document.getElementById('registrar_comunidad');
      var registrar_torre = document.getElementById('registrar_torre');
      var editar_torre = document.getElementById('editar_torre');
   
      switch(idButton) {
       case 1:
       comunidades.style.display = 'block';
       registrar_comunidad.style.display = 'none';
       registrar_torre.style.display = 'none';
       editar_torre.style.display = 'none';
       break;
   
       case 2:
       comunidades.style.display = 'none';
       registrar_comunidad.style.display = 'block';
       registrar_torre.style.display = 'none';
       editar_torre.style.display = 'none';
       break;
       
       case 3:
       comunidades.style.display = 'none';
       registrar_comunidad.style.display = 'none';
       registrar_torre.style.display = 'block';
       editar_torre.style.display = 'none';
       break;
       
       case 4:
       comunidades.style.display = 'none';
       registrar_comunidad.style.display = 'none';
       registrar_torre.style.display = 'none';
       editar_torre.style.display = 'block';
       break;
   
       default:
       alert("hay un problema: No existe el producto.")
   }
   
   }
</script>
<div id="registrar_comunidad" style="display:none;">
   <section class="content"  id="section" style="width: 95%; align-content: center">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Registrar Nueva Comunidad</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="formulario" action="" method="POST" name="formulario" >
                     <div class="col-xs-12"  id='resultado'></div>
                     <div class="col-xs-12"  id='resultado2'></div>
                     <div class="form-group col-sm-12">
                        <label>Nombre de la Comunidad</label> 
                        <input type="text"  class="form-control redondeado" id="nombre_comunidad"  name="nombre_comunidad" placeholder="Indique el Nombre de la Comunidad" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="form-group col-sm-12">
                        <label>Direcci&oacute;n</label> 
                        <input type="text"  class="form-control redondeado" id="direccion"  name="direccion" placeholder="Indique la Direcci&oacute;n" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="form-group col-sm-12">
                        <label>Rut</label> 
                        <input type="text"  class="form-control redondeado" id="rut"  name="rut" placeholder="Indique el RUT" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="form-group col-sm-12">
                        <label>Tel&eacute;fono</label> 
                        <input type="text" onkeypress="return soloNumeros(event)" class="form-control redondeado" id="telefono"  name="telefono" placeholder="Indique nro de  Tel&eacute;fono" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <span tooltip="Guardar">
                        <button type="" id="guardar" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                        <span tooltip="Cancelar">
                        <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div id="comunidades">
<section class="content" id="section" style="width: 95%; align-content: center">
   <div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">Administraci&oacute;n de Comunidades</h3>
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
         <table id="nueva" class="display " cellspacing="0" width="100%" >
            <thead>
               <tr class="filters">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                  <th onkeypress="return soloLetras(event)">Comunidad</th>
                  <th onkeypress="return soloNumeros(event)">Direcci&oacute;n</th>
                  <th onkeypress="return soloNumeros(event)">RUT</th>
                  <th onkeypress="return soloNumeros(event)">Tel&eacute;fono</th>
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
               
                 <td style='display:none'>" . "$resultado->id_comunidad" . "</td>
                  <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                  <td align='center'>" .  "$resultado->direccion" . "</td>
                  <td align='center'>" .  "$resultado->rut" . "</td>
                  <td align='center'>" .  "$resultado->telefono" . "</td>
                  <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                  <td align='center'>" .  "$resultado->estatus" . "</td>
                  <td align='center'> 
                  
                  <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_comunidad' class='btn bg-olive btn-circle editButton'>
                  <span class='fa  fa-pencil-square-o'></span>
                  </button></span>
                  
                  <span tooltip='Agregar Torres' flow='left'><button type='button' data-id='$resultado->id_comunidad' class='btn bg-olive btn-circle editButton2'  onclick='myFunction(3)'>
                  <span class='fa  fa-home'></span>
                  </button></span>
               
                  <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_comunidad' class='btn bg-olive btn-circle deleteButton'>
                  <span class='fa  fa-close'></span>
                  </button></span>
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
         <div class="col-sm-12">&nbsp;</div>
         <span tooltip="Cancelar">
         <button type="button"  class="btn bg-orange btn-circle" onclick="history.back()"><i class="fa fa-close"></i></button>
         </span>
      </div>
      <form id="userForm" method="post" class="form-horizontal" style="display: none;">
         <div class="col-sm-12"  id='resultado'></div>
         <div class="col-sm-12"  id='resultado2'></div>
         <div class="form-group col-sm-12">
            <label>Comunidad</label> 
            <input type="text"  class="form-control redondeado" id="nombre_comunidad"  name="nombre_comunidad" placeholder="Indique el Nombre de la Comunidad" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="col-sm-12"></div>
         <div class="form-group col-sm-12">
            <label>Direcci&oacute;n</label> 
            <input type="text"  class="form-control redondeado" id="direccion"  name="direccion" placeholder="Indique la Direcci&oacute;n" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="form-group col-sm-12">
            <label>Rut</label> 
            <input type="text"  class="form-control redondeado" id="rut"  name="rut" placeholder="Indique el RUT" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="form-group col-sm-12">
            <label>Tel&eacute;fono</label> 
            <input type="text" onkeypress="return soloNumeros(event)" class="form-control redondeado" id="telefono"  name="telefono" placeholder="Indique nro de  Tel&eacute;fono" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="col-sm-12"></div>
         <div class="form-group col-sm-12">
            <label>Fecha Registro</label> 
            <input type="text" readonly="readonly" class="form-control redondeado" id="fecha_registro" onKeyPress="return soloLetras(event)" name="fecha_registro" placeholder="Motivo" onkeyup="javascript:this.value = this.value.toUpperCase()">
         </div>
         <div class="form-group col-sm-12">
            <label>Estatus</label>
            <select name="estatus" id="estatus"  class="form-control redondeado">
               <option value="">Selecione...</option>
               <option value="1">ACTIVO</option>
               <option value="2">DESACTIVADO</option>
            </select>
         </div>
         <div class="col-sm-12">&nbsp;</div>
         <input type="hidden"  class="form-control" id="id"  name="id" >
         <div class="form-group">
            <div class="col-sm-12">
               <span tooltip="Guardar">
               <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
            </div>
         </div>
      </form>
</section>
<a class='flotante'><span tooltip="Agregar Comunidad"><button type="submit" class="btn bg-olive btn-circle btn-lg" onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
</div>
<div id="registrar_torre" style="display:none;">
   <section class="content"  id="section" style="width: 95%; align-content: center">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Registrar Torre</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <div class="box-body">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
               <div class="col-md-6">
                  <form id="userForm2" action="" method="POST" name="userForm2" >
                     <input type="hidden"  class="form-control" id="id"  name="id" >
                     <div class="form-group col-sm-12">
                        <label>Nombre de la Torre</label> 
                        <input type="text"  class="form-control redondeado" id="nombre_torre"  name="nombre_torre" placeholder="Indique el Nombre de la Torre" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <span tooltip="Guardar">
                        <button type="" id="guardar" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                        <span tooltip="Cancelar">
                        <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                     </div>
                  </form>
              
               
               <div class='filterable'>
   
         <table id="nueva2"  class="table table-border " cellspacing="0" width="100%" >
            <thead>
               <tr class="filters2">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                  <th onkeypress="return soloLetras(event)" style='display:none'>Nombre Torre</th>

                  <th onkeypress="return soloLetras(event)" style='display:none'>Editar</th>
               </tr>
            </thead>
            <?php
               if ($torres != "") {
               $contenido = "";
               foreach ($torres as $resultado) {
               
               $contenido.="<tr>      
               
                 <td style='display:none'>" . "$resultado->id_torre" . "</td>
                  <td align='center'>" .  "$resultado->nombre_torre" . "</td>

                  <td align='center'> 
                  
                  <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_torre' class='btn bg-olive btn-circle editButton3' onclick='myFunction(4)'>
                  <span class='fa  fa-pencil-square-o'></span>
                  </button></span>

               
                  <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_torre' class='btn bg-olive btn-circle deleteButton2'>
                  <span class='fa  fa-close'></span>
                  </button></span>
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
         <div class="col-sm-12">&nbsp;</div>
     
      </div>
               
         </div>      
               
               
               
            </div>
         </div>
      </div>
   </section>
</div>



<div id="editar_torre" style="display:none;">
   <section class="content"  id="section" style="width: 95%; align-content: center">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Registrar Torre</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <div class="box-body">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
               <div class="col-md-6">
                  <form id="userForm3"  method="POST" name="userForm2" action='<?php echo base_url() . 'index.php/egresos/actualizar_torre'; ?>'>
                     <input type="hidden"  class="form-control" id="id"  name="id" >
                     <div class="form-group col-sm-12">
                        <label>Nombre de la Torre</label> 
                        <input type="text"  class="form-control redondeado" id="nombre_torre"  name="nombre_torre" placeholder="Indique el Nombre de la Torre" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <span tooltip="Guardar">
                        <button type="" id="guardar" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                        <span tooltip="Cancelar">
                        <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                     </div>
                  </form>
              
               
               <div class='filterable'>
   
         <table id="nueva2"  class="table table-border " cellspacing="0" width="100%" >
            <thead>
               <tr class="filters2">
                  <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                  <th onkeypress="return soloLetras(event)" style='display:none'>Nombre Torre</th>

                  <th onkeypress="return soloLetras(event)" style='display:none'>Editar</th>
               </tr>
            </thead>
            <?php
               if ($torres != "") {
               $contenido = "";
               foreach ($torres as $resultado) {
               
               $contenido.="<tr>      
               
                 <td style='display:none'>" . "$resultado->id_torre" . "</td>
                  <td align='center'>" .  "$resultado->nombre_torre" . "</td>

                  <td align='center'> 
                  
                  <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_torre' class='btn bg-olive btn-circle editButton3'>
                  <span class='fa  fa-pencil-square-o'></span>
                  </button></span>

               
                  <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_torre' class='btn bg-olive btn-circle deleteButton2'>
                  <span class='fa  fa-close'></span>
                  </button></span>
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
         <div class="col-sm-12">&nbsp;</div>
      </div>
         </div>      
            </div>
         </div>
      </div>
   </section>
</div>




<script type="text/javascript">
   $(document).ready(function () {
       $('#userForm')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       nombre_comunidad: {
                           row: '.col-sm-12',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                           direccion: {
                           row: '.col-sm-12',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          estatus: {
                           row: '.col-sm-12',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          rut: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               telefono: {
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
   
                   $.ajax({
                       url: "<?php echo base_url() . 'index.php/egresos/actualizar_comunidad'; ?>",
                       method: 'POST',
                       data: $form.serialize()
                   }).success(function (response) {
                   alertify.log("Datos Actualizados...!!!"); 
                   setInterval(function() {
                           location.reload();
                       }, 2000);
   
                       $form.parents('.bootbox').modal('hide');
                       
   
                   });
               });
       $('.editButton').on('click', function () {
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'index.php/egresos/consultarComunidadId/'; ?>" + id,
               method: 'GET'
   
           }).success(function(data) {
   
               var obj = JSON.parse(data);
               $('#userForm')
                       .find('[name="id"]').val(obj.id_comunidad).end()
                       .find('[name="nombre_comunidad"]').val(obj.nombre_comunidad).end()
                       .find('[name="direccion"]').val(obj.direccion).end()
                       .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                       .find('[name="estatus"]').val(obj.estatus).end()
                       .find('[name="rut"]').val(obj.rut).end()
                       .find('[name="telefono"]').val(obj.telefono).end();
               // Show the dialog
               bootbox
                       .dialog({
                           title: 'Editar Comunidad',
                           message: $('#userForm'),
                           show: false // We will show it manually later
                       })
                       .on('shown.bs.modal', function () {
                           $('#userForm')
                           .show()                             // Show the login form
                           .formValidation('resetForm'); // Reset form
                       })
                       .on('hide.bs.modal', function (e) {
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
           "paging": false,
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
    $(document).ready(function () {
   
 
       
       // DataTable
       var table = $('#nueva2').DataTable({
           "scrollY": "500px",
           "scrollCollapse": true,
           "paging": false,
           "ordering": true,
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
               nombre_comunidad: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               direccion: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               rut: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               telefono: {
                   row: '.col-sm-12',
                   validators: {
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
   $(document).on("blur", '#nombre_comunidad', function ()
   {
       $.ajax({
           url: "<?php echo base_url() . 'index.php/egresos/consultar_existe_comunidad'; ?>",
           data: {nombre_comunidad: $('#nombre_comunidad').val()},
           dataType: 'html',
           type: 'post',
           success: function (respuesta) {
   
               if (respuesta == 1)
               {
                $('#nombre_comunidad').val('');
                alertify.error("La Comunidad Ya Existe...!!!"); 
               }
           }
       });
   });
  
</script>
<script>
   $(document).ready(function() {
       $("#guardar").click(function() {
           var dataEgreso = {
               "nombre_comunidad": $("#nombre_comunidad").val(), 
               "direccion": $("#direccion").val(),
               "rut": $("#rut").val(),
               "telefono": $("#telefono").val()
           };
   
           //validamos que no quede ningun campo vacio
           if (dataEgreso.nombre_comunidad === '' || dataEgreso.direccion === ''|| dataEgreso.rut === ''|| dataEgreso.telefono === '') {
   
               // mensaje en caso de que exista un campo vacio del formulario
               alertify.error("Debe completar todos los acmpos...!!!");
               //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
           } else {
               $.ajax({
                   url: "<?php echo base_url() . 'index.php/Egresos/registrar_comunidad'; ?>",
                   type: "POST",
                   data: dataEgreso,
                   beforeSend: function() {
                       $("#resultado").show();
                       $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                   },
                   //Despues de enviar los datos limpiamos los campos del formulario
                   success: function(respuesta) {
                       // Enviamos un mensaje de exito al insertar los datos
                       $("#nombre_comunidad").val(''),
                       $("#direccion").val(''),
                       alertify.log("Comunidad Registrada con Exito...!!"); 
                       //Redirijimos luego de enviar los datos 
                       setInterval(function() {
                           location.reload();
                       }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                   }
               });
           }
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Egresos/eliminar_comunidad/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Comunidad Eliminada...!!!"); 
            $('#formulario')[0].reset();
               myFunction(1)
               location.reload();
               
           });
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#userForm2')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
    
               nombre_torre: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
                   }
                   
               }).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "<?php echo base_url() ?>egresos/registrar_torre",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Datos Registrados...!!"); 
   
        $('#userForm2').formValidation('resetForm');
        $('#userForm2')[0].reset();
        myFunction(1)
        location.reload();
    });
   });
       $('.editButton2').on('click', function () {
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'index.php/egresos/consultarComunidadId/'; ?>" + id,
               method: 'GET'
   
           }).success(function(data) {
   
               var obj = JSON.parse(data);
               $('#userForm2')
             .find('[name="id"]').val(obj.id_comunidad).end()
             .find('[name="nombre_comunidad"]').val(obj.nombre_comunidad).end();
   
           });
       }).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "<?php echo base_url() ?>egresos/modificar_torre",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Datos actualizados...!!"); 
   
        $('#userForm3').formValidation('resetForm');
        $('#userForm3')[0].reset();
        myFunction(1)
        location.reload();
    });
   });
       $('.editButton3').on('click', function () {
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'index.php/egresos/consultarTorreId/'; ?>" + id,
               method: 'GET'
   
           }).success(function(data) {
   
               var obj = JSON.parse(data);
               $('#userForm3')
             .find('[name="id"]').val(obj.id_torre).end()
             .find('[name="nombre_torre"]').val(obj.nombre_torre).end();
   
           });
       });
   });
   
</script>

<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton2').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Egresos/eliminar_torre/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Ingreso Eliminado...!!!"); 
            $('#userForm2')[0].reset();
               myFunction(1)
               location.reload();
               
           });
       });
   });
</script>