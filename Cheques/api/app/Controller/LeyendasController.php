<?php

class LeyendasController extends AppController {

  public function read() {
    try {
      $o_link = $this->conexion();
      $this->operacionquery = "select";
      $o_link->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', "
      . "character_set_database = 'utf8', character_set_server = 'utf8'");
      // $i_plaza = $_REQUEST['id_plaza'];
      // $i_sesion = $_REQUEST['id_sesion'];

      // $s_sql = "CREATE TEMPORARY TABLE usuarios AS SELECT usuario.*, plaza.plaza FROM usuario INNER JOIN plaza ON usuario.plaza_id = plaza.id WHERE plaza_id LIKE '%".$i_plaza."%' AND tipo_sesion_id LIKE '%".$i_sesion."%' ORDER BY id";
      $s_sql = "SELECT * FROM leyenda ORDER BY id";
      $a_resultado = $o_link->query($s_sql);

      // $s_sql = "select * from usuarios";
      // $a_resultado = $o_link->query($s_sql);

      $n_rows = count($a_resultado); //contamos los registros regresados
      if ($n_rows > 0) {
        $this->success = 1;
        $this->data = $this->tojson($a_resultado, null);
      } else {
        $this->message = "No hay operadores";
      }
    } catch (Exception $o_ex) {
      $s_error = str_replace("'", "", $o_ex->getMessage());
      $s_error = str_replace('"', "", $s_error);
      $this->message = $s_error;
    }

    echo $this->returnjson();
    exit();
  }
}
?>
