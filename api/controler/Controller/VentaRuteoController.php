<?php
class VentaRuteoController extends AppController{
	public function venta_ruteo_fn($key,$sv600_id,$funcion)
	{
		App::uses('SolicitarServicioController','Controller');
		$SolicitarServicioController = new SolicitarServicioController;
		$AutenticarController = new AutenticarController;
		try
		{
			$respuesta="";
			$link = $this->conexion();
			if($validar==1)
			{
				$rows=1;
			}
			else
			{
				$rows= $AutenticarController->autenticar($link,$key,$sv600_id,$funcion);
			}
			if($rows >=1)
			{
				return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1,1);
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