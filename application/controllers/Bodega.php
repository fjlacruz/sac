<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bodega extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bodega_model');
    }
    
//====================== Carga inicial de la vista de bodegas ========================//
    public function inicio()
    {
        
        $arrayData = array();

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_bodega');
        $this->load->view('plantillas/footer');
    }
//======================= Funcion que carga la tabla de datos de las bodegas ============//
    public function tabla()
    {     
        $arrayData          = array();
        $vars['resultados'] = $this->Bodega_model->bodegas_todas();
        
        $this->load->view('procesos/tabla_bod', $vars);
    }
//=============== Funcion para registrar bodegas ======================================//    
    public function registrar_bodega()
    {        
        extract($_POST);

        $arrayData = array(
            'descripcion_bodega' => strtoupper($descripcion_bodega),
            'ubicacion_bodega' => strtoupper($ubicacion_bodega)     
        );
        $this->Bodega_model->registar_bodega($arrayData);
    }
//=============== Funcion para elinar una bodegas ======================================//
    public function eliminar_bodega($id_bodega)
    {
        $this->Bodega_model->delete_bodega($id_bodega);
        echo json_encode(array("status" => TRUE));
    }
    
//=============== Funcion para consultar todos los datos de una bodegas ================// 
    public function consultar_bodega_id($id)
    {
        $data = $this->Bodega_model->get_id($id);
        
        echo json_encode($data);
    }
//=============== Funcion para actualizar bodegas ======================================//    
    public function actualizar_bodega()
    {
        
        $param['id']               = $this->input->post('id');
        $param['descripcion_bodega']     = strtoupper($this->input->post('descripcion_bodega'));
        $param['ubicacion_bodega'] = strtoupper($this->input->post('ubicacion_bodega'));
        $param['estatus']            = $this->input->post('estatus');
        
        $datos = $this->Bodega_model->modificar_bodega($param);
        echo json_encode($datos);
        
    }   
    
}