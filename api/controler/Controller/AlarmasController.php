<?php
class AlarmasController extends AppController{
	public function alarmas_fn($key,$sv600_id,$alarma,$funcion)
	{
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
					$host=$valores['ip_bd_cam'];
					$login=$valores['usr_bd_cam'];
					$password=$valores['pass_bd_cam'];
					$database=$valores['bd_cam'];
									
					$link = $this->conexion2($host,$login,$password,$database,'AlarmasController');
					$resultado = $link->query("update posiciones set alarma='".$alarma."' where sv600_id='".$sv600_id."'"); 
					if ($resultado>=1)
					{
						$respuesta= '{"error":0,"message":"guardado con exito"}';
					}
					else
					{
						$respuesta= '{"error":-1,"message":"error al guardar registro"}';
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
			$respuesta=  '{"error":-1,"message":"Error Interno"}';
		}
		return  $respuesta;	
	}
} 
?>