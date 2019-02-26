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
            <th style="display:none">id_ingresos</th>
            <th onkeypress="return soloLetras(event)" align='center'>Comunidad</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nro Dpto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Nombres y Apellidos</th>
            <th onkeypress="return soloLetras(event)" align='center'>Periodo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Monto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha Ingreso</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_ingresos" . "</td>
             <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
             <td align='center'>" .  "$resultado->nro_dpto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->periodo" . " - "  . "$resultado->anio" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->monto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->fecha_ingreso" . "</td>
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_ingresos' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
               <a href='" . base_url() . "Ingresos/verAdjunto/" . "$resultado->id_ingresos" . "'>
                 <span tooltip='Ver Adjunto' flow='left'><button type='button' class='btn bg-olive btn-circle'><span class='glyphicon glyphicon-search'></span></button></span></a>
                <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_ingresos' class='btn bg-olive btn-circle deleteButton/'>
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
            <th style="display:none">id_ingresos</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nro Dpto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Nombres y Apellidos</th>
            <th onkeypress="return soloLetras(event)" align='center'>Periodo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Monto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha Ingreso</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_ingresos" . "</td>
             <td align='center'>" .  "$resultado->nro_dpto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->periodo" . " - "  . "$resultado->anio" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->monto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->fecha_ingreso" . "</td>
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_ingresos' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
               <a href='" . base_url() . "Ingresos/verAdjunto/" . "$resultado->id_ingresos" . "'>
                 <span tooltip='Ver Adjunto' flow='left'><button type='button' class='btn bg-olive btn-circle'><span class='glyphicon glyphicon-search'></span></button></span></a>
                <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_ingresos' class='btn bg-olive btn-circle deleteButton'>
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
            <th style="display:none">id_ingresos</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Nro Dpto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Nombres y Apellidos</th>
            <th onkeypress="return soloLetras(event)" align='center'>Periodo</th>
            <th onkeypress="return soloLetras(event)" align='center'>Monto</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha Ingreso</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_ingresos" . "</td>
             <td align='center'>" .  "$resultado->nro_dpto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->periodo" . " - "  . "$resultado->anio" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->monto" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->fecha_ingreso" . "</td>
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_ingresos' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
               <a href='" . base_url() . "Ingresos/verAdjunto/" . "$resultado->id_ingresos" . "'>
                 <span tooltip='Ver Adjunto' flow='left'><button type='button' class='btn bg-olive btn-circle'><span class='glyphicon glyphicon-search'></span></button></span></a>
                 
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
    
    
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm').formValidation({
           fields: {
               
               nro_dpto_modal: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               periodo_modal: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               anio_modal: {
                   row: '.col-sm-3',
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
                id_forma_pago_modal: {
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
               url: "<?php echo base_url() . 'index.php/ingresos/actualizar_ingreso'; ?>",
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
           url: "<?php echo base_url() . 'index.php/Ingresos/consultar_ingressos_id/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_ingresos);
           $('[name="id_comunidad_modal"]').val(obj.id_comunidad);
           $('[name="nombre_comunidad_modal"]').val(obj.nombre_comunidad);
           $('[name="id_copropietario_modal"]').val(obj.id_copropietario);
           $('[name="nombres_modal"]').val(obj.nombres);
           $('[name="apellidos_modal"]').val(obj.apellidos);
           $('[name="nro_dpto_modal"]').val(obj.nro_dpto);
           $('[name="monto_modal"]').val(obj.monto);
           $('[name="periodo_modal"]').val(obj.periodo);
           $('[name="anio_modal"]').val(obj.anio);
           $('[name="id_forma_pago_modal"]').val(obj.id_forma_pago);
           $('[name="descripcion_modal"]').val(obj.descripcion);
           $('[name="nro_documento_modal"]').val(obj.nro_documento);
           $('[name="fecha_ingreso_modal"]').val(obj.fecha_ingreso);
           $('[name="estatus_modal"]').val(obj.estatus);
           
       });
   });
   
</script>




<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Ingresos/eliminar_ingreso/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Ingreso Eliminado...!!!"); 
            $('#formulario')[0].reset();
               myFunction(1)
               location.reload();
               
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