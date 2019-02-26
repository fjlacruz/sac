<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ingresos_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    public function registar_ingreso($array)
    {
        extract($array);
        $sql = "INSERT INTO t_ingresos (id_comunidad,     id_copropietario,          monto,     periodo,    anio,      id_forma_pago,   nro_documento   ,   fecha_ingreso,    fecha_registro,   adjunto ) 
                               VALUES ('{$id_comunidad}','{$id_copropietario}','{$monto}','{$periodo}','{$anio}','{$id_forma_pago}' ,'{$nro_documento}','{$fecha_ingreso}' ,'{$fecha_registro}' ,'{$adjunto}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function get_copropietarios($nro_dpto)
    {
        $query = $this->db->query("select id_copropietario,rut,nombres,apellidos,nro_dpto 
   FROM t_copropietarios where nro_dpto ='{$nro_dpto}'");
        
        return $query->result();
    }
    
    public function get_departamentos($id_comunidad)
    {
        $query = $this->db->query("select id_copropietario,nombres,apellidos,nro_dpto 
                FROM t_copropietarios where id_comunidad ='{$id_comunidad}'");
        return $query->result();
    }
    public function get_torres($id_comunidad)
    {
        $query = $this->db->query("select id_torre,nombre_torre FROM n_torres where id_comunidad ='{$id_comunidad}'");
        return $query->result();
    }
    
     public function get_torresT()
    {
        $query = $this->db->query("select id_torre,nombre_torre FROM n_torres");
        return $query->result();
    }
    
    public function get_departamentosT()
    {
        $query = $this->db->query("select id_copropietario,nombres,apellidos,nro_dpto 
                FROM t_copropietarios");
        return $query->result();
    }
     public function get_departamentos_torres($id_torre)
    {
        $query = $this->db->query("select id_copropietario,nombres,apellidos,nro_dpto,id_torre 
                FROM t_copropietarios where id_torre ='{$id_torre}'");
        return $query->result();
    }
     public function get_departamentos_torres2($id_torre)
    {
        $query = $this->db->query("select id_torre, nombre_torre
                FROM n_torres where id_torre ='{$id_torre}'");
        return $query->result();
    }
    public function ingresos_todos($id_comunidad)
    {
        $query = $this->db->query("select i.id_ingresos,i.id_comunidad,c.nombre_comunidad,i.id_copropietario,n.nombres,n.apellidos,co.nombres,co.apellidos,
               co.nro_dpto,i.monto,i.periodo,i.anio,
               i.id_forma_pago,f.descripcion,i.nro_documento,DATE_FORMAT(i.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso,
               DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.estatus
                
                FROM t_ingresos i 
                left join n_comunidad       c on (i.id_comunidad=c.id_comunidad)
                left join t_copropietarios co on (i.id_copropietario=co.id_copropietario)
                left join n_medio_pago      f on (i.id_forma_pago=f.id_forma_pago)
                left join t_copropietarios  n on (i.id_copropietario=n.id_copropietario)
                
                where i.id_comunidad='{$id_comunidad}'
                order by i.id_ingresos DESC");
        
        return $query->result();
    }
    public function ingresos_todosT()
    {
        $query = $this->db->query("select i.id_ingresos,i.id_comunidad,c.nombre_comunidad,i.id_copropietario,n.nombres,n.apellidos,co.nombres,co.apellidos,
               co.nro_dpto,i.monto,i.periodo,i.anio,
               i.id_forma_pago,f.descripcion,i.nro_documento,DATE_FORMAT(i.fecha_ingreso,'%d-%m-%Y') as fecha_ingreso,
               DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.estatus
                
                FROM t_ingresos i 
                left join n_comunidad       c on (i.id_comunidad=c.id_comunidad)
                left join t_copropietarios co on (i.id_copropietario=co.id_copropietario)
                left join n_medio_pago      f on (i.id_forma_pago=f.id_forma_pago)
                left join t_copropietarios  n on (i.id_copropietario=n.id_copropietario)

                order by i.id_ingresos DESC");
        
        return $query->result();
    }
    public function get_id($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select i.id_ingresos,i.id_comunidad,c.nombre_comunidad,i.id_copropietario,co.nombres,co.apellidos,
               co.nro_dpto,i.monto,i.periodo,i.anio,
               i.id_forma_pago,f.descripcion,i.nro_documento,i.fecha_ingreso,
               DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.estatus
                
                FROM t_ingresos i 
                left join n_comunidad       c on (i.id_comunidad=c.id_comunidad)
                left join t_copropietarios co on (i.id_copropietario=co.id_copropietario)
                left join n_medio_pago      f on (i.id_forma_pago=f.id_forma_pago)
                where id_ingresos = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    

    public function modificar_ingreso($param) {
        $campos = array(
            'id_copropietario' => $param['id_copropietario'],
            'monto' => $param['monto'],
            'periodo' => $param['periodo'],
            'anio' => $param['anio'],
            'id_forma_pago' => $param['id_forma_pago'],
            'nro_documento' => $param['nro_documento'],
            'fecha_ingreso' => $param['fecha_ingreso'],
            
        );

        $this->db->where('id_ingresos', $param['id']);
        $this->db->update('t_ingresos', $campos);

        $query = $this->db->query("select * from t_ingresos");

        return $query->result();
    }
    
     // ============== Funcion para consultar adjuntos==========================//
   public function getAdjuntoId($id_ingresos) 
   {
      return $this->db->where('id_ingresos',$id_ingresos)->get('t_ingresos')->row()->id_ingresos;
  } 
    // ============== Funcion para consultar adjuntos==========================//
  public function getAdjunto($id_ingresos) 
   {
      return $this->db->where('id_ingresos',$id_ingresos)->get('t_ingresos')->row()->adjunto;
  } 
  // ============== Funcion para modificar adjunto ==========================// 
 public function modificar_adjunto($id_ingresos,$adjunto) {

    $sql = "UPDATE  t_ingresos set adjunto = '{$adjunto}' where id_ingresos={$id_ingresos}";
    $query = $this->db->query( $sql );
       // return $query->result();          
}
public function delete_ingreso($id_ingresos)
	{
		$this->db->where('id_ingresos', $id_ingresos);
	
	    $this->db->delete('t_ingresos');
	}
	public function get_suma_ingresos_comunidad($id_comunidad){

     $query = $this->db-> query("SELECT SUM(monto) as monto from t_ingresos  where id_comunidad='{$id_comunidad}'");
       // si hay resultados
    return $query->result();
}

	public function get_suma_ingresos_comunidad_total(){

     $query = $this->db-> query("SELECT SUM(monto) as monto from t_ingresos");
       // si hay resultados
    return $query->result();
}

    
}
?>