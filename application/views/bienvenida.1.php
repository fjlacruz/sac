<meta name="theme-color" content="#F0DB4F">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="./img/ProgramadorFitness.png">
  <link rel="apple-touch-icon" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes/ProgramadorFitness.png">
  <link rel="apple-touch-startup-image" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes//ProgramadorFitness.png">
  <link rel="manifest" href="https://sac-jlacruz.c9users.io/manifest.json">

<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content2").fadeOut(1500);
    },3000);
});
$(document).ready(function() {
    setTimeout(function() {
        $(".formato_incorrecto").fadeOut(1500);
    },3000);
});
</script>
<body onload="nobackbutton();">
<section class="content">
    <form id="formulario" action="consultar_egresos_comunidad" method="POST" name="formulario" >
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <div class="content2"> 
          <?php
           $success = $this->session->flashdata('success');
             if ($success) {
              ?>
              <span id="registroCorrecto"><?php echo $success ?></span>
              
             <?php
             }
             ?>
             
            </div>
            
            <h3 class="box-title">SAC</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                   Sistema de Administraci&oacute;n de Condominios....

                </div>
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12" align="center"><?php echo '<img width="30%" src="' . base_url() . 'application/recursos/imagenes/aproe.png">'; ?></div> 
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-3">&nbsp;</div>
                
                
                <div class="form-group col-sm-6">
                            <label>Selecciona la Comunidad</label> &nbsp;
                            <a href="<?php echo base_url() ?>egresos/buscarDatosComunidad">
                                <button  type="button" title='Administrar Comunidades' class="btn btn-sample btn-xs" onclick="guardar2()"><i class="fa fa-plus"></i></button></a>
                            <select name="id_comunidad" id="id_comunidad"  class="form-control" ><option value="">Selecione...</option>
                           <?php
                         foreach ($comunidades as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                <div class="col-md-12">&nbsp;</div>
                <div class="form-group col-sm-3">&nbsp;</div>
                        <div class="form-group col-sm-6">
                            <button  type="submit" class="btn btn-sample" id="buscar" onclick="guardar2()">
                                <span class='glyphicon glyphicon-search'>&nbsp;Consultar....</span>
                            </button>
                        </div>
                <div class="col-md-12">&nbsp;</div>
            </div>
        </div>
    </div>
  
    </form>
</section>

</body>
<script>
    function nobackbutton(){
	
   window.location.hash="no-back-button.";
	
   window.location.hash="Again-No-back-button" //chrome
	
   window.onhashchange=function(){window.location.hash="";}
	
}
</script>
<!--============= script para registar usuarios ============================================== -->
<script>
    $(document).ready(function () {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {

                id_comunidad: {
                    row: '.col-sm-6',
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
    function guardar2(){
        var id_comunidad = document.getElementById('id_comunidad').value;
      
         
        localStorage.setItem('id_comunidad',id_comunidad);
        
    }

   $(document).ready( function() 
   {
      var id_comunidad = localStorage.getItem('id_comunidad');

      
      document.getElementById('id_comunidad').value=id_comunidad;
    
   } );

    function borrar(){
   if (localStorage)  {
      localStorage.removeItem("id_comunidad");
      
      }
        
    }
    </script>