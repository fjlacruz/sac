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
            <th style="display:none">id_medidor</th>
            <th onkeypress="return soloLetras(event)" align='center'>Comunidad</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nombre Medidor</th>
            <th onkeypress="return soloLetras(event)" align='center'>Estatus</th>
            <th onkeypress="return soloLetras(event)" align='center'>Obligatorio</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje Aplicable</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proveedor Asociado</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_medidor" . "</td>
             <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
             <td align='center'>" .  "$resultado->nombre_medidor" . "</td>
             <td align='center'>" .  "$resultado->vigente" . "</td>
             <td align='center'>" .  "$resultado->obligatorio" . "</td>
             <td align='center'>" .  "$resultado->porcentaje" . "</td>
             <td align='center'>" .  "$resultado->proveedor" . "</td>
             <td align='center'>" .  "$resultado->fecha_registro" . "</td>
             <td align='center'> 
             <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_medidor' class='btn bg-olive btn-circle editButton' onclick='myFunction(2)'>
             <span class='fa  fa-pencil-square-o'></button></span>
             
             
             
              <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_medidor' class='btn bg-olive btn-circle deleteButton'>
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
         <?php echo $contenido;?>    
      </tbody>
   </table>
    <?php } ?>
    
    
    
    <?php if ($variablesSesion['rol'] == 2) { ?>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_medidor</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nombre Medidor</th>
            <th onkeypress="return soloLetras(event)" align='center'>Estatus</th>
            <th onkeypress="return soloLetras(event)" align='center'>Obligatorio</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje Aplicable</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proveedor Asociado</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_medidor" . "</td>
             <td align='center'>" .  "$resultado->nombre_medidor" . "</td>
             <td align='center'>" .  "$resultado->vigente" . "</td>
             <td align='center'>" .  "$resultado->obligatorio" . "</td>
             <td align='center'>" .  "$resultado->porcentaje  %" . "</td>
             <td align='center'>" .  "$resultado->proveedor" . "</td>
             <td align='center'>" .  "$resultado->fecha_registro" . "</td>
             <td align='center'> 
             <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_medidor' class='btn bg-olive btn-circle editButton' onclick='myFunction(2)'>
             <span class='fa  fa-pencil-square-o'></button></span>
             
            
             
              <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_medidor' class='btn bg-olive btn-circle deleteButton'>
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
         <?php echo $contenido;?>    
      </tbody>
   </table>
    <?php } ?>
    
    
     <?php if ($variablesSesion['rol'] == 3) { ?>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_medidor</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nombre Medidor</th>
            <th onkeypress="return soloLetras(event)" align='center'>Estatus</th>
            <th onkeypress="return soloLetras(event)" align='center'>Obligatorio</th>
            <th onkeypress="return soloLetras(event)" align='center'>Porcentaje Aplicable</th>
            <th onkeypress="return soloLetras(event)" align='center'>Proveedor Asociado</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha</th>
            
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_medidor" . "</td>
             <td align='center'>" .  "$resultado->nombre_medidor" . "</td>
             <td align='center'>" .  "$resultado->vigente" . "</td>
             <td align='center'>" .  "$resultado->obligatorio" . "</td>
             <td align='center'>" .  "$resultado->porcentaje  %" . "</td>
             <td align='center'>" .  "$resultado->proveedor" . "</td>
             <td align='center'>" .  "$resultado->fecha_registro" . "</td>
             
             
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
 <input type="hidden" id="redireccion" value="<?php echo base_url() ?>medidores/lectura_medidores">   
    
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm2').formValidation({
           fields: {
               
               nombre_medidor_edit: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                id_copropietario_edit: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               vigente_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               obligatorio_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               monto_modal: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                
                nro_documento_modal: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                fecha_ingreso_modal: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               periodo: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               anio: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                nro_dpto: {
             row: '.col-sm-2',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
               estatus_modal: {
                   row: '.col-sm-6',
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
               url: "<?php echo base_url() . 'index.php/Medidores/actualizar_medidor'; ?>",
               method: 'POST',
               data: $form.serialize()
           }).success(function(response) {
   
            alertify.log("Medidor Actualizado...!!!"); 
              
            $('#userForm2')[0].reset();
             myFunction(1)
             reload_table();
             //location.reload();
           });
       });
   });
   $('.editButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/consultar_medidores_id/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_medidor);
           $('[name="id_comunidad_edit"]').val(obj.id_comunidad);
           $('[name="nombre_medidor_edit"]').val(obj.nombre_medidor);
           $('[name="vigente_edit"]').val(obj.vgt);
           $('[name="obligatorio_edit"]').val(obj.obl);
           $('[name="fecha_registro_edit"]').val(obj.fecha_registro);
           $('[name="porcentaje_edit"]').val(obj.porcentaje);
           $('[name="id_proveedor_edit"]').val(obj.id_proveedor);

           
       });
   });
   
   
   
    $('.editButton2').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/consultar_medidores_id/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_medidor);
           $('[name="id_comunidad_edit"]').val(obj.id_comunidad);
           $('[name="nombre_medidor_edit"]').val(obj.nombre_medidor);
           $('[name="vigente_edit"]').val(obj.vgt);
           $('[name="obligatorio_edit"]').val(obj.obl);
           $('[name="fecha_registro_edit"]').val(obj.fecha_registro);
           $('[name="porcentaje_edit"]').val(obj.porcentaje);
           $('[name="id_proveedor_edit"]').val(obj.id_proveedor);

           
       });
   });
   
</script>

<script>
  $(document).ready(function() {
    $('#userForm3').formValidation({
       
}).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "registar_asignacion",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Datos Registrados...!!"); 

        $('#userForm3').formValidation('resetForm');
        $('#userForm3')[0].reset();
        //myFunction(1)
        //location.reload();
        window.location.href = $("#redireccion").val();
    });
});
});

</script>





<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/eliminar_medidor/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Medidor Eliminado...!!!"); 
            $('#userForm2')[0].reset();
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