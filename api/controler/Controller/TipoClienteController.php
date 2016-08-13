<?php
class TipoClienteController extends AppController{
	public function tipo_cliente_fn($key,$sv600_id,$funcion)
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
					
					
					$resultado = $link->query("select * from tipo_cliente");
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
									
									$respuesta='{"tipo":"'.$valor['tipo'].'","descripcion":"'.utf8_encode($valor['descripcion']).'"}';
								}
								else
								{
									$respuesta.=',{"tipo":"'.$valor['tipo'].'","descripcion":"'.utf8_encode($valor['descripcion']).'"}';
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
						$respuesta= '{"error":-1,"message":"no existen informacion de tipos de cliente"}';
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