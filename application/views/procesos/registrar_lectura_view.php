<?php
   setlocale(LC_ALL, 'es_VE.UTF-8');
   date_default_timezone_set('America/Caracas');
   $hoy = date("Y-m-d");
   $fecha_registro = substr($hoy, 0, 10);
   
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   $id_comunidad = ($variablesSesion['id_comunidad']);
   ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<html>
   <body onload="nobackbutton();">
      <section class="content"  style="width: 95%; align-content: center">
         <div class="box box-success" id="section">
         <div class="box-header with-border">
            <span tooltip="Regresar">
            <a href="<?php echo base_url() ?>Medidores/lectura_medidores2" class="btn bg-orange btn-circle" type="button">
            <span class='glyphicon glyphicon-arrow-left'></a>
            </span>
            <h3 class="box-title">Medidores</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="col-sm-12">&nbsp;</div>
            <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
            
            <table>
               <tr>
                  <td><a href="#" class="btn btn-success" disabled="disabled" type="button"><strong>Registrar Lecturas</strong></a></td>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/lectura_medidores2'; ?>" class="btn btn-default" type="button"><strong>Consultar Lecturas</strong></a></td>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/plantilla'; ?>" class="btn btn-default" type="button"><strong>Descargar Plantilla(Carga Masiva)</strong></a></td>
               </tr>
            </table>
            
            
            </br></br>
            
            
            <?php } ?>   
            <form id="userForm2" method="post" class="form-horizontal" action="">
               <?php
                  foreach($comunidad as $resultado)
                  {
                  ?>
               <input type="hidden" name="id_comunidad" id="id_comunidad"  value="<?php echo $resultado->nombre_comunidad?>">
               <?php
                  }
                  ?>
               <div class="col-sm-4">
                  <label>Medidor</label> 
                  <select name="id_medidor" id="id_medidor" readonly class="form-control redondeado custom-select" >
                     <option value="">Selecione...</option>
                     <?php
                        foreach ($medidores as $i => $medidor) {
                            echo '<option value="' . $medidor->nombre_medidor . '">' . $medidor->nombre_medidor . '</option>';
                        }
                        ?>                     
                  </select>
               </div>
               <div class="col-sm-4">
                  <label>Torre</label> 
                  <select name="id_torre" id="id_torre" readonly class="form-control redondeado custom-select" >
                     <option value="">Selecione...</option>
                     <?php
                        foreach ($torres as $i => $torre) {
                            echo '<option value="' . $torre->id_torre . '">' . $torre->nombre_torre . '</option>';
                        }
                        ?>                     
                  </select>
               </div>
               <div class="col-sm-4">
                  <label>N° Departamento</label> 
                  <select name="nro_dpto" id="nro_dpto" readonly class="form-control redondeado" >
                  </select>
               </div>
               <div class="col-sm-12">&nbsp;</div>
               <div class="col-sm-4">
                  <label>Lectura Anterior</label> 
                  <input type="text" class="form-control redondeado" id="lectura_anterior" onkeypress="return filterFloat(event, this);" name="lectura_anterior" placeholder="Lectura Anterior" onkeyup="javascript:this.value = this.value.toUpperCase()">
               </div>
               <div class="col-sm-4">
                  <label>Lectura Actual</label> 
                  <input type="text"  class="form-control redondeado" id="lectura_actual" onkeypress="return filterFloat(event, this);"  name="lectura_actual" placeholder="Lectura Actual" onkeyup="javascript:this.value = this.value.toUpperCase()">
               </div>
               <input type="hidden"  class="form-control redondeado" id="estatus"  name="estatus" >
               <div class="col-sm-12">&nbsp;</div>
               <input type="hidden"  class="form-control" id="fecha_registro"  name="fecha_registro" value="<?php echo $fecha_registro ?>">
               <div class="form-group">
                  <div class="col-xs-12">
                     <span tooltip="Guardar">
                     <button type="submit" class="btn bg-olive btn-circle">
                     <i class="fa fa-save">
                     </i></button></span>
                  </div>
               </div>
               <select name="torre" id="torre" readonly class="form-control redondeado"  style="visibility:hidden"></select>
            </form>
         </div>
        
         
         <!--<div class="col-sm-12"><a href="<?php echo base_url() . 'index.php/Medidores/generar_plantilla'; ?>" class="btn bg-orange btn" type="button">-->
         <!--         Registrar Datos(Carga Masiva) </a></div>-->
         <div class="col-sm-6" align="center">
         </div>
        
         <div class="col-sm-12" align="left">
            <div class="panel panel-default">
               <div class="panel-heading"><strong>CARGA MASIVA</strong></div>
               <div class="panel-body">
                  <p>Estimado usuario le recomendamos siga las siguientes instrucciones para una una correcta carga masiva de lecturas al sistema:</p>
                  <p>1.-Descrague previamente la <a href="<?php echo base_url() . 'index.php/Medidores/plantilla'; ?>">plantilla</a> de datos a cargar<br/>
                  2.-<strong>NO MODIFIQUE </strong>los datos precargados en la plantilla tales como: Comunidad, Torre, Nro de Deapartamento,peri&iacute;do y año (El sistenma realizar&aacute; una comprobaci&oacute;n de consistencia de datos y s&oacute;lo cargara los datos reales validados).<br/>
                  <strong>S&Oacute;LO MODIFIQUE</strong> los datos referentes a lectura anetrior y/o lectura actual de acuerdo al caso<br/>
                  3.-Para el registro de las lecturas, indique las cantidades en caso de ser decimales con punto decimal. Ej: 123.34
                  <br/>
                  4.-NO deje celdas en blanco o vacias<br/>
                  5.-El formato del archivo a subir debe ser unicamente .CSV</p>
                  <br/>
                  
                  <form method='post' action='carga_masiva' enctype="multipart/form-data">
                        <input id="archivo" accept=".csv" name="archivo" type="file" required class="btn btn-default"/> 
                        <input name="MAX_FILE_SIZE" type="hidden" value="200000" />
                        </br>
                        <input name="enviar" type="submit" value="Importar" class="btn btn-success" id="file" onclick="comprueba_extension(this.form, this.form.archivo.value)"/>
       
                    </form>
                    <br/><br/>



           <?php
            $success = $this->session->flashdata('success');
            if ($success) {
                ?>
                <div ><?php echo $success ?></div>
            <?php }
            ?>
                <?php
            $warning = $this->session->flashdata('warning');
            if ($warning) {
                ?>
                <div ><?php echo $warning ?></div>
            <?php }
            ?>
                  
                  
                  <div class="col-sm-12">&nbsp;</div>
  
               </div>
            </div>
         </div>
         <!--<div class="col-sm-6" align="left">-->
         <!--   <div class="panel panel-default">-->
         <!--      <div class="panel-heading"><strong>DESCARGUE LA PLANTILLA  PARA CARGA MASIVA</strong></div>-->
         <!--      <div class="panel-body"> <a href="<?php echo base_url() . 'index.php/Medidores/generar_plantilla'; ?>" class="btn bg-orange btn" type="button">-->
         <!--         GENERAR PLANTILLA </a>-->
         <!--         <a href="<?php echo base_url() . 'index.php/Medidores/createcsv'; ?>">Csv</a>-->
         <!--         <a href="<?php echo base_url() . 'index.php/Medidores/registar_asignacion'; ?>">Exel</a>-->
         <!--      </div>-->
         <!--   </div>-->
         <!--</div>-->
   
         <div class="box-body">
         <div class="row">
         <div class="col-md-12">
      </section>
   </body>
   <input type="hidden" id="redireccion" value="<?php echo base_url() ?>medidores/registrar_lectura"> 
   </body>
</html>




<script type="text/javascript" src="">
    function comprueba_extension(formulario, archivo) { 
   extensiones_permitidas = new Array(".gif"); 
   mierror = ""; 
   if (!archivo) { 
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
      	mierror = "No has seleccionado ningún archivo"; 
   }else{ 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
         mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}else{ 
         	//submito! 
         alert ("Todo correcto. Voy a submitir el formulario."); 
         formulario.submit(); 
         return 1; 
      	} 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert (mierror); 
   return 0; 
}
</script>







<script>
   //=================== Script para mostrar municipios y parroquias ==================//
       $(document).on("change", '#id_torre', function ()
       {
           $("#nro_dpto").load("<?php echo base_url() . 'index.php/medidores/obtener_dpto?id_torre='; ?>" + $(this).val());
           $("#torre").load("<?php echo base_url() . 'index.php/medidores/obtener_torre?id_torre='; ?>" + $(this).val());
       });

</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#userForm1').formValidation({
           fields: {
   
               lectura_anterior_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
   
               lectura_actual_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               anio_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               periodo_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
           }
       }).on('success.form.fv', function (e) {
           e.preventDefault();
           var $form = $(e.target);
           $.ajax({
               url: "<?php echo base_url() . 'index.php/Medidores/actualizar_lectura'; ?>",
               method: 'POST',
               data: $form.serialize()
           }).success(function (response) {
   
               alertify.log("Lectura Registrada...!!!");
   
               $('#userForm1')[0].reset();
               myFunction(1)
               //reload_table();
               location.reload();
           });
       });
   });
   $('.editButton1').on('click', function () {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/consultarLecturaId/'; ?>" + id,
           method: 'GET'
   
       }).success(function (data) {
   
           var obj1 = JSON.parse(data);//parceamos los datos
           var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
   
           $('#userForm')
           $('[name="id"]').val(obj.id_lectura);
           $('[name="id_medidor"]').val(obj.id_medidor);
           $('[name="nro_dpto_edit"]').val(obj.nro_dpto);
           $('[name="lectura_anterior_edit"]').val(obj.lectura_anterior);
           $('[name="lectura_actual_edit"]').val(obj.lectura_actual);
           $('[name="periodo_edit"]').val(obj.periodo);
           $('[name="anio_edit"]').val(obj.anio);
   
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
           "order": [[0, 'desc'], [2, 'desc']],
           "retrieve": true
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
<script>
   $(document).ready(function () {
       $('#userForm2').formValidation({
           fields: {
   
               id_medidor: {
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_torre: {
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               lectura_anterior: {
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               lectura_actual: {
                   row: '.col-sm-4',
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
               }
   
           }
   
       }).on('success.form.fv', function (e) {
           e.preventDefault();
           var $form = $(e.target);
           $.ajax({
               url: "actualizar_lectura_medidor",
               method: 'POST',
               data: $form.serialize()
           }).success(function (response) {
               alertify.log("Datos Registrados...!!");
   
               $('#userForm2').formValidation('resetForm');
               $('#userForm2')[0].reset();
               //myFunction(1)
               //location.reload();
               setInterval(function() {
               location.reload();
              }, 2000);
           });
       });
   });
   
</script>
<script type="text/javascript">
   function filterFloat(evt, input) {
       // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
       var key = window.Event ? evt.which : evt.keyCode;
       var chark = String.fromCharCode(key);
       var tempValue = input.value + chark;
       if (key >= 48 && key <= 57) {
           if (filter(tempValue) === false) {
               return false;
           } else {
               return true;
           }
       } else {
           if (key == 8 || key == 13 || key == 0) {
               return true;
           } else if (key == 46) {
               if (filter(tempValue) === false) {
                   return false;
               } else {
                   return true;
               }
           } else {
               return false;
           }
       }
   }
   function filter(__val__) {
       var preg = /^([0-9]+\.?[0-9]{0,2})$/; //===== {0,2} Numero de decimales permitidos =====///
       if (preg.test(__val__) === true) {
           return true;
       } else {
           return false;
       }
   
   }
   
</script>

<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>