<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct();
        $this->load->model('Productos_model');
    }

   
   //====== Funcion que muestra la vista principal de productos ===========================//
    public function inicio()
    {
        
        $arrayData = array();

         $data_bodegas['bodegas'] = $this->Productos_model->get_bodegas();

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_productos', $data_bodegas);
        $this->load->view('plantillas/footer');
    }
//====== funcion que carga los datos de los productos ===========================================//
    public function tabla()
    { 
        
        $arrayData          = array();
        $vars['resultados'] = $this->Productos_model->productos_todos();
        
        $this->load->view('procesos/tabla_prod', $vars );
    }
    
//================= Funcion para insertar los datos en tabla t_productos ======================//    
    public function registrar_producto()
    {        
        extract($_POST);

        $arrayData = array(
            'id_bodega' => $id_bodega,
            'descripcion_producto' => $descripcion_producto,
            'precio' => $precio,
            'stock' => $stock     
        );
        $this->Productos_model->registar_producto($arrayData);
    }
//============== Funcio para eliminar un producto segun su id ====================================//

    public function eliminar_producto($id_producto)
    {
        $this->Productos_model->delete_producto($id_producto);
        echo json_encode(array("status" => TRUE));
    }
//======== Funcion que consulta todos los datos de los productos segun su id ============================//
    public function consultar_producto_id($id)
    {
        $data = $this->Productos_model->get_id($id);
        
        echo json_encode($data);
    }
//================= Funcion para editar productos ============================================//
    public function actualizar_producto()
    {  
        $param['id']               = $this->input->post('id');
        $param['id_bodega'] = strtoupper($this->input->post('id_bodega'));
        $param['descripcion_producto']     = strtoupper($this->input->post('descripcion_producto'));
        $param['precio'] = strtoupper($this->input->post('precio'));
        $param['stock'] = strtoupper($this->input->post('stock'));
        $param['estatus']            = $this->input->post('estatus');
        
        $datos = $this->Productos_model->modificar_producto($param);
        echo json_encode($datos);
        
    }   
    
}