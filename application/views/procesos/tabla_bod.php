<?php
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   ?>
<div class='filterable'>
   <div class='panel-heading'>
      <div class='pull-right'>
         <span tooltip="Filtrar">
         <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
         </span>
      </div>
   </div>
   <table id="nueva" class="display" cellspacing="0" width="100%" >
      <thead align='center' >
         <tr class="filters" >
            <th style="display:none">id_bodega</th>
            <th onkeypress="return soloLetras(event)" align='center'>Bodega</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Ubicaci&oacute;n</th>
            <th onkeypress="return soloNumeros(event)" align='center'>Estatus</th>
            <th onkeypress="return soloLetras(event)" align='center'>Fecha Registro</th>
            <th onkeypress="return soloLetras(event)" align='center'>Acciones</th>
         </tr>
      </thead>
      <?php
         if ($resultados != "") {
            $contenido = "";
            foreach ($resultados as $resultado) {
             $contenido.="<tr>      
             <td style='display:none'>" . "$resultado->id_bodega" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->descripcion_bodega" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->ubicacion_bodega" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->estatus" . "</td>
             <td align='center' class='text-uppercase'>" .  "$resultado->fecha_registro" . "</td>
             <td align='center'> <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_bodega' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
             <span class='fa  fa-pencil-square-o'></span>
             </button></span>
                
         
             <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_bodega' class='btn bg-olive btn-circle deleteButton'>
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
   <input type="hidden" id="redireccion_mensaje" value="<?php echo base_url() ?>Bodega/inicio">
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm').formValidation({
           fields: {
               
               descripcion_bodega: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               ubicacion_bodega: {
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
               url: "<?php echo base_url() . 'index.php/Bodega/actualizar_bodega'; ?>",
               method: 'POST',
               data: $form.serialize()
           }).success(function(response) {
   
            alertify.log("Bodega Actualizada...!!!"); 
              
           });
           setInterval(function() {
                    window.location.href = $("#redireccion_mensaje").val();
                }, 2000);
       });
   });
   $('.editButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Bodega/consultar_bodega_id/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_bodega);
           $('[name="descripcion_bodega"]').val(obj.descripcion_bodega);
           $('[name="ubicacion_bodega"]').val(obj.ubicacion_bodega);
           $('[name="fecha_registro"]').val(obj.fecha_registro);
           $('[name="estatus"]').val(obj.estatus);
           
       });
   });
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
          url: "<?php echo base_url() . 'index.php/Bodega/eliminar_bodega/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Bodega Eliminada...!!!"); 
            $('#formulario')[0].reset();
           });
         setInterval(function() {
                    window.location.href = $("#redireccion_mensaje").val();
                }, 2000);
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