<!--================================ Script de Rutas ========================================================== -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_producto.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<body onload="nobackbutton();">
   <div id="productos">
      <section class="content" >
         <div class="box box-success" id="section">
            <div class="box-header with-border">
               <p class="box-title">Administraci&oacute;n de Productos</p>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="modal fade" id="myModal" >
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header  bg-olive">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="tabla">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <a class='flotante'><span tooltip="Agregar Producto"><button type="submit" class="btn bg-olive btn-circle btn-lg"  onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
   </div>
   <!--=============================================================================================================== -->
   <!--=============================================================================================================== -->
   <div id="registrar_producto" style="display:none;" >
      <section class="content"  style="width: 95%; align-content: center">
         <div class="box box-success" id="section">
            <div class="box-header with-border">
               <span tooltip="Regresar">
               <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
               </span>
               <p class="box-title">Registrar Producto</p>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                     <form id="formulario_producto" method="POST" name="formulario"  action="">
                        <div class="form-group">
                           <div class="row">
                              <div class="col-sm-12"  id='resultado'></div>
                              <div class="form-group col-sm-6">
                                 <label>Nombre de la Bodega</label>
                                 <select name="id_bodega" id="id_bodega"  class="form-control" ><option value="">Selecione...</option>
                             <?php
                             foreach ($bodegas as $i => $bodega) {
                                 echo '<option value="' . $bodega->id_bodega . '">' . $bodega->descripcion_bodega . '</option>';
                             }
                             ?>                     
                         </select>
                              </div>
                              <div class="form-group col-sm-6">
                                 <label>Producto</label> 
                                 <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control text-uppercase" placeholder="Nombre del Producto" onkeypress="return soloLetras(event)">
                              </div>

                              <div class="form-group col-sm-6">
                                 <label>Precio</label>
                                 <input type="text" name="precio" id="precio" class="form-control text-uppercase" placeholder="Precio del Producto" onkeypress="return soloNumeros(event)">
                              </div>
                              <div class="form-group col-sm-6">
                                 <label>Stock</label> 
                                 <input type="text" name="stock" id="stock" class="form-control text-uppercase" placeholder="Cantidad Disponible" onkeypress="return soloNumeros(event)">
                              </div>
                              <div class="col-xs-12">
                                 <span tooltip="Guardar">
                                 <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <!--=============================================================================================================== -->
   <!--=============================================================================================================== -->
   <div id="editar_producto" style="display:none;">
      <section class="content"  style="width: 95%; align-content: center">
         <div class="box box-success" id="section">
            <div class="box-header with-border">
               <span tooltip="Regresar">
               <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
               </span>
               <p class="box-title">Editar Producto</p>
               <div class="col-sm-12">
               </div>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="col-md-12">
                     <form id="userForm" method="post" class="form-horizontal">
                        <div class="col-sm-12" align="center">
                           <input type="hidden"  id="id" name="id" >
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-6">
                           <label>Bodega</label>    
                           <select name="id_bodega" id="id_bodega"  class="form-control" ><option value="">Selecione...</option>
                             <?php
                             foreach ($bodegas as $i => $bodega) {
                                 echo '<option value="' . $bodega->id_bodega . '">' . $bodega->descripcion_bodega . '</option>';
                             }
                             ?>                     
                         </select>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Producto</label> 
                            <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control text-uppercase" placeholder="Nombre del Producto" onkeypress="return soloLetras(event)">
                        </div>
                     
                        <div class="col-sm-6">
                           <label>Precio</label>    
                           <input type="text" name="precio" id="precio" class="form-control text-uppercase" placeholder="Precio del Producto" onkeypress="return soloNumeros(event)">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Stock</label> 
                            <input type="text" name="stock" id="stock" class="form-control text-uppercase" placeholder="Cantidad Disponible" onkeypress="return soloNumeros(event)">
                        </div>

                        <div class="col-sm-6">
                           <label>Estatus</label>    
                           <select class="form-control" name='estatus' id='estatus'>
                              <option value="1">ACTIVO</option>
                              <option value="2">INACTIVO</option>
                           </select>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Fecha Registro</label> 
                            <input type="text" name="fecha_registro" id="fecha_registro" class="form-control" readonly="">
                        </div>
                      
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-xs-12">
                           <span tooltip="Guardar">
                           <button type="submit" class="btn bg-olive btn-circle" onclick="myFunction(3)"><i class="fa fa-save"></i></button>
                           </span>
                           <span tooltip="Cancelar">
                           <button type="button" class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                           </span>
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</body>
<input type="hidden" id="redireccion_mensaje" value="<?php echo base_url() ?>Productos/inicio">
<!--=============================================================================================================== -->
<script>
   $(document).ready(function() {
       $('#formulario_producto').formValidation({
           fields: {
      
               id_bodega: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
     
               descripcion_producto: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
               },
               precio: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
               },
               stock: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
               }
   
               }
   //==============  registro de Usuario ======================================================          
   }).on('success.form.fv', function(e) {
       e.preventDefault();
       var $form = $(e.target);
       $.ajax({
           url: "<?php echo base_url() ?>Productos/registrar_producto",
           method: 'POST',
           data: $form.serialize()
       }).success(function(response) {
   
           alertify.log("Se ha Registrado un Producto...!!"); 
        $('#formulario_producto').formValidation('resetForm');
        $('#formulario_producto')[0].reset();
       });
       setInterval(function() {
                       window.location.href = $("#redireccion_mensaje").val();
                   }, 2000);
        });
   });
   
</script>
<script>
   //================= filtros de la tabla ===================================================//
   
   $('#nueva thead th').each(function() {
       var title = $(this).text();
       $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
   });
   
       // DataTable
       var table = $('#nueva').DataTable({
           "scrollY": "500px",
           "scrollCollapse": true,
           "paging": true,
           "order": [[ 0, 'desc' ], [ 2, 'desc' ]],
           retrieve: true
       });
       //Apply the search
       table.columns().every(function() {
           var that = this;
           $('input', this.header()).on('keyup change', function() {
               if (that.search() !== this.value) {
                   that.search(this.value).draw();
               }
           });
       });
   
       $(document).ready(function() {
           $('.filterable .btn-filter').click(function() {
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
           $('.filterable .filters input').keyup(function(e) {
   
               var code = e.keyCode || e.which;
               if (code == '9')
                   return;
               var $input = $(this),
               inputContent = $input.val().toLowerCase(),
               $panel = $input.parents('.filterable'),
               column = $panel.find('.filters th').index($input.parents('th')),
               $table = $panel.find('.table'),
               $rows = $table.find('tbody tr');
               var $filteredRows = $rows.filter(function() {
                   var value = $(this).find('td').eq(column).text().toLowerCase();
                   return value.indexOf(inputContent) === -1;
               });
               $table.find('tbody .no-result').remove();
               $rows.show();
               $filteredRows.hide();
               if ($filteredRows.length === $rows.length) {
                   $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
               }
           });
       });
</script>

<script type="text/javascript">
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
</script>