<?php
class TablaPuntosOroController extends AppController{
	public function tabla_puntos_oro_fn($key,$sv600_id,$funcion)
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
					$host=$valores['ip_bd'];
					$login=$valores['usr_bd'];
					$password=$valores['pass_bd'];
					$database=$valores['bd'];
						
					$link = $this->conexion2($host,$login,$password,$database);
					$resultado = $link->query("select * from puntos2 group by puntos order by puntos");
					$rows=count($resultado);
					
					if ($rows>=1)
					{
						$respuesta="";
						foreach($resultado as $valores)
						{
							foreach($valores as $valor)
							{
								if ($respuesta=="")
								{
									$respuesta='{"limite_inferior":"'.$valor['liminf'].'","limite_superior":"'.($valor['limsup']).'","puntos":"'.$valor['puntos'].'"}';
								}
								else
								{
									$respuesta.=',{"limite_inferior":"'.$valor['liminf'].'","limite_superior":"'.($valor['limsup']).'","puntos":"'.$valor['puntos'].'"}';
								}	
							}
						}
						if ($rows>1)
						{
							$respuesta='{"error":0,"message":"'.$rows.'","datos":['.$respuesta.']}';
						}
						else
						{
							$respuesta='{"error":0,"message":"'.$rows.'","datos":'.$respuesta.'}';
						}
					}
					else
					{
						$respuesta= '{"error":-1,"message":"no existen informacion de puntos"}';
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