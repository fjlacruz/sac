<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Informacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Informacion_model');
         $this->load->model('Egresos_model');
    }

    public function index($id_comunidad) {
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        if ($rol == 1) {
        $datos_info = $this->Informacion_model->informacionesT();
        $vars['resultados'] = $datos_info;
        $data_com['com'] = $this->Egresos_model->get_comunidades();
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
        }else{
        $datos_info = $this->Informacion_model->informaciones($id_comunidad);
        $vars['resultados'] = $datos_info;
        $data_com['com'] = $this->Egresos_model->get_comunidades();
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);    
        }
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/informacion_view',$vars+$data_comunidades+$data_com);
        //$this->load->view('plantillas/footer');
    }

     //====== FUNCION PARA REGISTRAR NUEVAS COMUNIDADES =================
     public function registrar_informacion(){
 
        extract($_POST); 
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);

        
         $arrayData = array(
              'informacion'=>$informacion,
              'id_comunidad'=>$id_comunidad,
              'periodo'=>$periodo,
              'anio'=>$anio,
              'fecha_registro'=>$fecha_registro,
              'id_usuario'=>$id_usuario,               
        );
       $this->Informacion_model->registar_informacion($arrayData);
        
     }
     
     public function consultarInformacionId($id) {
        $datos = $this->Informacion_model->get_idInfo($id);

        echo json_encode($datos);
    }
    
    public function actualizar_informacion() {

        extract($_POST);

        $this->Informacion_model->modificar_informacion($id,$informacion,$estatus,$id_comunidad,$periodo,$anio);
    }  
    

}
