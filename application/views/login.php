<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<style>
   body {background-color: #E5F2EF;}
</style>
<br><br><br><br>
<body>
   <div id="login">
      <section class="content" style="width: 40%; align-content: center">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title"><em>Prueba T&eacute;cnica</em></h3>
               <div class="box-tools pull-right">
               </div>
            </div>
            <div class="box-body" id="section">
               <div class="row">
                  <div class="col-md-12">
                     <form action='login' name="formulario" id="formulario" method="post" >
                        <div  class="row" >
                           <div class="col-md-12">
                              <div class="form-group has-feedback has-feedback-left"><label>Usuario</label>
                                 <input class="form-control" id="usuario" name="usuario" type="text " placeholder="Usuario" onkeyup="javascript:this.value = this.value.toUpperCase()" >
                                 <i class="fa fa-user form-control-feedback"></i>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group has-feedback has-feedback-left"><label>Clave</label>
                                 <input class="form-control" id="clave" name="clave" type="password" placeholder="Clave" >
                                 <i class="fa fa-lock form-control-feedback"></i>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="form-group col-md-12">
                           <span tooltip="Login">
                           <button type="submit" class="btn bg-olive btn-circle"><i class="glyphicon glyphicon-saved"></i></button></span>
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">Usuario: ADMIN</div>
                        <div class="col-sm-12">Clave: AAbb01**</div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
   </div>
   </section>
   </div>
</body>
<script>
   //validacion con boostrap
   $(document).ready(function() {
   
   $('#formulario').formValidation({
       framework: 'bootstrap',
       fields: {
           usuario: {
               row: '.col-md-12',
               validators: {
                   notEmpty: {
                       message: 'Nombre de Usuario Requerido'
                   }
               }
           },
           clave: {
               row: '.col-md-12',
               validators: {
                   notEmpty: {
                       message: 'La Clave es Requerida'
                   }
               }
           }
   
       }
   
   });
   
   });
</script>