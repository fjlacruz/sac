<?php
 $variablesSesion = $this->session->userdata('usuario');
 $rol = ($variablesSesion['rol']);
?>
<div class="col-sm-12"  id='resultado_msj'></div>
<div class='filterable'>
   <div class='panel-heading'>
      <div class='pull-right'>
         <span tooltip="Filtrar">
         <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
         </span>
      </div>
   </div>
   <?php if ($variablesSesion['rol'] == 1) { ?>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_multa</th>
            <th onkeypress="return soloLetras(event)" align='center'>Vencimiento</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proporcional a D&iacute;as</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje(%)</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Descripci&oacute;n</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fondo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Interes Simple</th>
            <th onkeypress="return soloLetras(event)" align='center'>Comunidad</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_multa" . "</td>
             <td align='center'>" .  "$resultado->fecha_vencimiento" . "</td>
             <td align='center'>" .  "$resultado->proporcional_a_dias" . "</td>
             <td align='center'>" .  "$resultado->porcentaje" . "</td>
             <td align='center'>" .  "$resultado->descripcion" . "</td>
             <td align='center'>" .  "$resultado->descripcion_fondo" . "</td>
             <td align='center'>" .  "$resultado->interes_simple" . "</td>
             <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
        
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_multa' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
             <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_multa' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
             </button></span>
               
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
         <?php echo $contenido;?>    
      </tbody>
   </table>
   <?php } ?>
   
   
   <?php if ($variablesSesion['rol'] == 2) { ?>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_multa</th>
            <th onkeypress="return soloLetras(event)" align='center'>Vencimiento</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proporcional a D&iacute;as</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje(%)</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Descripci&oacute;n</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fondo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Interes Simple</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_multa" . "</td>
             <td align='center'>" .  "$resultado->fecha_vencimiento" . "</td>
             <td align='center'>" .  "$resultado->proporcional_a_dias" . "</td>
             <td align='center'>" .  "$resultado->porcentaje" . "</td>
             <td align='center'>" .  "$resultado->descripcion" . "</td>
             <td align='center'>" .  "$resultado->descripcion_fondo" . "</td>
             <td align='center'>" .  "$resultado->interes_simple" . "</td>
        
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_multa' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
             <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_multa' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
             </button></span>
               
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
         <?php echo $contenido;?>    
      </tbody>
   </table>
   <?php } ?>
   
   
   <?php if ($variablesSesion['rol'] == 3) { ?>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_multa</th>
            <th onkeypress="return soloLetras(event)" align='center'>Vencimiento</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proporcional a D&iacute;as</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje(%)</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Descripci&oacute;n</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fondo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Interes Simple</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_multa" . "</td>
             <td align='center'>" .  "$resultado->fecha_vencimiento" . "</td>
             <td align='center'>" .  "$resultado->proporcional_a_dias" . "</td>
             <td align='center'>" .  "$resultado->porcentaje" . "</td>
             <td align='center'>" .  "$resultado->descripcion" . "</td>
             <td align='center'>" .  "$resultado->descripcion_fondo" . "</td>
             <td align='center'>" .  "$resultado->interes_simple" . "</td>
               
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
         <?php echo $contenido;?>    
      </tbody>
   </table>
   <?php } ?>
   
   
   
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm').formValidation({
           fields: {
               
               fecha_vencimiento2: {
                   row: '.col-sm-12',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
              proporcional_a_dias: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            porcentaje: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            descripcion: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
               interes_simple: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
             id_fondo: {
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
               url: "<?php echo base_url() . 'index.php/MultasIntereses/actualizar_multa'; ?>",
               method: 'POST',
               data: $form.serialize()
           }).success(function(response) {
   
            alertify.log("Ingreso Actualizado...!!!"); 
              
            $('#formulario')[0].reset();
               myFunction(1)
               
               reload_table();
           });
       });
   });
   $('.editButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/MultasIntereses/consultar_multas_id/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_multa);
           $('[name="fecha_vencimiento"]').val(obj.fecha_vencimiento2);
           $('[name="proporcional_a_dias"]').val(obj.proporcional_a_dias);
           $('[name="descripcion"]').val(obj.descripcion);
           $('[name="id_fondo"]').val(obj.id_fondo);
           $('[name="descripcion_fondo"]').val(obj.descripcion_fondo);
           $('[name="interes_simple"]').val(obj.interes_simple);
           $('[name="id_comunidad"]').val(obj.id_comunidad);
           $('[name="porcentaje"]').val(obj.porcentaje);
           
       });
   });
   
</script>


<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/MultasIntereses/eliminar_multa/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Multa Eliminado...!!!"); 
            $('#formulario')[0].reset();
               myFunction(1)
               reload_table();
           });
       });
   });
</script>



<script>
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