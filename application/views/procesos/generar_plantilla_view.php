<?php
 $variablesSesion = $this->session->userdata('usuario');
 $rol = ($variablesSesion['rol']);
?>

<!--================================ Script de rutas ============================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_medidores.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-customselect.css" />
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<script>
   $(function() {
     $("#nro_dpto").customselect();
   });
</script>
<!--=============================================================================================================== -->
<!--===============================================Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->
<body onload="nobackbutton();">
<div>
   <section class="content" style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)) { ?>
            <a href="<?php echo base_url() ?>Medidores/medidores">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
             <?php } ?>
             
             
             <?php if ($variablesSesion['rol'] == 3) { ?>
            <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
             <?php } ?>
             
            <p class="box-title">Generar Datos para Carga Masiva</p>

            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="col-xs-12">&nbsp;</div>
         <div class="col-sm-12">
         <table>
                     <tr>
                        <td><a href="#" class="btn btn-success" disabled="disabled" type="button"><strong>Precarga de Lecturas</strong></a></td>
                      
                        <td><a href="<?php echo base_url() . 'index.php/Medidores/medidores'; ?>" class="btn btn-default" type="button"><strong>Registrar Concepto Medidor</strong></a></td>
                       </tr>
                       </table>
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
                  
                  <div id="asignar_medidor">
                     <div class="col-sm-4">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <form id="userForm" name="userForm">
                        <div class="col-sm-6">
                           <label >Nombre del Medidor</label>
                           <select name="id" id="id"  class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                                 
                                  <?php
                        foreach ($medidores as $i => $medidor) {
                            echo '<option value="' . $medidor->nombre_medidor . '">' . $medidor->nombre_medidor . '</option>';
                        }
                        ?>                      
                              </select>
                        </div>
                        
                         <div class="col-sm-2">
                           <label>Torre</label>
                           <select name="id_torre" id="id_torre"  class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                               
                                  <?php
                        foreach ($torres as $i => $torre) {
                            echo '<option value="' . $torre->id_torre . '">' . $torre->nombre_torre . '</option>';
                        }
                        ?>                      
                              </select>
                        </div>
                       
                          <div class="col-sm-2">
                              <label>Nro Departamento</label>
                           <select name="nro_dpto" id="nro_dpto" readonly class="form-control redondeado"></select>
                        </div>
                         <select name="torre" id="torre" readonly class="form-control redondeado" style="visibility:hidden"></select>
                        <?php
                        foreach($comunidad as $resultado)
                         {
                        ?>
                  
                        <input type="hidden" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                        
                        <?php
                        }
                        ?>
                        
                       
                        <div class="col-sm-2">
                           <label>&nbsp;</label>
                           <span tooltip="Guardar">
                              <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
                       
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden" id="F" value="<?php echo base_url() ?>Medidores/medidores">
                     </form>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </section>
</div>
</body>

<script>
   //=================== Script para mostrar municipios y parroquias ==================//
       $(document).on("change", '#id_torre', function ()
       {
           $("#nro_dpto").load("<?php echo base_url() . 'index.php/medidores/obtener_dpto2?id_torre='; ?>" + $(this).val());
           $("#torre").load("<?php echo base_url() . 'index.php/medidores/obtener_torre?id_torre='; ?>" + $(this).val());
           
       });
</script>

<script>
   $(function(){
    var $select = $(".1-100");
    for (i=0;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
   });
</script>



<!--========== script para permitir solo numeros y dos decimales con punto ==========-->
<script type="text/javascript">
   function filterFloat(evt,input){
       // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
       var key = window.Event ? evt.which : evt.keyCode;    
       var chark = String.fromCharCode(key);
       var tempValue = input.value+chark;
       if(key >= 48 && key <= 57){
           if(filter(tempValue)=== false){
               return false;
           }else{       
               return true;
           }
       }else{
             if(key == 8 || key == 13 || key == 0) {     
                 return true;              
             }else if(key == 46){
                   if(filter(tempValue)=== false){
                       return false;
                   }else{       
                       return true;
                   }
             }else{
                 return false;
             }
       }
   }
   function filter(__val__){
       var preg = /^([0-9]+\.?[0-9]{0,2})$/; //===== {0,2} Numero de decimales permitidos =====///
       if(preg.test(__val__) === true){
           return true;
       }else{
          return false;
       }
       
   }
   
</script>
<script>
  $(document).ready(function() {
    $('#userForm').formValidation({
        fields: {

            id: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
             id_torre: {
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
 
            obligatorio: {
                row: '.col-sm-2',
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
        url: "registar_asignacion",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Datos Registrados...!!"); 

        $('#userForm').formValidation('resetForm');
        $('#userForm')[0].reset();
        //myFunction(1)
        //reload_table();
        setInterval(function() {
                            //location.reload();
                            window.location.href = $("#F").val();
                        }, 3000);
    });
});
});

   
   
   
</script>
<script>
   //========== Validacion de tipo de campo solo letras o numeros =====================================
   function soloLetras(e) {
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " qwertyuiop\F1lkjhgfdsazxcvbnm";
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
       return ((key >= 48 && key <= 57) || (key == 8));
   }
   
   
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
<script>
   function fileValidation(){
       var fileInput = document.getElementById('adjunto');
       var filePath = fileInput.value;
       var allowedExtensions = /(.jpg|.jpeg|.png|.gif|.gif)$/i;
       if(!allowedExtensions.exec(filePath)){
           
           alertify.error("Formato Incorrecto  (Seleccione un archivo jpg,jpeg,png,gif)...!!");
           fileInput.value = '';
           return false;
       }else{
           //Image preview
           if (fileInput.files && fileInput.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                   document.getElementById('imagePreview').innerHTML = '<img width="100" height="100" src="'+e.target.result+'"/>';
               };
               reader.readAsDataURL(fileInput.files[0]);
           }
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