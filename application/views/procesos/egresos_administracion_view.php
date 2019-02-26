<style type="text/css">
    #fijado {
    position:fixed;
    right:0px;
    bottom:100px;
}
</style>


<div class="col-md-12">&nbsp;</div>
<div class="col-md-6">
   <section class="content">
      <form id="formulario" action="../imprimirPDF_periodo" method="POST" name="formulario">
         <div class="col-md-4">&nbsp;</div>
         <input type="hidden" id="periodo" name="periodo" value="<?php echo $periodo;?>">
         <input type="hidden" id="id_comunidad" name="id_comunidad" value="<?php echo $comunidad;?>">
         <input type="hidden" id="anio" name="anio" value="<?php echo $anio;?>">
         <div class="col-md-4"></div>
         <div class="col-md-4">&nbsp;</div>
          <div class="col-md-12" align="center" id="fijado">
         <a>
         <span tooltip="Generar Pdf">
         <button type="submit" class="btn bg-olive btn-circle btn-lg" >
         <i class="glyphicon glyphicon-print"></i>
         </button>
         </span>
         </a>
         </div>
      </form>
        
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Remuneraciones</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_admnistracion != "") {
                               $contenido = "";
                                  foreach ($gastos_admnistracion as $resultado) {
                                           $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                                             $contenido.="<tr>      
                                                <td align='center'>" . "$resultado->nro_documento" . "</td>
                                                <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                                                <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                                                <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_adminstracion as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Otras Remuneraciones</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva3" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_varios != "") {
                           $contenido = "";
                           foreach ($gastos_varios as  $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_varios as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Administraci&oacute;n</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva1" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_mantencion != "") {
                           $contenido = "";
                           foreach ($gastos_mantencion as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_mantencion as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Mantenci&oacute;n y Reparaci&oacute;n</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva2" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_comun != "") {
                           $contenido = "";
                           foreach ($gastos_comun as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_comun as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Gastos Servicios Basicos</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva4" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_serv_bas != "") {
                           $contenido = "";
                           foreach ($gastos_serv_bas as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_serv_basicos as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Gastos Generales</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva5" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($gastos_gen != "") {
                           $contenido = "";
                           foreach ($gastos_gen as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_gastos_gen as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Gastos Servicios y Seguros</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva6" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($servicios_seguros != "") {
                           $contenido = "";
                           foreach ($servicios_seguros as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($sum_servicios_seguros as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Otros Rubros</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="testHoldon('sk-circle');" class="ajax"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class='filterable' >
                     <div class='panel-heading'>
                        <div class='pull-right'>
                           <span tooltip="Filtrar">
                           <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                           </span>
                        </div>
                     </div>
                     <table id="nueva7" class="display " cellspacing="0" width="100%" >
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center" >Nro Documento</th>
                              <th class="text-center" >Detalle</th>
                              <th class="text-center" >Cheque</th>
                              <th class="text-center">Monto</th>
                           </tr>
                        </thead>
                        <?php
                           if ($otros_rubros != "") {
                           $contenido = "";
                           foreach ($otros_rubros as $resultado) {
                               $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                           
                           $contenido.="<tr>      
                           
                              <td align='center'>" . "$resultado->nro_documento" . "</td>
                              <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                              <td align='center'>" .  "$resultado->nro_cheque" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>     
                               
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
                           <?php
                              echo $contenido;
                              ?>
                        </tbody>
                     </table>
                     <table class="table table-bordered " cellspacing="0" width="100%" >
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                        <td align='right'>Sub-Total</td>
                        <td align='center'><?php
                           foreach($suma_rubros as $fila)
                           $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                           {
                           ?>
                           <?php echo '$' . $nombre_format_francais?>
                           <?php
                              }
                              ?>
                        </td>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-6">
   <section class="content">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Total General de egresos</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <table>
                     <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                     <td align='center'>&nbsp;&nbsp;&nbsp;</td>
                     <td align='right'>Total&nbsp;&nbsp;</td>
                     <td align='center'><?php
                        foreach($suma_egreso_periodo as $fila)
                        $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                        {
                        ?>
                        <?php echo '$' . $nombre_format_francais?>
                        <?php
                           }
                           ?>
                     </td>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script type="text/javascript">
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
             retrieve: true
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
    
    $(document).ready(function () {
   
         $('#nueva1 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva1').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     $(document).ready(function () {
   
         $('#nueva2 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva2').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
      $(document).ready(function () {
   
         $('#nueva3 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva3').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     $(document).ready(function () {
   
         $('#nueva4 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva4').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     
     $(document).ready(function () {
   
         $('#nueva5 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva5').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     $(document).ready(function () {
   
         $('#nueva6 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva6').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     $(document).ready(function () {
   
         $('#nueva7 thead th').each(function () {
             var title = $(this).text();
             $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
         }
         );
         // DataTable
         var table = $('#nueva7').DataTable({
             "scrollY": "500px",
             "scrollCollapse": true,
             "paging": true,
             retrieve: true
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
     
     ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
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
             var $filteredRows = $rows.filter(function() {
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