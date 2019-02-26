<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MultasIntereses_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    
  public function get_fondosT()  
   {
      //return $this->db->get('t_egresos')->row()->estatus;
      $query = $this->db-> query("SELECT id_fondo,descripcion_fondo from n_fondo");
       // si hay resultados
    return $query->result();
  } 
   public function get_fondos($id_comunidad)  
   {
      //return $this->db->get('t_egresos')->row()->estatus;
      $query = $this->db-> query("SELECT id_fondo,descripcion_fondo from n_fondo where id_comunidad='{$id_comunidad}'");
       // si hay resultados
    return $query->result();
  } 
    public function registar_multa($array)
    {
        extract($array);
        $sql = "INSERT INTO t_multa_intereses (fecha_vencimiento,     proporcional_a_dias,     porcentaje,      descripcion,     id_fondo,      interes_simple,     id_comunidad ) 
                                     VALUES ('{$fecha_vencimiento}','{$proporcional_a_dias}','{$porcentaje}' ,'{$descripcion}','{$id_fondo}' ,'{$interes_simple}','{$id_comunidad}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
     public function multas_todos($id_comunidad) 
   {
      $query = $this->db->query
    ("SELECT m.id_multa,DATE_FORMAT(m.fecha_vencimiento,'%d-%m-%Y') as fecha_vencimiento,m.proporcional_a_dias,
             m.descripcion,m.id_fondo, f.descripcion_fondo,case when m.interes_simple=1 then 'SI' else 'NO' end interes_simple,
             m.id_comunidad, c.nombre_comunidad,m.porcentaje

                  from  t_multa_intereses m

                  left join n_fondo f on (m.id_fondo=f.id_fondo)
                  left join n_comunidad c on (m.id_comunidad=c.id_comunidad)
                  where c.id_comunidad='{$id_comunidad}' and c.estatus=1");
                  
      return $query->result();  
  }
   public function multas_todosT() 
   {
      $query = $this->db->query
    ("SELECT m.id_multa,DATE_FORMAT(m.fecha_vencimiento,'%d-%m-%Y') as fecha_vencimiento,m.proporcional_a_dias,
             m.descripcion,m.id_fondo, f.descripcion_fondo,case when m.interes_simple=1 then 'SI' else 'NO' end interes_simple,
             m.id_comunidad, c.nombre_comunidad,m.porcentaje

                  from  t_multa_intereses m

                  left join n_fondo f on (m.id_fondo=f.id_fondo)
                  left join n_comunidad c on (m.id_comunidad=c.id_comunidad)");
                  
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
            $query = $this->db->query("select m.id_multa,DATE_FORMAT(m.fecha_vencimiento,'%d-%m-%Y') as fecha_vencimiento,m.proporcional_a_dias,
             m.descripcion,m.id_fondo, f.descripcion_fondo,case when m.interes_simple=1 then 'SI' else 'NO' end interes_simple,
             m.id_comunidad, c.nombre_comunidad,m.porcentaje

                  from  t_multa_intereses m

                  left join n_fondo f on (m.id_fondo=f.id_fondo)
                  left join n_comunidad c on (m.id_comunidad=c.id_comunidad)
                  where id_multa = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    

    public function modificar_multa($param) {
        $campos = array(
            'fecha_vencimiento'   => $param['fecha_vencimiento'],
            'proporcional_a_dias' => $param['proporcional_a_dias'],
            'descripcion'         => $param['descripcion'],
            'id_fondo'            => $param['id_fondo'],
            'interes_simple'      => $param['interes_simple'],
            'porcentaje'          => $param['porcentaje'],
        );

        $this->db->where('id_multa', $param['id']);
        $this->db->update('t_multa_intereses', $campos);

        $query = $this->db->query("select * from t_multa_intereses");

        return $query->result();
    }
    

public function delete_multa($id_multa)
	{
		$this->db->where('id_multa', $id_multa);
	
	    $this->db->delete('t_multa_intereses');
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