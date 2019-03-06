<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Productos_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    //================== Inserta los datos en la tabala t_productos ==================================//
    public function registar_producto($array)
    {
        extract($array);
        $sql = "INSERT INTO t_productos (id_bodega,descripcion_producto,precio, stock ) 
                                 VALUES ('{$id_bodega}','{$descripcion_producto}','{$precio}','{$stock}')";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

 //======================= consulta de todos los productos ==================================================//
    public function productos_todos()
    {
        $query = $this->db->query("select p.id_producto,p.id_bodega,b.descripcion_bodega, p.descripcion_producto, p.precio,p.stock, p.fecha_registro, case when p.estatus='1' then 'ACTIVO' else 'INACTIVO' end estatus 
            from t_productos p
            left join t_bodega b on(b.id_bodega=p.id_bodega)
                 ");
        
        return $query->result();
    }

//========Consulta de bodegas para cargar el select Bodega =========================================================//
    public function get_bodegas()
    {
        $query = $this->db->query("select id_bodega, descripcion_bodega from t_bodega");    
        return $query->result();
    }
//=============== funcion para eliminar un producto segun su id =====================================================//
      public function delete_producto($id_producto)
  {
    $this->db->where('id_producto', $id_producto);
  
      $this->db->delete('t_productos');
  }

//==== Funcion para consultar los datos de un producto segun su id ==================================================//
    public function get_id($id = null)
    {      
    if (!is_null($id)) {
        $query = $this->db->query("select id_producto,id_bodega,descripcion_producto, precio,stock, fecha_registro, estatus from 
                                      t_productos
                                      where id_producto= '{$id}'");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
//======= Funcion para modificar un producto ===========================================//
    public function modificar_producto($param) {
        $campos = array(
            'id_bodega'            => $param['id_bodega'],
            'descripcion_producto' => $param['descripcion_producto'],
            'precio'               => $param['precio'],
            'stock'                => $param['stock'],
            'estatus'              => $param['estatus'],      
        );

        $this->db->where('id_producto', $param['id']);
        $this->db->update('t_productos', $campos);

        $query = $this->db->query("select * from t_productos");

        return $query->result();
    }
}
?>