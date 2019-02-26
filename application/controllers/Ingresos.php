<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ingresos extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Ingresos_model');
        $this->load->model('Egresos_model');
        $this->load->library('parser');
    }
    
    //====== TABLA DE INGRESOS QUE SE MONTA SOBRE LA VISTA DE LA FUNCION INGRESOS ====================       
    public function tabla()
    { 
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData          = array();
        
        if ($rol == 1) {
        $vars['resultados'] = $this->Ingresos_model->ingresos_todosT();
        
        
        }else{
            
        $vars['resultados'] = $this->Ingresos_model->ingresos_todos($id_comunidad);   
        }
        $this->load->view('procesos/tabla_ing', $vars);
    }
    //=========================== FUNCION PARA LA VISTA DE INGRESOS =================================================       
    public function ingresos()
    {
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData = array();
        
        if ($rol == 1) {
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentosT();
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
        }else{
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);    
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_ingresos', $data_comunidades + $data_dpto);
        $this->load->view('plantillas/footer');
    }
    
    
    //============== FUNCION QUE INSERTA LOS DATOS DEL INGRESO EN LA BASE DE DATOS ===============        
    public function registrar_ingreso()
    {
        
        extract($_POST);
        extract($_FILES);
        
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);
        
        $arrayData = array(
            'id_comunidad' => $id_comunidad,
            'id_copropietario' => $id_copropietario,
            'monto' => $monto,
            'periodo' => $periodo,
            'anio' => $anio,
            'id_forma_pago' => $id_forma_pago,
            'nro_documento' => $nro_documento,
            'fecha_ingreso' => $fecha_ingreso,
            'fecha_registro' => $fecha_registro,
            'adjunto' => $adjunto
            
        );
        $this->Ingresos_model->registar_ingreso($arrayData);
        redirect('ingresos/ingresos', 'refresh');
    }
    
    
    //============== FUNCION QUE CARGAR EL SELECT CON LOS COPROPIETARIOS =============== 
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
    
    //============== FUNCION PARA CONSULTAR LOS DATOS DE INGRESO A EDITAR =========================================== 
    public function consultar_ingressos_id($id)
    {
        $data = $this->Ingresos_model->get_id($id);
        
        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    
    //=========================== FUNCION PARA ACTUALIZAR UN INGRESO =================================================       
    public function actualizar_ingreso()
    {
        
        $param['id']               = $this->input->post('id');
        $param['id_comunidad']     = strtoupper($this->input->post('id_comunidad_modal'));
        $param['id_copropietario'] = strtoupper($this->input->post('id_copropietario_modal'));
        $param['monto']            = $this->input->post('monto_modal');
        $param['periodo']          = strtoupper($this->input->post('periodo_modal'));
        $param['anio']             = strtoupper($this->input->post('anio_modal'));
        $param['id_forma_pago']    = $this->input->post('id_forma_pago_modal');
        $param['nro_documento']    = $this->input->post('nro_documento_modal');
        $param['fecha_ingreso']    = $this->input->post('fecha_ingreso_modal');
        
        $datos = $this->Ingresos_model->modificar_ingreso($param);
        echo json_encode($datos);
        
    }
     
     
     public function verAdjunto($id_ingreso) // se coloca el id para la configuracion de la ruta/////////
    {
        
        extract($_GET);
        
        $adjunto              = $this->Ingresos_model->getAdjunto($id_ingreso);
        //print_r($adjunto);
        $adjuntoId['id_egre'] = $this->Ingresos_model->getAdjuntoId($id_ingreso);
         //print_r($adjuntoId);
         //exit;
        file_put_contents('adjuntos.pdf', $adjunto);
        
        file_put_contents('adjuntos.pdf', $adjunto);
        //echo '<img width="500" height="500" src="data:image/pdf;base64,' .$adjunto. '"/>';
        $datos['datos'] = '<img width="500" height="500" src="data:image/jpg;base64,' . $adjunto . '"/>';
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/adjunto_ingreso_view', $datos + $adjuntoId);
        
    }
    
     //====== FUNCION PARA REGISTRAR EGRESOS =================
    public function actualizar_adjunto()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);
        
        $this->Ingresos_model->modificar_adjunto($id_ingreso, $adjunto);
        
        redirect('ingresos/ingresos', 'refresh');
        
    }
    public function eliminar_ingreso($id_ingresos)
	{
		$this->Ingresos_model->delete_ingreso($id_ingresos);
		echo json_encode(array("status" => TRUE));
	}

    
}