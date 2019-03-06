<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bodega_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
   //================ Registro de datos en la tabla t_bodega ================================// 
    public function registar_bodega($array)
    {
        extract($array);
        $sql = "INSERT INTO t_bodega (descripcion_bodega,ubicacion_bodega ) VALUES ('{$descripcion_bodega}','{$ubicacion_bodega}')";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

//==================== Consulta de todas las bodegas ==============================================//
    public function bodegas_todas()
    {
        $query = $this->db->query("select id_bodega, descripcion_bodega, ubicacion_bodega, fecha_registro, case when estatus='1' then 'ACTIVO' else 'INACTIVO' end estatus from t_bodega");
        
        return $query->result();
    }
//============= delete de bodega ========================================================================//
      public function delete_bodega($id_bodega)
  {
    $this->db->where('id_bodega', $id_bodega);
  
      $this->db->delete('t_bodega');
  }
//================ Consultando los datos de una bodega por si id ======================================//
    public function get_id($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select id_bodega,descripcion_bodega, ubicacion_bodega, fecha_registro, estatus from t_bodega
                                      where id_bodega= '{$id}'");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
//========= funcion para modificar una bodega ========================================================//
    public function modificar_bodega($param) {
        $campos = array(
            'descripcion_bodega' => $param['descripcion_bodega'],
            'ubicacion_bodega'   => $param['ubicacion_bodega'],
            'estatus'            => $param['estatus'],      
        );

        $this->db->where('id_bodega', $param['id']);
        $this->db->update('t_bodega', $campos);

        $query = $this->db->query("select * from t_bodega");

        return $query->result();
    }
}
?>