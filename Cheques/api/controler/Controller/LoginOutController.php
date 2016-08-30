<?php
class LoginOutController extends AppController{
	public function login_out_fn($key,$sv600_id,$usuario,$password,$funcion)
	{
		$AutenticarController = new AutenticarController;
		try
		{
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
					
					if($rows_usu>=1)
					{
						$resultado = $link->query("select * from usuarios where date(fecha_time)='".date('Y-m-d')."' and sesion=0 and usuario='".$usuario."' and password='".$password."'");
						$rows_usu=count($resultado);
						if ($rows_usu>=1)
						{
							$respuesta= '{"error":0,"message":"la sesion ya esta cerrada"}';
						}
						else
						{
							$resultado = $link->query("update usuarios set fecha_time='".date('Y-m-d H:i:s')."',sesion=0 where usuario='".$usuario."' and password='".$password."' and sv600_id='".$sv600_id."'");
											
							if ($resultado>=1)
							{
								$respuesta= '{"error":0,"message":"sesion cerrada"}';
							}
							else
							{
								$respuesta= '{"error":-1,"message":"error al cerrar sesion"}';
							}
						}
						
					}
					else
					{
						$respuesta=  '{"error":-1,"message":"usuario y password incorrecto"}';
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
		return $respuesta;
	}
}
?>