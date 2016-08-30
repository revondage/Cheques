<?php
class AsignaValoresController extends AppController{
	
	public function asigna_valores_fn($key,$sv600_id,$funcion)
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
				
				////nivel de bateria para las tablets
				$resultado_bat = $link->query("select * from config");
				$bat_nivel_min = $resultado_bat[0]['config']['bat_nivel_min'];
				$bat_nivel_max = $resultado_bat[0]['config']['bat_nivel_max'];
				////////////////////////////////////////////////////////////////
						
				if ($rows>=1)
				{
					$resultado = $link->query("select * from plazas where plaza='".$plaza."'");
					$rows=count($resultado);
					if($rows<=0)
					{
						return  '{"error":-1,"message":"Error Interno de conexion al obetner datos de la plaza"}';
					}
					
					$valores = $resultado[0]['plazas'];
					
					//////////////////tanque////////////////////
					$host=$valores['ip_bd'];
					$login=$valores['usr_bd'];
					$password=$valores['pass_bd'];
					$database=$valores['bd'];
					///////////////////////////////////////////
					$fecha=date('Y-m-d');
					$fecha='2014-11-11';
					$actualizar=0;
					$link = $this->conexion2($host,$login,$password,$database,'actualizar');
					$resultado_act = $link->query("select count(*) as cuantos from motivos inner join forma_pago inner join tipo_cliente inner join tipo_venta on motivos.fecha = '".$fecha."' or forma_pago.fecha= '".$fecha."' or tipo_cliente.fecha= '".$fecha."' or tipo_venta.fecha= '".$fecha."'");
					
					$cuantos = $resultado_act[0][0]['cuantos'];
					
					if($cuantos>=1)
						$actualizar=1;
						
					$host=$valores['ip_bd_cam'];
					$login=$valores['usr_bd_cam'];
					$password=$valores['pass_bd_cam'];
					$database=$valores['bd_cam'];
					
					
					$link = $this->conexion2($host,$login,$password,$database,'posiciones');
									
					$resultado = $link->query("select * from posiciones where camion=".$unidad);
					$rows_config=count($resultado);
					if($rows_config>0)
					{
						$valores = $resultado[0]['posiciones'];
						$rfc=str_replace("-","",$valores['rfc']);
						$respuesta='{"error":0,"message":"valores","precio_gas":"'.$valores['precio_gas'].'","precio_aditivo":"'.$valores['precio_aditivo'].'","precio_aditivoc":"'.$valores['precio_aditivoc'].'","fecha_operacion":"'.$valores['fecha_carga'].'","tipo_vehiculo_id":"'.$valores['tipov'].'","folio_nota_venta":"'.$valores['factura'].'","folio_nota_puntos":"'.$valores['nota'].'","folio_nota_litrogas":"'.$valores['litrogas'].'","folio_nota_recirculacion":"'.$valores['foliorec'].'","tipo_impresora_id":"'.$valores['tipo_impresora'].'","k_flujo":"'.$valores['calibracion'].'","porcentaje_caida_presion":"'.$valores['porpres'].'","tiempo_cerrado_valvula":"'.$valores['val_off'].'","porcentaje_minimo_carburacion":"'.$valores['min_carbu'].'","porcentaje_minimo_tanque":"'.$valores['min_tanque'].'","serie":"'.$valores['serie'].'","otorgar_puntos":"'.$valores['puntos'].'","otorgar_puntos_oro":"'.$valores['puntos_oro'].'","puntos_minimos_canje":"'.$valores['minlitros'].'","cobro_aditivo":"'.$valores['cobro_aditivo'].'","litros_minimos_tarjeta":"'.$valores['lttar'].'","capacidad_minima_tanque":"'.$valores['capac_min'].'","porcentaje_buen_fin":"'.$valores['descbf'].'","rfc":"'.$rfc.'","razon_social":"'.$valores['nomcia'].'","ciudad":"'.$valores['ciudad'].'","permiso_sener":"'.$valores['permiso_sener'].'","oficio_sener":"'.$valores['oficio'].'","direccion_matriz":"'.$valores['matriz'].'","direccion_sucursal":"'.$valores['sucursal'].'","tel_pedidos":"'.$valores['tel_pedidos'].'","tel_quejas_local":"'.$valores['tel_quejas1'].'","tel_queja_foranea":"'.$valores['tel_quejas2'].'","url_facturacion_electronica":"'.$valores['linea_factura'].'","actualizar":"'.$actualizar.'","bat_nivel_min":'.$bat_nivel_min.',"bat_nivel_max":'.$bat_nivel_max.'}';
						
					}
					else
					{
						return  '{"error":-1,"message":"no hay configuracion de la plaza"}';
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