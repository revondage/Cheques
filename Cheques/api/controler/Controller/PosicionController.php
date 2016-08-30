<?php
class PosicionController extends AppController{
	public function posicion_fn($key,$sv600_id,$latitud,$longitud,$rssi,$funcion)
	{
		$AutenticarController = new AutenticarController;
		try
		{
			$respuesta="";
			$link = $this->conexion();
			$rows= $AutenticarController->autenticar($link,$key,$sv600_id,$funcion);
			
			if($rows >=1)
			{
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
													
					$link = $this->conexion2($host,$login,$password,$database,'PosicionController');
					
					$resultado = $link->query("update posiciones set camion='".$unidad."',fecha='".date('Y-m-d H:i:s')."',latitud='".$latitud."',longitud='".$longitud."',velocidad='0.00',rssi='".$rssi."' where sv600_id='".$sv600_id."'"); 
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
			$respuesta=  '{"error":-1,"message":"Error Interno('.$ex->getMessage().')"}';
		}
		return  $respuesta;	
	} 
}
?>