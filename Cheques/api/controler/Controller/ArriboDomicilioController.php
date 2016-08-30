<?php
class ArriboDomicilioController extends AppController{
	public function arribo_domicilio_fn($key,$sv600_id,$numero_control,$odometro,$funcion)
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
					$host=$valores['ip_bd'];
					$login=$valores['usr_bd'];
					$password=$valores['pass_bd'];
					$database=$valores['bd'];
											
					$link = $this->conexion2($host,$login,$password,$database,'ArriboDomicilioController');
					$resultado = $link->query("update listas set odometro=".$odometro." where ncontrol=".$numero_control);
					if($resultado>=1)
					{
						$respuesta='{"error":0,"message":"arribo a domicilio"}';
					}
					else
					{
						$respuesta='{"error":-1,"message":"no se pudo guardar el kilometraje del odometro"}';
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