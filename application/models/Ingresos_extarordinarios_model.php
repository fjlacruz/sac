<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ingresos_extarordinarios_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
     public function get_cargos()  
   {
      //return $this->db->get('t_egresos')->row()->estatus;
      $query = $this->db-> query("SELECT id_cargo,descripcion, monto from t_cargos");
       // si hay resultados
    return $query->result();
  } 
    public function registar_ingreso($array)
    {
        extract($array);
        $sql = "INSERT INTO t_ingresos_extra (id_cargo,     id_comunidad,      id_copropietario,           periodo,    anio,       nro_documento   ,   fecha_ingreso,    fecha_registro,    id_forma_pago, id_usuario ) 
                                     VALUES ('{$id_cargo}','{$id_comunidad}','{$id_copropietario}' ,'{$periodo}','{$anio}' ,'{$nro_documento}','{$fecha_ingreso}' ,'{$fecha_registro}' ,'{$id_forma_pago}' ,'{$id_usuario}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
     public function ingresos_extarordinarios_todos($id_comunidad) 
   {
      $query = $this->db->query
    ("SELECT e.id_ingreso_extraordinario, e.id_comunidad,u.nombre_comunidad, e.id_cargo, c.descripcion as descripcion_cargo, 
             c.monto,e.id_copropietario,
             co.rut,co.nombres,co.apellidos,co.nro_dpto, e.periodo, e.anio,e.fecha_registro, e.id_usuario,
             case when e.estatus= 1 then 'ACTIVO' else 'INACTIVO' end estatus, e.fecha_registro, e.fecha_ingreso,
               DATE_FORMAT(e.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso, e.id_forma_pago,e.nro_documento

                  from t_ingresos_extra e

                  left join t_cargos c on (e.id_cargo=c.id_cargo)
                  left join t_copropietarios co on (e.id_copropietario=co.id_copropietario)
                  left join n_comunidad u on (e.id_comunidad=u.id_comunidad)
                  where e.id_comunidad='{$id_comunidad}' and e.estatus=1
              
                  order by id_ingreso_extraordinario asc");
                  
      return $query->result();  
  }
   public function ingresos_extarordinarios_todosT() 
   {
      $query = $this->db->query
    ("SELECT e.id_ingreso_extraordinario, e.id_comunidad,u.nombre_comunidad, e.id_cargo, c.descripcion as descripcion_cargo, 
             c.monto,e.id_copropietario,
             co.rut,co.nombres,co.apellidos,co.nro_dpto, e.periodo, e.anio,e.fecha_registro, e.id_usuario,
             case when e.estatus= 1 then 'ACTIVO' else 'INACTIVO' end estatus, e.fecha_registro, e.fecha_ingreso,
               DATE_FORMAT(e.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso, e.id_forma_pago,e.nro_documento

                  from t_ingresos_extra e

                  left join t_cargos c on (e.id_cargo=c.id_cargo)
                  left join t_copropietarios co on (e.id_copropietario=co.id_copropietario)
                  left join n_comunidad u on (e.id_comunidad=u.id_comunidad)

                  order by id_ingreso_extraordinario asc");
                  
      return $query->result();  
  }
    
    public function get_montos($id_cargo_modal)
    {
        $query = $this->db->query("select monto 
   FROM  t_cargos where id_cargo ='{$id_cargo_modal}'");
        
        return $query->result();
    } 
    
    public function get_id($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("SELECT e.id_ingreso_extraordinario, e.id_comunidad,u.nombre_comunidad, e.id_cargo, c.descripcion as descripcion_cargo, e.id_copropietario,
             co.rut,co.nombres,co.apellidos,co.nro_dpto,c.monto, e.periodo, e.anio,e.fecha_registro, e.id_usuario,
             case when e.estatus= 1 then 'ACTIVO' else 'INACTIVO' end estatus, e.fecha_registro, e.fecha_ingreso,
               e.id_forma_pago,e.nro_documento

                  from t_ingresos_extra e

                  left join t_cargos c on (e.id_cargo=c.id_cargo)
                  left join t_copropietarios co on (e.id_copropietario=co.id_copropietario)
                  left join n_comunidad u on (e.id_comunidad=u.id_comunidad)
                  where id_ingreso_extraordinario = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    

    public function modificar_ingreso($param) {
        $campos = array(
            'id_copropietario' => $param['id_copropietario'],
            'periodo' => $param['periodo'],
            'anio' => $param['anio'],
            'id_forma_pago' => $param['id_forma_pago'],
            'nro_documento' => $param['nro_documento'],
            'fecha_ingreso' => $param['fecha_ingreso'],
        );

        $this->db->where('id_ingreso_extraordinario', $param['id']);
        $this->db->update('t_ingresos_extra', $campos);

        $query = $this->db->query("select * from t_ingresos_extra");

        return $query->result();
    }
    

public function delete_ingreso($id_ingreso_extraordinario)
	{
		$this->db->where('id_ingreso_extraordinario', $id_ingreso_extraordinario);
	
	    $this->db->delete('t_ingresos_extra');
	}
	 
	 public function get_suma_ingresos_comunidadE($id_comunidad){

     $query = $this->db-> query("select  SUM(c.monto) as monto 
                                 from t_ingresos_extra e
                                 left join  t_cargos c on (e.id_cargo=c.id_cargo) 
                                 where e.id_comunidad='{$id_comunidad}'");
       // si hay resultados
    return $query->result();
}
public function get_suma_ingresos_comunidad_totalE(){

     $query = $this->db-> query("select  SUM(c.monto) as monto 
                                 from t_ingresos_extra e
                                 left join  t_cargos c on (e.id_cargo=c.id_cargo) 
                                ");
       // si hay resultados
    return $query->result();
}

    
}
?>