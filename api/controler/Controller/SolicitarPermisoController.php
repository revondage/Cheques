<?php
class SolicitarPermisoController extends AppController{
public function solicitar_permiso_fn($key,$sv600_id,$funcion)
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
										
				$link = $this->conexion2($host,$login,$password,$database,'SolicitarPermisoController');
				
				$resultado = $link->query("select * from posiciones where camion='".$unidad."' and plaza='".$plaza."'");
				$rows=count($resultado);
				$valores = $resultado[0]['posiciones'];
				if ($rows >= 1)
				{
					if($valores['autorizacion']!="" && $valores['tiempo']>=1)
					{
						$respuesta='{"error":0,"message":"autorizado","autorizacion":"'.$valores['autorizacion'].'","tiempo":'.$valores['tiempo'].'}';
					}
					else
					{
						$respuesta='{"error":0,"message":"no existe autorizacion para salir","autorizacion":"'.$valores['autorizacion'].'","tiempo":'.$valores['tiempo'].'}';
					}
				}
				else
				{
					$respuesta='{"error":-1,"message":"no se encontro datos de la unidad","autorizacion":"","tiempo":0}';
				}		
			}
			else
			{
				$respuesta= '{"error":-1,"message":"El sv600 '.$sv600_id.'  no se encuentra dado de alta","autorizacion":"","tiempo":0}';
			}
		}
		else
		{
			$respuesta=  '{"error":-1,"message":"Acceso Denegado","autorizacion":"","tiempo":0}';
		}
	}
	catch(Exception $ex)
	{
		$respuesta=  '{"error":-1,"message":"Error Interno ('.$ex->getMessage().')","autorizacion":"","tiempo":0}';
	}
	return  $respuesta;	
} 
}
?>