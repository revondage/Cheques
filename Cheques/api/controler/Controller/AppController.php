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
App::uses('AutenticarController','Controller');

	
class AppController extends Controller {
	
	public function conexion()
	{
		return ConnectionManager::getDataSource("default");
	}
	
	public function conexion2($host,$login,$password,$database,$nombre)
	{
		if (trim($nombre)=="" || $nombre == NULL)
			$nombre="dinamica".date('YmdHis');
			
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
	public function reemplaza($dato)
	{
		$dato=str_replace("&","&amp;",$dato);
		return $dato;
	}
	
	public function linea_captura($servicio,$camion)
	{
		$servicio=ceros((4-strlen($servicio))).$servicio;
		$camion=ceros((4-strlen($camion))).$camion;
		
		$seg=date('s');
		$min=date('i');
		$hora=date('hh');
		$dia=date('d');
		
		$base=$servicio.$seg.$min.$hora.$dia;
		
		$llave=((1/$base));
		$expo=explode('-',$llave);
		$mil='1'.ceros($expo[1]);
		$llave=(((1/$base))*$mil);
	
		$llave=number_format($llave,15);
		$divicion_ex=explode('.',$llave);
		$llave=$divicion_ex[1];	
			
		return $camion.$llave;
	}
	
}
function ceros($cuantos)
	{
		if ($cuantos>0)
		{
			$valor="";
			for($x=0;$x<$cuantos;$x++)
			{
				if ($valor=="")
				$valor="0";
				else
				$valor=$valor."0";
			}
		}
		return $valor;
	}
