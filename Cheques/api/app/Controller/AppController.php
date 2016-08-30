<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
include("nusoap/nusoap.php");

//use Firebase\JWT\JWT;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::uses('ConnectionManager', 'Model');
App::uses('AutenticarController', 'Controller');

class AppController extends Controller {

    public $s_datetime,$success=0,$data="";

    public function verificaconexion() {
        $o_link = $this->conexion();
        var_dump($o_link);
        $resultado = $o_link->query("select * from sv600 where sv600_id='731'");
        echo count($resultado);
        exit();
    }

    public function bitacora($key, $sv600_id, $funcion, $rows, $parametros, $respuesta) {
        try {
            $link = $this->conexion();
            $resultado_entrada = $link->query("insert into bitacora_entradas(sv600_id,sistema_key,funcion,fecha,hora,acceso,parametros,respuesta) "
                    . "values('" . $sv600_id . "','" . $key . "','" . $funcion . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','" . $rows . "',"
                    . "'" . $parametros . "','" . $respuesta . "')");
            return 1;
        } catch (Exception $ex) {
            return 1;
        }
    }

    public function add_ceros($numero, $ceros, $lado) {
        $order_diez = explode(".", $numero);
        $dif_diez = $ceros - strlen($order_diez[0]);
        for ($m = 0; $m < $dif_diez; $m++) {
            @$insertar_ceros .= 0;
        }
        if ($lado == "i")
            return $numero.= $insertar_ceros;
        else
            return $insertar_ceros .= $numero;
        //return $insertar_ceros .= $numero; 
    }

    public function conexion() {
        try {
            return $this->revisaconexion();
        } catch (Exception $o_ex) {
            return -1;
        }
    }

    public function revisaconexion() {
        try {
            return ConnectionManager::getDataSource("ws1");
        } catch (Exception $o_ex) {
            //return -1;
        }
        try {
            return ConnectionManager::getDataSource("ws2");
        } catch (Exception $o_ex) {
            return -1;
        }
    }

    public function conexion2($host, $login, $password, $database, $nombre = "") {
        if (trim($nombre) == "" || $nombre == NULL)
            $nombre = "dinamica" . date('YmdHis');

        $config = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => $host,
            'login' => $login,
            'password' => $password,
            'database' => $database,
        );
        return ConnectionManager::create($nombre, $config);
    }

    public function reemplaza($dato) {
        $dato = str_replace("&", "&amp;", $dato);
        return $dato;
    }

    public function linea_captura($servicio, $camion) {
        $servicio = ceros((4 - strlen($servicio))) . $servicio;
        $camion = ceros((4 - strlen($camion))) . $camion;

        $seg = date('s');
        $min = date('i');
        $hora = date('hh');
        $dia = date('d');

        $base = $servicio . $seg . $min . $hora . $dia;

        $llave = ((1 / $base));
        $expo = explode('-', $llave);
        $mil = '1' . ceros($expo[1]);
        $llave = (((1 / $base)) * $mil);

        $llave = number_format($llave, 15);
        $divicion_ex = explode('.', $llave);
        $llave = $divicion_ex[1];

        return $camion . $llave;
    }

    public function encriptar_datos($s_dato, $s_key) {
        //$jwt = new JWT();
        // return $jwt->encode($s_dato, $s_key);
        return cryptoJsAesEncrypt($s_key, $s_dato);
    }

    public function cambiar_caracter() {
        $passphrase = "Secret Passphrase";
        $value = "Message";

        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx . $passphrase . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);

        exit();
    }

    private function validanumero($numero) {
        //compruebo que los caracteres sean los permitidos 
        $permitidos = "01234567890.";
        $b_tipo = true;
        $s_guardapunto = "";
        for ($i = 0; $i < strlen($numero); $i++) {
            if (substr($numero, $i, 1) == "-" && $i == 1) {
                return false;
            } elseif (substr($numero, $i, 1) == ".") {
                if ($s_guardapunto == "") {
                    $s_guardapunto = ".";
                } else {
                    $b_tipo = false;
                }
            }
            if (strpos($permitidos, substr($numero, $i, 1)) === false) {

                $b_tipo = false;
//  return false;
            }
        }
        return $b_tipo;
    }

    private function validatipo($s_tipo) {
        $b_regresa = false;
        if ($s_tipo == 'date' || $s_tipo == 'time' || $s_tipo == 'datetime' || $s_tipo == 'varchar' || $s_tipo == 'char' || $s_tipo == 'text') {
            $b_regresa = true;
        }
        return $b_regresa;
    }

    public function tojson($a_resultado, $a_estructura) {
        $s_json = "";
        $s_array_campos = "";
        foreach ($a_resultado as $a_valores) {
            $s_array_campos = "";
            foreach ($a_valores as $s_valor) {
                foreach ($s_valor as $s_campo => $s_value) {
                    $n_valida = 0;
                    if ($a_estructura != null) {
                        foreach ($a_estructura as $s_columnas) {
                            foreach ($s_columnas as $s_columna) {
                                if ($s_columna['column_name'] == $s_campo) {
                                    if ($this->validatipo($s_columna['data_type'])) {
                                        $s_value = str_replace('"', '\"', $s_value);
                                        $s_value = str_replace("'", "\'", $s_value);
                                        $s_value = '"' . $s_value . '"';
                                        $n_valida = 1;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($n_valida == 0) {
                        if (trim($s_value) == "") {
                            $s_value = '"' . $s_value . '"';
                        } else if ($this->validanumero($s_value)) {
                            $s_value = $s_value;
                        } else if (gettype($s_value) == "string" || gettype($s_value) == "NULL") {
                            $s_value = '"' . $s_value . '"';
                        }
                    }
                    if ($s_array_campos == "") {
                        $s_array_campos = '"' . $s_campo . '":' . $s_value;
                    } else {
                        $s_array_campos.= ',"' . $s_campo . '":' . $s_value;
                    }
                }
            }
            if ($s_json != "") {
                $s_json.=',{' . $s_array_campos . '}';
            } else {
                $s_json = '{' . $s_array_campos . '}';
            }
        }
        return $s_json;
    }

    public function returnjson() {

        return '{"success":' . $this->success . ',"message":"' . $this->message . '","data":[' . $this->data . ']}';
    }

}

function ceros($cuantos) {
    if ($cuantos > 0) {
        $valor = "";
        for ($x = 0; $x < $cuantos; $x++) {
            if ($valor == "")
                $valor = "0";
            else
                $valor = $valor . "0";
        }
    }
    return $valor;
}
