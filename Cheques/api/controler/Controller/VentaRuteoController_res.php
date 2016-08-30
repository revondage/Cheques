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
				$rows=1;
			else
				$rows= $AutenticarController->autenticar($link,$key,$funcion);
			
			return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1,1);
			
			if($rows >=1)
			{
				return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1,1);
				/*$folio=125;
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
						return  '{"error":-1,"message":"Error Interno de conexion al obetner datos de la plaza"}';
							
					$valores = $resultado[0]['plazas'];
					$host=$valores['ip_bd'];
					$login=$valores['usr_bd'];
					$password=$valores['pass_bd'];
					$database=$valores['bd'];
							
					$link = $this->conexion2($host,$login,$password,$database,'SolicitarServicioController');
					$resultado = $link->query("select * from listas where  sv600_id='".$sv600_id."' and surtido='' and ruteo=1 order by orden limit 1");
					$rows_pedidos=count($resultado);
					
					$respuesta="";
					
					foreach($resultado as $valores)
					{
						foreach($valores as $valor)
						{
							$folio++;
							$linea=$this->linea_captura($folio, $unidad);
							
							if ($respuesta=="")
								$respuesta='{"numero_control":"'.$valor['control'].'","nombre_cliente":"'.$valor['nombre'].'","direccion_cliente":"'.$valor['direccion'].'","rfc_cliente":"'.$valor['rfc'].'","capacidad_tanque":"'.$valor['cap_tanque'].'","descuento_centavos":"'.$valor['descuento'].'","descuento_porcentaje":"","precio_aditivo":"'.$valor['prec_adi'].'","precio_gas":"'.$valor['precio'].'","surtido_multiple":"","numero_prog_tmkt":"'.$valor['num_prog'].'","numero_visitas":"'.$valor['num_visita'].'","plazo_credito":"'.$valor['plazo'].'","lista":"'.$valor['lista'].'","tipo_carburacion":"","puntos_acumulados":"'.$valor['puntos'].'","pago_facil":"","status_credito":"'.$valor['credito'].'","linea_captura":"'.$linea.'","latitud":"","longitud":"","credito_disponible":""}';
							else
								$respuesta.=',{"numero_control":"'.$valor['control'].'","nombre_cliente":"'.$valor['nomcliente'].'","direccion_cliente":"'.$valor['direccion'].'","rfc_cliente":"'.$valor['rfc'].'","capacidad_tanque":"'.$valor['cap_tanque'].'","descuento_centavos":"'.$valor['descuento'].'","descuento_porcentaje":"","precio_aditivo":"'.$valor['prec_adi'].'","precio_gas":"'.$valor['precio'].'","surtido_multiple":"","numero_prog_tmkt":"'.$valor['num_prog'].'","numero_visitas":"'.$valor['num_visita'].'","plazo_credito":"'.$valor['plazo'].'","lista":"'.$valor['lista'].'","tipo_carburacion":"","puntos_acumulados":"'.$valor['puntos'].'","pago_facil":"","status_credito":"'.$valor['credito'].'","linea_captura":"'.$linea.'","latitud":"","longitud":"","credito_disponible":""}';	
						}
					}			
					if ($rows_pedidos>0)
						$respuesta='{"error":0,"message":"'.$rows_pedidos.'","datos":['.$respuesta.']}';
					else
						$respuesta='{"error":-1,"message":"No hay pedidos"}';
				}
				else
				{
					$respuesta= '{"error":-1,"message":"El sv600 '.$sv600_id.'  no se encuentra dado de alta"}';
				}*/
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