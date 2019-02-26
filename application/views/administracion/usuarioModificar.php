<style type="text/css">
.flotante {
 display:scroll;
 position:fixed;
 bottom:80px;
 right:20px;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 14px;
  line-height: 1.33;
  border-radius: 50px;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}
.btn-circle:hover {
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}
.btn-circle.btn-lg {
    box-shadow:yellow;
}
#section{
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}
p {
    text-shadow: 2px 2px 2px grey;
}
.modal-header{
    background-color:#3d9970 !important;
}
.modal-title{
    color:#ffffff;
}


.redondeado {
 border-radius: 20px;
}
/* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
    min-width: 3em;
    max-width: 21em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 1ch 1.5ch;
    border-radius: .3ch;
    box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
    background: #333;
    color: #fff;
    z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}

/* FLOW: UP */
[tooltip]:not([flow])::before,
[tooltip][flow^="up"]::before {
  bottom: 100%;
  border-bottom-width: 0;
  border-top-color: #333;
}
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::after {
  bottom: calc(100% + 5px);
}
[tooltip]:not([flow])::before,
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::before,
[tooltip][flow^="up"]::after {
  left: 50%;
  transform: translate(-50%, -.5em);
}

/* FLOW: DOWN */
[tooltip][flow^="down"]::before {
  top: 100%;
  border-top-width: 0;
  border-bottom-color: #333;
}
[tooltip][flow^="down"]::after {
  top: calc(100% + 5px);
}
[tooltip][flow^="down"]::before,
[tooltip][flow^="down"]::after {
  left: 50%;
  transform: translate(-50%, .5em);
}

/* FLOW: LEFT */
[tooltip][flow^="left"]::before {
  top: 50%;
  border-right-width: 0;
  border-left-color: #333;
  left: calc(0em - 5px);
  transform: translate(-.5em, -50%);
}
[tooltip][flow^="left"]::after {
  top: 50%;
  right: calc(100% + 5px);
  transform: translate(-.5em, -50%);
}

/* FLOW: RIGHT */
[tooltip][flow^="right"]::before {
  top: 50%;
  border-left-width: 0;
  border-right-color: #333;
  right: calc(0em - 5px);
  transform: translate(.5em, -50%);
}
[tooltip][flow^="right"]::after {
  top: 50%;
  left: calc(100% + 5px);
  transform: translate(.5em, -50%);
}

/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
}
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
}
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after,
[tooltip][flow^="down"]:hover::before,
[tooltip][flow^="down"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}

[tooltip][flow^="left"]:hover::before,
[tooltip][flow^="left"]:hover::after,
[tooltip][flow^="right"]:hover::before,
[tooltip][flow^="right"]:hover::after {
  animation: tooltips-horz 300ms ease-out forwards;
}
/*===== Select del datatable =======*/
select {
   color: white;
   border: 1px solid #ccc;
   appearance: none;
   background: #3d9970;
   width: 45px;
   height: 30px;
   padding: 2px 0;
   font-size: 13px;
   line-height: 1.428571429;
   border-radius: 8px;
   box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.16);
}

</style>

<section class="content" style="width: 95%; align-content: center">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Usuario</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <form action='' name="formulario" id="formulario" method="POST" >
                        <div class="col-sm-12"  id='resultado'></div>     

                        <div class="col-sm-12" id="alert"></div>
                        <div class="col-sm-12" id="resultado"></div>
                        <input type="hidden"  class="form-control redondeado" readonly id="cedula2" name="cedula2" value="{cedula}" >
                         
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="form-group col-sm-4">
                            <label >C&eacute;dula</label> 
                            <input type="text"  class="form-control redondeado" readonly id="cedula" name="cedula" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label >Nombre</label> 
                            <input type="text"  class="form-control redondeado"  readonly id="nombres" name="nombres" >
                        </div>
                        <div class="form-group col-sm-4">
                            <label >Apellido</label>
                            <input type="text" class="form-control redondeado" readonly id="apellidos" name="apellidos" >
                        </div>

                        <div class="col-sm-12"></div>

                        <div class="form-group col-sm-8">
                            <label>Correo</label> 
                            <input type="text"   class="form-control redondeado" id="correo" name="correo" >
                        </div>

                        <div class="form-group col-sm-4">
                            <label>Usuario</label> 
                            <input type="text"  class="form-control text-uppercase redondeado" readonly id="usuario" name="usuario" >
                        </div>
                        <input type="hidden" id="url_respuesta">
                        <div class="form-group col-sm-12">
                          <span tooltip="Guardar">
                            <button  type="button" class="btn bg-olive btn-circle" id="modificar" >
                                <span class='glyphicon glyphicon-pencil'></span>
                            </button>
                        </span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Cambiar Contrase&ntilde;a</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    </div>
                </div>
                <div class="box-body">
                    <form action='' name="formulario2" id="formulario2" method="post" >
                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-12">
                            <label>Clave</label>
                                <input class="form-control redondeado" id="confirmar_clave" name="confirmar_clave" type="password" placeholder="Clave" >     
                        </div>
                        <div class="col-sm-3">&nbsp;</div>

                        <div class="col-sm-12"></div>

                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-12">
                         <label>Confirmar Clave</label>
                        <input class="form-control redondeado" id="clave" name="clave" type="password" placeholder="Confirmar Clave" >
                        </div>
                        <div class="col-sm-3">&nbsp;</div>
                        <input type="hidden" id="url_respuesta">
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="form-group col-sm-12">
                            <span tooltip="Guardar">
                            <button  type="button" class="btn bg-olive btn-circle" id="actualizar" >
                                <span class='glyphicon glyphicon-pencil'></span>
                            </button>
                        </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>

<script  src="<?php echo base_url(); ?>application/scripts/usuarios.js"></script>