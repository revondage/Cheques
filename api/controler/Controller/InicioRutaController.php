<?php
class InicioRutaController extends AppController{
	public function inicio_ruta_fn($key,$sv600_id,$porcentaje_tanque,$porcentaje_tanque_carburacion,$odometro,$horometro,$funcion)
	{
		App::uses('SolicitarServicioController','Controller');
		$SolicitarServicioController = new SolicitarServicioController;
		$AutenticarController = new AutenticarController;
		
		try
		{
			$respuesta="";
			$link = $this->conexion();
			$rows= $AutenticarController->autenticar($link,$key,$sv600_id,$funcion);
			
			if($rows >=1)
			{
				$sql="select * from sv600 where sv600_id='".$sv600_id."'";
				$res= mysql_query($sql,$link);
				$rows= mysql_num_rows($res);
				$fila= mysql_fetch_array($res);
				
				$resultado = $link->query("select * from sv600 where sv600_id='".$sv600_id."'");
				$rows=count($resultado);
				$valores = $resultado[0]['sv600'];
				$plaza= $valores['plaza'];
				$unidad= $valores['unidad'];
									
				if ($rows>=1)
				{
					$resultado = $link->query("select * from plazas where plaza='".$plaza."'");
					$rows=count($resultado);
					if($rows<=0)
					{
						return  '{"error":-1,"message":"Error Interno de conexion al obetner datos de la plaza"}';
					}		
					$valores = $resultado[0]['plazas'];
					$host=$valores['ip_bd'];
					$login=$valores['usr_bd'];
					$password=$valores['pass_bd'];
					$database=$valores['bd'];
					$database_port=$valores['bd_port'];
								
					$link = $this->conexion2($host,$login,$password,$database_port,'InicioRutaController');
					
					$resultado = $link->query("select * from apertura where num_eco=".$unidad);
					$rows=count($resultado);
					$valores = $resultado[0]['apertura'];
					
					if ($rows>=1)
					{
						$link = $this->conexion2($host,$login,$password,$database,'InicioRutaController2');
						$resultado = $link->query("select * from ruta where camion=".$unidad." and sv600_id=".$sv600_id." and operacion='1' and fecha='".date('Y-m-d')."'");
						$rows=count($resultado);
						if($rows>=1)
						{
							return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1);
						}
						else
						{
							$resultado = $link->query("replace into ruta (fecha,hora,camion,nempleado,nom_cho,ayudante,nom_ayu,sv600_id,porce_tan,porce_tan_car,odometro,horometro,operacion) values ('".date('Y-m-d')."','".date('H:i:s')."','".$unidad."','".$valores['nempleado']."','".$valores['nom_cho']."','".$valores['ayudante']."','".$valores['nom_ayu']."','".$sv600_id."','".$porcentaje_tanque."','".$porcentaje_tanque_carburacion."','".$odometro."','".$horometro."','1')");
							if ($resultado>=1)
							{
								return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1);
							}
							else
							{
								$respuesta='{"error":-1,"message":"no se pudo guardar la informacion de inicio de ruta"}';
							}
						}
					}
					else
					{
						$respuesta='{"error":-1,"message":"unidad no se encuentra en la apertura"}';
					}
				}
				else
				{
					$respuesta= '{"error":-1,"message":"El sv600 '.$sv600_id.'  no se encuentra dado de alta"}';
				}
			}
			else
			{
				$respuesta=  '{"error":-1,"message":"Acceso Denegado"}';
			}
		}
		catch(Exception $ex)
		{
			$respuesta=  '{"error":-1,"message":"Error Interno ('.$ex->getMessage().')"}';
		}
		return  $respuesta;	
	} 
}
?>