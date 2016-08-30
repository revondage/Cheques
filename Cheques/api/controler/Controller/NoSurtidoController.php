<?php
class NoSurtidoController extends AppController{
	public function no_surtido_fn($key,$sv600_id,$numero_control,$motivo,$porcentaje_tanque,$fecha_compromiso,$funcion)
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
									
					$link = $this->conexion2($host,$login,$password,$database,'NoSurtidoController');
						
					$horasurtido=date("Y-m-d H:i:s");
					$surtido="N";
					$estado="V";
					$resultado = $link->query("update listas set surtido='N', estado='V', horasurtido='".date("Y-m-d H:i:s")."', idmotivo='".$motivo."',porcentaje_tanque='".$porcentaje_tanque
."',fecha_compromiso='".$fecha_compromiso."' where ncontrol=".$numero_control);
					
					if($resultado>=1)
					{
						return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1);
					}
					else
					{
						$respuesta='{"error":-1,"message":"Error al guardar informacion"}';
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