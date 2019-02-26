<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Informacion_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	

        
  public function registar_informacion($array){
    extract($array);
    $sql = "INSERT INTO t_informacion (informacion,fecha_registro,id_usuario,id_comunidad,periodo,anio) 
                          VALUES ('{$informacion}','{$fecha_registro}','{$id_usuario}','{$id_comunidad}','{$periodo}','{$anio}')";
    $this->db->query($sql);
    //return 1;
    if ($this->db->affected_rows() > 0) {
      return 1;
    }
    else{
      return 0;
    }
} 

 public function informaciones($id_comunidad) 
   {
      $query = $this->db->query
              ("select i.id_info, i.informacion,i.id_comunidad,c.nombre_comunidad,i.periodo,
                i.anio, DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.id_usuario,
                i.estatus
                
                FROM t_informacion i 
                left join n_comunidad c on (i.id_comunidad=c.id_comunidad)
                
                where i.estatus=1 and i.id_comunidad='{$id_comunidad}'");
      return $query->result();  
  }
  
  public function informacionesT() 
   {
      $query = $this->db->query
              ("select i.id_info, i.informacion,i.id_comunidad,c.nombre_comunidad,i.periodo,
                i.anio, DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.id_usuario,
                i.estatus
                
                FROM t_informacion i 
                left join n_comunidad c on (i.id_comunidad=c.id_comunidad)
                
                ");
      return $query->result();  
  }
  
  public function informacion_comunidad($id_comunidad,$periodo,$anio) 
   {
      $query = $this->db->query
              ("select i.id_info, i.informacion,i.id_comunidad,c.nombre_comunidad,i.periodo,
                i.anio, DATE_FORMAT(i.fecha_registro,'%d-%m-%Y') as fecha_registro,i.id_usuario,
                i.estatus
                
                FROM t_informacion i 
                left join n_comunidad c on (i.id_comunidad=c.id_comunidad)
                
                where i.estatus=1 and i.id_comunidad='{$id_comunidad}' and i.periodo='{$periodo}' and i.anio='{$anio}'
                order by i.id_info DESC");
      return $query->result();  
  }
  
   public function get_idInfo($id = null) {

        if (!is_null($id)) {
            $query = $this->db->query("select * from t_informacion where id_info = '{$id}' ");
            

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
  
 public function modificar_informacion($id,$informacion,$estatus,$id_comunidad,$periodo,$anio) {
       // extract($$arrayData2);
    $sql = "UPDATE t_informacion set informacion = '{$informacion}',
                                         estatus = '{$estatus}',
                                         id_comunidad = '{$id_comunidad}',
                                         periodo = '{$periodo}',
                                         anio = '{$anio}'
                                  where id_info = {$id}";
    $query = $this->db->query( $sql );
       // return $query->result();          
} 
  
  
  
 
 
 
 
 
 
 
  
   // ============== Funcion para consultar adjuntos==========================//
 public function getAdjuntoId($id_egreso) 
   {
      return $this->db->where('id_egreso',$id_egreso)->get('t_egresos')->row()->id_egreso;
  } 
    // ============== Funcion para consultar adjuntos==========================//
 public function getAdjuntoId2($id_egreso) 
   {
      $query = $this->db->query
              ("SELECT id_egreso from t_egresos where id_egreso={$id_egreso}");
      return $query->result(); 
  } 
 // ============== Funcion para modificar adjunto ==========================// 
 public function modificar_adjunto($id_egreso,$adjunto) {
       // extract($$arrayData2);
    $sql = "UPDATE  t_egresos set adjunto = '{$adjunto}' where id_egreso={$id_egreso}";
    $query = $this->db->query( $sql );
       // return $query->result();          
}

}
?>