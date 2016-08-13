<?php
class LoginController extends AppController{
	
	public function login_fn($key,$sv600_id,$usuario,$password,$funcion)
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
				
				if ($rows>=1)
				{
					$resultado = $link->query("select * from usuarios inner join tipo_usuario on usuarios.tipo_usuario_id = tipo_usuario.id and usuario='".$usuario."' and password='".$password."' and sv600_id='".$sv600_id."'");
					$rows_usu=count($resultado);
					$nombre=$resultado[0]['usuarios']['nombre'];
					$tipo=$resultado[0]['tipo_usuario']['tipo'];
									
					if($rows_usu>=1)
					{
						$link->query("update usuarios set fecha_time='".date('Y-m-d H:i:s')."',sesion=1 where usuario='".$usuario."' and password='".$password."' and sv600_id='".$sv600_id."'");
						
						$respuesta= '{"error":0,"message":"Bienvenido '.$nombre.'","tipo_usuario_id":"'.$tipo.'","nombre":"'.$nombre.'"}';
					}
					else
					{
						$respuesta=  '{"error":-1,"message":"usuario y password incorrecto","tipo_usuario_id":"NAT"}';
					}
				}
				else
				{
					$respuesta= '{"error":-1,"message":"El sv600 '.$sv600_id.'  no se encuentra dado de alta","tipo_usuario_id":"NAT"}';
				}
			}
			else
			{
				$respuesta=  '{"error":-1,"message":"Acceso Denegado","tipo_usuario_id":"0"}';
			}
		}
		catch(Exception $ex)
		{
			$respuesta=  '{"error":-1,"message":"Error Interno ('.$ex->getMessage().')","tipo_usuario_id":"0"}';
		}
		
		return $respuesta;
	}
}

?>