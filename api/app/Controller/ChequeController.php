<?php

class ChequeController extends AppController {

  public function read() {
    try {
      $o_link = $this->conexion();
      $this->operacionquery = "select";
      $o_link->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', "
      . "character_set_database = 'utf8', character_set_server = 'utf8'");
      $s_banco = $_REQUEST['id_banco'];
      // $s_banco = 2;


      // $s_sql = "SELECT * FROM usuario WHERE plaza_id LIKE '%".$i_plaza."%' order by id ASC";
      // $s_sql = "SELECT configuracion.id AS ID ,banco.nombre as BANCO, cheque_ver.version AS VERSION, impresora.nombre AS IMPRESORA FROM configuracion INNER JOIN banco ON banco.id = configuracion.banco_id INNER JOIN cheque_ver ON cheque_ver.id = configuracion.version_id INNER JOIN impresora ON impresora.id = configuracion.impresora_id";
      $s_sql = "SELECT * FROM cheque_ver INNER JOIN banco ON banco.id = cheque_ver.banco_id WHERE banco.id = ".$s_banco;
      // $s_sql = "SELECT * FROM cheque_ver";
      $a_resultado = $o_link->query($s_sql);

      // $s_sql = "select * from operadores";
      // $a_resultado = $o_link->query($s_sql);

      $n_rows = count($a_resultado); //contamos los registros regresados
      if ($n_rows > 0) {
        $this->success = 1;
        $this->data = $this->tojson($a_resultado, null);
      } else {
        $this->message = "Sin info";
      }
    } catch (Exception $o_ex) {
      $s_error = str_replace("'", "", $o_ex->getMessage());
      $s_error = str_replace('"', "", $s_error);
      $this->message = $s_error;
    }
    // pr(json_decode($this->returnjson()));
    echo $this->returnjson();
    exit();
  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // public function create() {
  //   try {
  //     $o_link = $this->conexion();
  //     if (isset($_REQUEST["data"])) {
  //       $a_info = $_REQUEST["data"];
  //       $a_data = json_decode($a_info, true);
  //       /*$s_sql = "select * from zona where zona='".$a_data['zona']."' and plaza_id='" . $a_data['plaza_id']."'";
  //       $a_resultado = $o_link->query($s_sql);
  //       if ($a_resultado <= 0) {*/
  //       $s_sql = "insert into zona (zona,plaza_id,descripcion,fecha_registro) "
  //       . "values('" .$a_data['zona'] . "','" .$a_data['plaza_id'] . "','" . strtoupper($a_data['descripcion']) . "',"
  //       . "'" . date('Y-m-d H:i:s') . "')";
  //       $a_resultado = $o_link->query($s_sql);
  //       if ($a_resultado <= 0) {
  //         $this->message = "Error: " . $s_sql;
  //       } else {
  //         $this->message = "Insertado con exito"; //.mysql_affected_rows($link);
  //         $this->success = 1;
  //       }
  //     } else {
  //       $this->message = "Error: No se envio informacion a guardar";
  //     }
  //   } catch (Exception $o_ex) {
  //     $s_error = str_replace("'", "", $o_ex->getMessage());
  //     $s_error = str_replace('"', "", $s_error);
  //     $this->message = $s_error;
  //   }
  //   $this->s_error = $this->message;
  //   echo $this->returnjson();
  //   exit();
  // }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // public function update() {
  //   try {
  //     $o_link = $this->conexion();
  //     if (isset($_REQUEST["data"])) {
  //       $a_info = $_REQUEST["data"];
  //       $a_data = json_decode($a_info);
  //
  //       $this->n_idregistro = $a_data->id;
  //
  //       $s_sql = "update configuracion set banco_id='" . $a_data->cmbBanco
  //       . "', version_id='" .$a_data->cmbCheque
  //       . "', impresora_id='" .$a_data->cmbImpresora;
  //       $a_resultado = $o_link->query($s_sql);
  //       if ($a_resultado <= 0) {
  //         $this->message = "Error: " . $s_sql;
  //       } else {
  //         $this->message = "Actualizado con exito"; //.mysql_affected_rows($link);
  //         $this->success = 1;
  //       }
  //     } else {
  //       $this->message = "Error: No se envio informacion a guardar";
  //     }
  //   } catch (Exception $o_ex) {
  //     $s_error = str_replace("'", "", $o_ex->getMessage());
  //     $s_error = str_replace('"', "", $s_error);
  //     $this->message = $s_error;
  //   }
  //   $this->s_error = $this->message;
  //   echo $this->returnjson();
  //   exit();
  // }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // public function delete() {
  //   try {
  //     $o_link = $this->conexion();
  //     if (isset($_REQUEST["data"])) {
  //       $a_info = $_REQUEST["data"];
  //       $a_data = json_decode($a_info);
  //       $this->n_idregistro = $a_data->id;
  //       $s_sql = "update plaza set estatus='B',fecha_modificacion='" . date('Y-m-d H:i:s') . "' where id=" . $a_data->id;
  //       $a_resultado = $o_link->query($s_sql);
  //       if ($a_resultado <= 0) {
  //         $this->message = "Error: " . $s_sql;
  //       } else {
  //         $this->message = "Eliminado con exito"; //.mysql_affected_rows($link);
  //         $this->success = 1;
  //       }
  //     } else {
  //       $this->message = "Error: No se envio informacion a guardar";
  //     }
  //   } catch (Exception $o_ex) {
  //     $s_error = str_replace("'", "", $o_ex->getMessage());
  //     $s_error = str_replace('"', "", $s_error);
  //     $this->message = $s_error;
  //   }
  //   $this->s_error = $this->message;
  //   echo $this->returnjson();
  //   exit();
  // }

  // public function configCheque() {
  //   $o_link = $this -> conexion();
  //   $this -> data = "";
  //   // $s_banco = $_REQUEST['banco'];
  //   $s_banco = $_REQUEST['id_banco'];
  //   // $s_sql ="SELECT configuracion.id AS ID ,banco.nombre as BANCO, cheque_ver.version AS VERSION, impresora.nombre AS IMPRESORA FROM configuracion INNER JOIN banco ON banco.id = configuracion.banco_id INNER JOIN cheque_ver ON cheque_ver.id = configuracion.version_id INNER JOIN impresora ON impresora.id = configuracion.impresora_id WHERE impresora.nombre = "HP LaserJet P1109w"";
  //   $s_sql = "SELECT * FROM cheque_ver INNER JOIN banco ON banco.id = cheque_ver.banco_id WHERE banco.id = ".$s_banco;
  //   $n_resultado = $o_link -> query($s_sql);
  //   // $s_sql = "SELECT * FROM usuario WHERE usuario = '".$s_validarusuario."'";
  //   // $n_resultado = $o_link -> query($s_sql);
  //
  //   if(count($n_resultado) > 0) {
  //     $this->message="Encontrado";
  //     foreach ($n_resultado as $res) {
  //       if($this->data == "") {
  //         $this->data = '{
  //           "id_banco"       :   "'.$res['cheque_ver']['banco_id'].'",
  //         }';
  //       } else {
  //         $this->data .= ',{
  //           "id_banco"       :   "'.$res['cheque_ver']['banco_id'].'",
  //         }';
  //       }
  //     }
  //   } else {
  //     $this->message="No hay registros";
  //   }
  //   echo $this->returnjson();
  //   exit();
  // }

}

?>
