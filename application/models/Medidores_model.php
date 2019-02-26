<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medidores_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function registar_medidor($array)
    {
        extract($array);
        $sql = "INSERT INTO t_medidores ( id_comunidad,      nombre_medidor,    vigente,     obligatorio,     fecha_registro,     porcentaje,    id_proveedor ) 
                               VALUES ('{$id_comunidad}','{$nombre_medidor}','{$vigente}','{$obligatorio}','{$fecha_registro}','{$porcentaje}','{$id_proveedor}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function medidores_todos($id_comunidad)
    {
        $query = $this->db->query("SELECT m.id_medidor,m.nombre_medidor,case when m.vigente=1 then 'VIGENTE' else 'NO VIGENTE' end vigente,
                                   case when m.obligatorio=1 then 'SI' else 'NO' end obligatorio,DATE_FORMAT(m.fecha_registro,'%d-%m-%Y') as fecha_registro,
                                   m.orden,m.id_comunidad,c.nombre_comunidad,m.porcentaje,m.id_proveedor, p.proveedor
                                   from t_medidores m
                                   left join n_comunidad c on (m.id_comunidad=c.id_comunidad)
                                   left join  n_proveedor p on (m.id_proveedor=p.id_proveedor)
                                   where m.id_comunidad='{$id_comunidad}'
                                   order by m.id_medidor DESC");
        
        return $query->result();
    }
    
    public function medidores_todosT()
    {
        $query = $this->db->query("SELECT m.id_medidor,m.nombre_medidor,case when m.vigente=1 then 'VIGENTE' else 'NO VIGENTE' end vigente,
                                   case when m.obligatorio=1 then 'SI' else 'NO' end obligatorio,DATE_FORMAT(m.fecha_registro,'%d-%m-%Y') as fecha_registro,
                                   m.orden,m.id_comunidad,c.nombre_comunidad,m.porcentaje,m.id_proveedor, p.proveedor
                                   from t_medidores m
                                   left join n_comunidad c on (m.id_comunidad=c.id_comunidad)
                                   left join  n_proveedor p on (m.id_proveedor=p.id_proveedor)
                                   ");
        
        return $query->result();
    }
    
    public function get_id($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("SELECT m.id_medidor,m.nombre_medidor,m.vigente as vgt,case when m.vigente=1 then 'VIGENTE' else 'NO VIGENTE' end vigente ,m.obligatorio,
                                   m.obligatorio as obl,
                                   case when m.obligatorio=1 then 'SI' else 'NO' end obligatorio,DATE_FORMAT(m.fecha_registro,'%d-%m-%Y') as fecha_registro,
                                   m.orden,m.id_comunidad,c.nombre_comunidad,m.porcentaje,m.id_proveedor,p.proveedor
                                   from t_medidores m
                                   left join n_comunidad c on (m.id_comunidad=c.id_comunidad)
                                   left join n_proveedor p on (m.id_proveedor=p.id_proveedor)
                                   where m.id_medidor = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    public function get_idLectura($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("SELECT l.id_lectura,l.nro_dpto,c.id_comunidad,l.lectura_anterior,
                                   l.lectura_actual,l.periodo,l.anio,DATE_FORMAT(l.fecha_registro,'%d-%m-%Y') as fecha_registro,c.nombre_comunidad,l.id_medidor
                                   FROM  t_lectura_medidor l 
                                   left join n_comunidad c on (l.id_comunidad=c.id_comunidad)
                                  
                                   where l.id_lectura = '{$id}' 
            ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    public function modificar_medidor($param)
    {
        $campos = array(
            'id_comunidad' => $param['id_comunidad'],
            'nombre_medidor' => $param['nombre_medidor'],
            'vigente' => $param['vigente'],
            'obligatorio' => $param['obligatorio'],
            'porcentaje' => $param['porcentaje'],
            'id_proveedor' => $param['id_proveedor']
        );
        
        $this->db->where('id_medidor', $param['id']);
        $this->db->update('t_medidores', $campos);
        
        $query = $this->db->query("select * from t_medidores");
        
        return $query->result();
    }
    
    public function modificar_lectura($param)
    {
        $campos = array(
            'lectura_anterior' => $param['lectura_anterior'],
            'lectura_actual' => $param['lectura_actual'],
            'periodo' => $param['periodo'],
            'anio' => $param['anio']
        );
        
        $this->db->where('id_lectura', $param['id']);
        $this->db->update('t_lectura_medidor', $campos);
        
        $query = $this->db->query("select * from t_medidores");
        
        return $query->result();
    }
    
    public function delete_medidor($id_medidor)
    {
        $this->db->where('id_medidor', $id_medidor);
        
        $this->db->delete('t_medidores');
    }
    
    public function delete_medidort()
    {
       
        $this->db->where('nro_dpto', 't');
        
        $this->db->delete('t_lectura_medidor');
    }
   
    public function delete_duplicados()
    {
       
        $query = $this->db->query("DELETE n1 FROM t_lectura_medidor n1, t_lectura_medidor n2
                                   WHERE n1.nro_dpto = n2.nro_dpto and
                                   n1.periodo =n2.periodo and
                                   n1.anio =n2.anio and
                                   n1.id_medidor=n2.id_medidor and
                                   n1.id_comunidad =n2.id_comunidad and
                                   n1.id_torre=n2.id_torre and
                                   n1.id_medidor =n2.id_medidor
                                   AND n1.id_lectura > n2.id_lectura;");

    }
    
    public function delete_lecturar($id_lectura)
    {
        $this->db->where('id_lectura', $id_lectura);
        
        $this->db->delete('t_lectura_medidor');
    }
    
    public function delete_lectura($id)
    {
        $this->db->where('id_lectura', $id);
        
        $this->db->delete('t_lectura_medidor');
    }
    
    public function cantidad_medidoresT()
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM t_medidores");
        // si hay resultados
        return $query->result();
    }
    
    public function cantidad_medidores($id_comunidad)
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM t_medidores where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    
    public function registar_asignacion($array)
    {
        extract($array);
        $sql = "INSERT INTO t_asignacion_medidores (id_medidor,  id_comunidad,     nro_dpto,     fecha_registro ) 
                                            VALUES ( '{$id}',  '{$id_comunidad}','{$nro_dpto}','{$fecha_registro}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function registar_lectura($array)
    {
        extract($array);
        $sql = "INSERT INTO t_lectura_medidor(   id_medidor,     id_torre,  nro_dpto,     id_comunidad,     periodo,     anio,     lectura_anterior,     lectura_actual,    fecha_registro ) 
                                      VALUES ( '{$id_medidor}','{$id_torre}','{$nro_dpto}','{$id_comunidad}','{$periodo}','{$anio}','{$lectura_anterior}','{$lectura_actual}','{$fecha_registro}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
     public function registar_lectura2($array)
    {
        extract($array);
        $sql = "INSERT INTO t_lectura_medidor(   id_medidor,     id_torre,  nro_dpto,     id_comunidad,     periodo,     anio,     lectura_anterior,     lectura_actual ) 
                                      VALUES ( '{$id_medidor}','{$id_torre}','{$nro_dpto}','{$id_comunidad}','{$periodo}','{$anio}','{$lectura_anterior}','{$lectura_actual}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function consulta_lectura_medidorT()
    {
        
        $query = $this->db->query("SELECT l.id_lectura,l.nro_dpto,c.id_comunidad,l.lectura_anterior,
                                   l.lectura_actual,l.periodo,l.anio,DATE_FORMAT(l.fecha_registro,'%d-%m-%Y') as fecha_registro,c.nombre_comunidad,
                                   (l.lectura_actual)-(l.lectura_anterior) as consumo,l.id_medidor, m.nombre_medidor
                                   FROM  t_lectura_medidor l 
                                   left join t_medidores m on (l.id_medidor= m.id_medidor)
                                   left join n_comunidad c on (l.id_comunidad=c.id_comunidad)
                                   
                                   where l.nro_dpto <> 't'");
        // si hay resultados
        return $query->result();
    }
    
    public function consulta_lectura_medidor($id_comunidad)
    {
        
        $query = $this->db->query("SELECT l.id_lectura,l.nro_dpto,c.id_comunidad,l.lectura_anterior,
                                   l.lectura_actual,l.periodo,l.anio,DATE_FORMAT(l.fecha_registro,'%d-%m-%Y') as fecha_registro,c.nombre_comunidad,
                                   (l.lectura_actual)-(l.lectura_anterior) as consumo,l.id_medidor, m.nombre_medidor
                                   FROM  t_lectura_medidor l 
                                   left join n_comunidad c on (l.id_comunidad=c.id_comunidad)
                                   left join t_medidores m on (l.id_medidor= m.id_medidor)
                                   where l.id_comunidad='{$id_comunidad}' and l.nro_dpto <> 't'");
        // si hay resultados
        return $query->result();
    }
    
    public function consulta_lectura_medidor_comunidad($id_comunidad, $Id, $id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("select l.id_lectura,l.nro_dpto,l.id_comunidad,l.lectura_anterior,
                                   l.lectura_actual,l.periodo,l.anio,DATE_FORMAT(l.fecha_registro,'%d-%m-%Y') as fecha_registro,
                                   (l.lectura_actual)-(l.lectura_anterior) as consumo,
                                   l.id_medidor,l.id_torre, ((lectura_actual-lectura_anterior)*

(((select SUM(monto) as monto from t_egresos where id_comunidad='{$id_comunidad}' and periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}')*
(select porcentaje from t_medidores where id_comunidad='{$id_comunidad}' and nombre_medidor='{$id_medidor}'))/100) /
                                (SELECT (SUM(lectura_actual) - SUM(lectura_anterior)) as consumo FROM  t_lectura_medidor l  where id_comunidad='{$Id}' and id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}'))as pago

 FROM  t_lectura_medidor l
where l.id_comunidad='{$Id}' and l.id_medidor='{$id_medidor}' and l.periodo='{$periodo}' and l.anio='{$anio}' and l.nro_dpto <> 't' and lectura_anterior<>'NULL' and lectura_actual<>'NULL'");
        // si hay resultados
        return $query->result();
    }
    
    
    public function consulta_lectura_medidor_comunidad2($id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("select l.id_lectura,l.nro_dpto,l.id_comunidad,l.lectura_anterior,
                                   l.lectura_actual,l.periodo,l.anio,DATE_FORMAT(l.fecha_registro,'%d-%m-%Y') as fecha_registro,
                                   (l.lectura_actual)-(l.lectura_anterior) as consumo,
                                   l.id_medidor,l.id_torre,
 ((lectura_actual-lectura_anterior)*(SELECT(select SUM(monto) as monto from t_egresos where periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}') /(SELECT (SUM(lectura_actual) - SUM(lectura_anterior))  FROM  t_lectura_medidor  where  id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}')))as pago from t_lectura_medidor l
 left join n_torres t on (t.id_torre= l.id_torre)
 where l.id_medidor='{$id_medidor}' and l.periodo='{$periodo}' and l.anio='{$anio}' and l.nro_dpto <> 't'");
        // si hay resultados
        return $query->result();
    }
    
    
    public function consumo_medidor($Id, $id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT (SUM(lectura_actual) - SUM(lectura_anterior)) as consumo
                                   FROM  t_lectura_medidor 
                                   where id_comunidad='{$Id}' and id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}'");
        // si hay resultados
        return $query->result();
    }
    
    
    public function consumo_medidorT($id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT (SUM(lectura_actual) - SUM(lectura_anterior)) as consumo
                                   FROM  t_lectura_medidor 
                                   where id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}'");
        // si hay resultados
        return $query->result();
    }
    
    
    public function get_m3($Id, $id_comunidad, $id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT(((select SUM(monto) as monto from t_egresos where id_comunidad='{$id_comunidad}' and periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}')*
(select porcentaje from t_medidores where id_comunidad='{$id_comunidad}' and nombre_medidor='{$id_medidor}'))/100) /
                                (SELECT (SUM(lectura_actual) - SUM(lectura_anterior)) as consumo FROM  t_lectura_medidor  where id_comunidad='{$Id}' and id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}')as m3");
        // si hay resultados
        return $query->result();
    }
    
    
    public function get_m3T($id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT(((select SUM(monto) as monto from t_egresos where  periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}')*
                                          (select porcentaje from t_medidores where  nombre_medidor='{$id_medidor}'))/100) /
                                         (SELECT (SUM(lectura_actual) - SUM(lectura_anterior)) as consumo FROM  t_lectura_medidor  where id_medidor='{$id_medidor}' and periodo='{$periodo}' and anio='{$anio}')as m3");
        // si hay resultados
        return $query->result();
    }
    
    
    public function get_monto_factura_porcentaje($id_comunidad, $id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT(((select SUM(monto) as monto from t_egresos where id_comunidad='{$id_comunidad}' and periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}')*
(select porcentaje from t_medidores where id_comunidad='{$id_comunidad}' and nombre_medidor='{$id_medidor}'))/100)as porcentaje");
        // si hay resultados
        return $query->result();
    }
    
    
    public function get_monto_factura_porcentajeT($id_medidor, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT(((select SUM(monto) as monto from t_egresos where  periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}')*
(select porcentaje from t_medidores where nombre_medidor='{$id_medidor}'))/100)as porcentaje");
        // si hay resultados
        return $query->result();
    }
    
    public function upd_lectura($param)
    {
        $campos = array(
            'lectura_anterior' => $param['lectura_anterior'],
            'lectura_actual' => $param['lectura_actual'],
            'fecha_registro' => $param['fecha_registro']
        );
        
        $this->db->where('id_asignacion_medidor', $param['id']);
        $this->db->update('t_asignacion_medidores', $campos);
        
        $query = $this->db->query("select * from t_asignacion_medidores");
        
        return $query->result();
    }
    
    public function verificar_estatusT()
    {
        
        $query = $this->db->query("SELECT estatus FROM t_asignacion_medidores");
        // si hay resultados
        return $query->result();
    }
    
    public function verificar_periodo1($nro_dpto)
    {
        
        $query = $this->db->query("SELECT periodo from t_lectura_medidor where nro_dpto='{$nro_dpto}'");
        // si hay resultados
        return $query->result();
    }
    public function consumo_aguacalienteT()
    {
        
        $query = $this->db->query("SELECT estatus FROM t_asignacion_medidores");
        // si hay resultados
        return $query->result();
    }
    public function carga_masiva($id_comunidad,$id_torre)
    {
        //extract($id_comunidad);
        $sql = "INSERT INTO t_lectura_medidor (nro_dpto,id_comunidad,id_torre)
                                               SELECT c.nro_dpto,co.nombre_comunidad,t.nombre_torre
                                               FROM t_copropietarios c 
                                               left join n_comunidad co on (c.id_comunidad=co.id_comunidad)
                                               left join n_torres t on (t.id_torre=c.id_torre)
                                               where c.id_comunidad='{$id_comunidad}' and c.id_torre='{$id_torre}'";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function carga_masiva2($id_comunidad,$id_torre,$todos)
    {
        //extract($id_comunidad);
        $sql = "INSERT INTO t_lectura_medidor (nro_dpto,id_comunidad,id_torre)
                                               SELECT c.nro_dpto,co.nombre_comunidad,t.nombre_torre
                                               FROM t_copropietarios c 
                                               left join n_comunidad co on (c.id_comunidad=co.id_comunidad)
                                               left join n_torres t on (t.id_torre=c.id_torre)
                                               where c.id_comunidad='{$id_comunidad}' and c.id_torre='{$id_torre}' and  c.nro_dpto='{$todos}'";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function upd_medidor($comunidad,$torre,$medidor,$periodo,$anio)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  t_lectura_medidor set periodo='{$periodo}', anio='{$anio}', id_medidor='{$medidor}'
                where id_comunidad='{$comunidad}' and id_torre='{$torre}' and periodo=0 and anio=0";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    
    public function get_medidores($id_comunidad)
    {
        $query = $this->db->query("select id_medidor, nombre_medidor from t_medidores where id_comunidad='{$id_comunidad}' ");
        return $query->result();
    }
    
    public function get_monto_factura($id_comunidad, $id_medidor, $periodo, $anio)
    {
        $query = $this->db->query("select SUM(monto) as monto from t_egresos where id_comunidad='{$id_comunidad}' and periodo='{$periodo}' and id_medidor='{$id_medidor}' and anio='{$anio}'");
        return $query->result();
    }
    
    public function get_medidoresT()
    {
        $query = $this->db->query("select id_medidor, nombre_medidor from t_medidores");
        return $query->result();
    }
    
    function insertRecord($record)
    {
        
        $newuser = array(
            "nro_dpto" => trim($record[0]),
            "periodo" => trim($record[1]),
            "anio" => trim($record[2]),
            "lectura_anterior" => trim($record[3]),
            "lectura_actual" => trim($record[4]),
            "id_medidor" => trim($record[5]),
            "id_comunidad" => trim($record[6]),
            "id_torre" => trim($record[7])
        );
        
        $this->db->insert('t_lectura_medidor', $newuser);
        
        
    }
    
    function insertRecord1($record)
    {
        
        if (count($record) > 0) {
            
            // Check user
            $this->db->select('*');
            $this->db->where('nro_dpto', $record[0]);
            $q        = $this->db->get('t_lectura_medidor');
            $response = $q->result_array();
            
            // Insert record
            if (count($response) == 0) {
                $newuser = array(
                    "nro_dpto" => trim($record[0]),
                    "periodo" => trim($record[1]),
                    "anio" => trim($record[2]),
                    "lectura_anterior" => trim($record[3]),
                    "lectura_actual" => trim($record[4]),
                    "id_medidor" => trim($record[5]),
                    "id_comunidad" => trim($record[6]),
                    "id_torre" => trim($record[7])
                );
                
                $this->db->insert('t_lectura_medidor', $newuser);
            }
            
        }
        
    }
    
    function csv(){
   $sql = "SELECT * FROM t_usuarios";
   $query = $this->db->query($sql);
   // Atentos a esta función que transforma el resultado de una query en CSV
   return $this->dbutil->csv_from_result($query);
}
   
   
    public function get($comunidad,$periodo,$anio,$torre,$medidor)
 {

 $fields = $this->db->field_data('t_lectura_medidor_plantilla2');
  
 $query = $this->db->query("SELECT Nro_dpto,Periodo,Anio,Lectura_anterior,Lectura_actual,id_medidor as Medidor,
                            id_comunidad as Comunidad,id_torre as Torre 
                            from t_lectura_medidor 
                            where id_comunidad='{$comunidad}' and periodo='{$periodo}' and anio='{$anio}' and id_torre='{$torre}' and id_medidor='{$medidor}'");

 return array("fields" => $fields, "query" => $query);
 }
 
 
 
  
    public function get1($comunidad,$periodo,$anio,$torre,$medidor)
 {

 $fields = $this->db->field_data('t_lectura_medidor_plantilla2');
                            
  $query = $this->db->query("SELECT id_comunidad as Comunidad,id_torre as Torre,Nro_dpto,id_medidor as Medidor,Periodo,Anio,Lectura_anterior,Lectura_actual
                            from t_lectura_medidor 
                            where id_comunidad='{$comunidad}' and periodo='{$periodo}' and anio='{$anio}' and id_torre='{$torre}' and id_medidor='{$medidor}'");                          

 return array("fields" => $fields, "query" => $query);
 }
    
    
    
  
  
  
  
  public function consulta_encadendada($id)
    {
        $this->db->select('username')->from('users')->where('id >=', $id)->limit(0, 10);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    } 
    
    
    public function existe_lectura($id_comunidad,$torre,$periodo,$anio,$id_medidor,$nro_dpto)
    {
        $sql    = "SELECT * from t_lectura_medidor where id_comunidad = '{$id_comunidad}' and id_torre='{$torre}' and periodo='{$periodo}' and anio='{$anio}' and id_medidor='{$id_medidor}' and nro_dpto='{$nro_dpto}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    public function existe_lectura_asignacion($comunidad,$torre,$periodo,$anio,$medidor,$nro_dpto)
    {
        $sql    = "SELECT * from t_lectura_medidor where id_comunidad = '{$comunidad}' and id_torre='{$torre}' and periodo='{$periodo}' and anio='{$anio}' and id_medidor='{$medidor}' and nro_dpto='{$nro_dpto}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
     public function delete_dpto_invalido()
    {
       
        $query = $this->db->query("delete t_lectura_medidor
                                  FROM t_lectura_medidor
                                  LEFT OUTER JOIN t_copropietarios ON t_lectura_medidor.nro_dpto = t_copropietarios.nro_dpto

                                  where t_copropietarios.nro_dpto is null");

    }
    
    public function delete_medidor_invalido()
    {
       
        $query = $this->db->query("delete t_lectura_medidor
                                  FROM t_lectura_medidor
                                  
                                  LEFT OUTER JOIN t_medidores ON t_lectura_medidor.id_medidor = t_medidores.nombre_medidor

                                  where t_medidores.nombre_medidor is null");

    }
  
    public function delete_comunidad_invalido()
    {
       
        $query = $this->db->query("delete t_lectura_medidor
                                  FROM t_lectura_medidor
                                  
                                  LEFT OUTER JOIN n_comunidad ON t_lectura_medidor.id_comunidad = n_comunidad.nombre_comunidad

                                  where n_comunidad.nombre_comunidad is null");

    }
    public function delete_torre_invalido()
    {
       
        $query = $this->db->query("delete t_lectura_medidor
                                  FROM t_lectura_medidor
                                  
                                  LEFT OUTER JOIN n_torres ON t_lectura_medidor.id_torre = n_torres.nombre_torre

                                  where n_torres.nombre_torre is null");

    }
    
    public function delete_nulls() {
       
        $query = $this->db->query("delete from t_lectura_medidor where lectura_anterior is NULL and lectura_actual is NULL");

    }
    
    
}





// SELECT l.nro_dpto, l.id_comunidad, l.id_torre, l.id_medidor from t_lectura_medidor l
// inner join t_copropietarios c on (c.nro_dpto =l.nro_dpto)
// inner join n_comunidad co on (l.id_comunidad = co.nombre_comunidad)
// inner join n_torres t on (l.id_torre = t.nombre_torre)
// inner join t_medidores m on (l.id_medidor = m.nombre_medidor)


//select (((select SUM(monto) as monto from t_egresos where id_comunidad='2' and periodo='12' and id_medidor='AGUA CALIENTE' and anio='2018')*
//select porcentaje from t_medidores where id_comunidad='2' and nombre_medidor='GAS'))/100) as porcentaje
?>