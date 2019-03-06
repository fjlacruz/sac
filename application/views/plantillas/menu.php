<style>
   .tooltip {
   position: relative;
   display: inline-block;
   border-bottom: 1px dotted black;
   }
   .tooltip .tooltiptext {
   visibility: hidden;
   width: 120px;
   background-color: black;
   color: #fff;
   text-align: center;
   border-radius: 6px;
   padding: 5px 0;
   /* Position the tooltip */
   position: absolute;
   z-index: 1;
   }
   .tooltip:hover .tooltiptext {
   visibility: visible;
   }
</style>
<?php
   $variablesSesion = $this->session->userdata('usuario');
   if ($variablesSesion == "") {
       redirect('principal/session');
   }
   ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/menu.css">
<html>
   <body >
      <nav>
         <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i> Menu</a>
         <ul class="menu">
            <li><a  class="homer" href="<?php echo BASE_URL() ?>Bodega/inicio" ><i class="fa fa-home"></i> Bodegas</a></li>
            </li>
            <li><a  class="homer" href="<?php echo BASE_URL() ?>Productos/inicio" ><i class="fa fa-tag"></i> Productos</a></li>
            </li>
            <li style="float: right;"><a href="<?php echo base_url() ?>index.php/Principal/logout"><span class="glyphicon glyphicon-log-in" ></span>&nbsp; Salir</a></li>
            
         </ul>
      </nav>
   
      <script>
         $(document).ready(function() {
                 $.ajax({
                     url: "tabla",
                     type: 'post',
                     success: function(salida) {
                         $("#tabla").html(salida);
                     }
                 });
             });
         
             function reload_table() {
                 $.ajax({
                     url: "tabla",
                     type: 'post',
                     success: function(salida) {
                         $("#tabla").html(salida);
                     }
                 });
         
             }
         
      </script>

    
   </body>
</html>