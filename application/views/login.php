<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />



<style>
   
    
  body {background-color: #E5F2EF;}

    
  </style>


<br><br><br><br>

<body>
<div id="login">
<section class="content"  id="section" style="width: 40%; align-content: center">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><em>Sistema de Administracion de Condominios</em></h3>
            <div class="box-tools pull-right">
                
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form action='login' name="formulario" id="formulario" method="post" >
                                    <div  class="row" >
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback has-feedback-left"><label>Usuario</label>
                                                <input class="form-control redondeado" id="usuario" name="usuario" type="text " placeholder="Usuario" onkeyup="javascript:this.value = this.value.toUpperCase()" >
                                                <i class="fa fa-user form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback has-feedback-left"><label>Clave</label>
                                                <input class="form-control redondeado" id="clave" name="clave" type="password" placeholder="Clave" >
                                                <i class="fa fa-lock form-control-feedback"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="form-group col-md-12">
                                       
                                        <span tooltip="Login">
                                <button type="submit" class="btn bg-olive btn-circle"><i class="glyphicon glyphicon-saved"></i></button></span>
                            </div>
                                        
                                        
                                        
                                    </div>
                                </form>
<!--                                <form>-->
<!--    <input type="text" value="See! ONLY BOTTOM BORDER!" />-->
<!--</form>-->
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

        $('#loginForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                correo: {
                    validators: {
                        notEmpty: {
                            message: 'La Direcci&oacute;n de Correo es Requerida'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        },
                        emailAddress: {
                            message: 'Direcci&oacute;n de Correo Inv&aacute;lida'
                        }
                    }
                }
            }
        });
    });
    $('#formulario').formValidation({
        framework: 'bootstrap',
        fields: {
            usuario: {
                row: '.col-md-6',
                validators: {
                    notEmpty: {
                        message: 'Nombre de Usuario Requerido'
                    }
                }
            },
            clave: {
                row: '.col-md-6',
                validators: {
                    notEmpty: {
                        message: 'La Clave es Requerida'
                    }
                }
            }

        }

    });
    //consultamos si el correo existe
    $(document).ready(function() {
        $('#correo').keyup(function() {
            var correo = $(this).val();
            var dataString = 'correo=' + correo;

            $.ajax({
                type: "POST",
                url: "consultar_correo",
                data: dataString,
                success: function(data) {
                    if (data == 1) {

                        $("#botones").show();
                        $("#resultado2").html("<div class='alert alert-success alert-dismissable'>\n\
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>\n\
                <i class='icon fa fa-check'></i>Correo <strong>validado</strong> correctamente</div>");
                    } else {

                        $("#resultado2").html("<div class='alert alert-danger alert-dismissible'>\n\
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\n\
                <i class='icon fa fa-ban'></i><strong>Alerta! </strong>Cuenta de correo <strong>No Existente</div>");
                        document.getElementById('botones').style.display = 'none';

                    }
                }
            });
        });
    });
    // si existe enviamos el correo 
    $(document).ready(function() {
        $('#botones').click(function() {
            var correo = $('#correo').val();
            var dataString = 'correo=' + correo;
            $('#alerta').html('<label>Enviando correo ...</label>');
            $.ajax({
                data: dataString,
                type: 'POST',
                url: "recuperarClave",
                success: function(salida)
                {
                    $("#alerta").delay(1000).fadeOut(1000);
                    setTimeout(function() {
                        $('#success2').html('<label>Correo enviado con exito</label>');
                    }, 2000);
                }

            });
        });
    });

    //consultamos is el usuario existe
    $(document).on("blur", '#usuario', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {usuario: $('#usuario').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                console.log(respuesta);
                if (respuesta == 0)
                {
                    $('#usuario').val('');
                     alertify.error("El Usuario NO existe...!!!"); 

                }
            }
        });
    });

</script>

<style type="text/css">
    input[type="text"]
{
    border: 0;
    border-bottom: 1px solid red;
    outline: 0;
}
</style>

