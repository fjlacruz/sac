<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ingresos_extraordinarios extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pgsql');
        $this->load->model('Ingresos_extarordinarios_model');
        $this->load->model('Ingresos_model');
        $this->load->model('Egresos_model');
     
    }
    
    public function tabla() {
        $arrayData = array();
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
         if ($rol==1) {
       
        $data_cargos['cargos'] = $this->Ingresos_extarordinarios_model->get_cargos();
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentosT();
        $vars['resultados'] =  $this->Ingresos_extarordinarios_model->ingresos_extarordinarios_todosT();
        
         }else{
         
        $data_cargos['cargos'] = $this->Ingresos_extarordinarios_model->get_cargos();
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
        $vars['resultados'] =  $this->Ingresos_extarordinarios_model->ingresos_extarordinarios_todos($id_comunidad);    
         
         }
         
        $this->load->view('procesos/tabla_ing_extra', $data_cargos+$data_dpto+$vars );
    }

    public function ingresos_extraordinarios() {

        $arrayData = array();
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
       
        if ($rol==1) {
        $data_cargos['cargos'] = $this->Ingresos_extarordinarios_model->get_cargos();
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentosT();
        $vars['resultados'] =  $this->Ingresos_extarordinarios_model->ingresos_extarordinarios_todosT();
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
       
        }else{
        $data_cargos['cargos'] = $this->Ingresos_extarordinarios_model->get_cargos();
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
        $vars['resultados'] =  $this->Ingresos_extarordinarios_model->ingresos_extarordinarios_todos($id_comunidad);
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);  
        }

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_ingresos_extraordinarios', $data_cargos+$data_dpto+$vars+$data_comunidades );
        $this->load->view('plantillas/footer');

    }

     public function obtener_copropietario()
    {
        
        extract($_GET);
        
        $datos_copropietario = $this->Ingresos_model->get_copropietarios($nro_dpto);
        $combo = "<select name='copropietario' id='copropietario' class='form-control'>";
        
        foreach ($datos_copropietario as $copropietario) {
            $combo .= "<option value='" . $copropietario->id_copropietario . "'>$copropietario->nombres $copropietario->apellidos";
        }
        $combo .= "</select>";
        echo $combo;
    }
    
    public function obtener_monto()
    {
        
        extract($_GET);
        
        $datos_copropietario = $this->Ingresos_extarordinarios_model->get_montos($id_cargo_modal);
        $combo = "<select name='monto' id='monto' class='form-control'>";
        
        foreach ($datos_copropietario as $copropietario) {
            $combo .= "<option value='" . $copropietario->monto . "'>$copropietario->monto";
        }
        $combo .= "</select>";
        echo $combo;
    }
    
    //============== FUNCION QUE INSERTA LOS DATOS DEL INGRESO EN LA BASE DE DATOS ===============        
    public function registrar_ingreso_Ext()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $variablesSesion                 = $this->session->userdata('usuario');
        $id_usuario                    = ($variablesSesion['id_usuario']);
        
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        
        //$dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        //$adjunto     = base64_encode($dataAdjunto);
        
        $arrayData = array(
            'id_comunidad' => $id_comunidad,
            'id_copropietario' => $id_copropietario,
            'periodo' => $periodo,
            'anio' => $anio,
            'id_cargo' => $id_cargo,
            'id_forma_pago' => $id_forma_pago,
            'nro_documento' => $nro_documento,
            'fecha_ingreso' => $fecha_ingreso,
            'fecha_registro' => $fecha_registro,
            'id_usuario' => $id_usuario
            
            
        );
        $this->Ingresos_extarordinarios_model->registar_ingreso($arrayData);
        redirect('Ingresos_extraordinarios/ingresos_extraordinarios', 'refresh');
    }
    
    
 
    //============== FUNCION PARA CONSULTAR LOS DATOS DE INGRESO A EDITAR =============== 
    public function consultar_ingressos_id($id)
    {
        $data = $this->Ingresos_extarordinarios_model->get_id($id);
        
        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    
    //=========================== FUNCION PARA ACTUALIZAR UN INGRESO =================================================       
    public function actualizar_ingreso()
    {
        
        $param['id']               = $this->input->post('id');
        $param['id_comunidad']     = strtoupper($this->input->post('id_comunidad_modal'));
        $param['id_copropietario'] = strtoupper($this->input->post('id_copropietario_modal'));
        $param['periodo']          = strtoupper($this->input->post('periodo_modal'));
        $param['anio']             = strtoupper($this->input->post('anio_modal'));
        $param['id_forma_pago']    = $this->input->post('id_forma_pago_modal');
        $param['nro_documento']    = $this->input->post('nro_documento_modal');
        $param['fecha_ingreso']    = $this->input->post('fecha_ingreso_modal');
        
        $datos = $this->Ingresos_extarordinarios_model->modificar_ingreso($param);
        echo json_encode($datos);
        
    }
     
    
     public function eliminar_ingreso($id_ingreso_extraordinario)
	{
		$this->Ingresos_extarordinarios_model->delete_ingreso($id_ingreso_extraordinario);
		echo json_encode(array("status" => TRUE));
	}
    
}