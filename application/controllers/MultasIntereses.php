<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MultasIntereses extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pgsql');
        $this->load->model('Ingresos_extarordinarios_model');
        $this->load->model('Ingresos_model');
         $this->load->model('MultasIntereses_model');
        $this->load->model('Egresos_model');
     
    }
    
    public function tabla() {
        $arrayData = array();
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
         if ($rol==1) {
         $vars['resultados'] = $this->MultasIntereses_model->multas_todosT();
         }else{
         $vars['resultados'] = $this->MultasIntereses_model->multas_todos($id_comunidad);    
         }
         
        $this->load->view('procesos/tabla_mul',$vars );
    }

    public function multas() {

        $arrayData = array();
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
       
        if ($rol==1) {
        $data_fondos['fondos']           = $this->MultasIntereses_model->get_fondosT();
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
       
        }else{
        $data_fondos['fondos']           = $this->MultasIntereses_model->get_fondos($id_comunidad);
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);  
        }

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_multas',$data_comunidades+$data_fondos);
        $this->load->view('plantillas/footer');

    }
    
    //============== FUNCION QUE INSERTA LOS DATOS DEL INGRESO EN LA BASE DE DATOS ===============        
    public function registrar_multa()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $variablesSesion                 = $this->session->userdata('usuario');
        $id_usuario                    = ($variablesSesion['id_usuario']);
        
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        
        
        $arrayData = array(
            'fecha_vencimiento'  => $fecha_vencimiento,
            'proporcional_a_dias'=> $proporcional_a_dias,
            'porcentaje'         => $porcentaje,
            'descripcion'        => $descripcion,
            'id_fondo'           => $id_fondo,
            'interes_simple'     => $interes_simple,
            //'fecha_registro'     => $fecha_registro,
            'id_comunidad'       => $id_comunidad
   
        );
        $this->MultasIntereses_model->registar_multa($arrayData);
        //redirect(MultaIntereses/multas);
    }
    
    
 
    //============== FUNCION PARA CONSULTAR LOS DATOS DE INGRESO A EDITAR =============== 
    public function consultar_multas_id($id)
    {
        $data = $this->MultasIntereses_model->get_id($id);
        
        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    
    //=========================== FUNCION PARA ACTUALIZAR UN INGRESO =================================================       
    public function actualizar_multa()
    {
        
        $param['id']                  = $this->input->post('id');
        $param['fecha_vencimiento']   = strtoupper($this->input->post('fecha_vencimiento2'));
        $param['proporcional_a_dias'] = strtoupper($this->input->post('proporcional_a_dias'));
        $param['descripcion']         = strtoupper($this->input->post('descripcion'));
        $param['id_fondo']            = strtoupper($this->input->post('id_fondo'));
        $param['interes_simple']      = $this->input->post('interes_simple');
        $param['porcentaje']          = $this->input->post('porcentaje');
        
        $datos = $this->MultasIntereses_model->modificar_multa($param);
        echo json_encode($datos);
        
    }
     
    
     public function eliminar_multa($id_multa)
	{
		$this->MultasIntereses_model->delete_multa($id_multa);
		echo json_encode(array("status" => TRUE));
	}
    
}