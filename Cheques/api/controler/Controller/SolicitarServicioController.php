<?php
class SolicitarServicioController extends AppController{
	public function solicitar_servicio_fn($key,$sv600_id,$funcion,$validar,$param)
	{
		$AutenticarController = new AutenticarController;
		try
		{
			$error=0;
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
				//$folio=125;
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
					$database_port=$valores['bd_port'];
					
					$link = $this->conexion2($host,$login,$password,$database_port,'SolicitarServicioController');
					$resultado = $link->query("select * from apertura where num_eco=".$unidad);
					$rows=count($resultado);
					$valores2 = $resultado[0]['apertura'];
					$zona=$valores2['zona'];
					if ($rows>=1)
					{
						$host2=$valores['ip_bd_cam'];
						$login2=$valores['usr_bd_cam'];
						$password2=$valores['pass_bd_cam'];
						$database2=$valores['bd_cam'];
												
						$link = $this->conexion2($host2,$login2,$password2,$database2,'SolicitarPermisoController');
						
						$resultado = $link->query("select * from posiciones where camion='".$unidad."' and plaza='".$plaza."'");
						$rows=count($resultado);
						$valores = $resultado[0]['posiciones'];
						if ($rows >= 1)
						{
							
							$error=1;	
						}
						
						$link = $this->conexion2($host,$login,$password,$database,'SolicitarServicioController2');
						if ($param==1)
						{
							$resultado = $link->query("select * from listas where  zona='".$zona."' and fecha<='".date('Y-m-d')."' and surtido='' and emergencia='R' order by fecha,estado limit 5");
							//$resultado = $link->query("select * from listas where  zona='".$zona."' and fecha='".date('Y-m-d')."' and surtido='' and emergencia='R' order by fecha,estado limit 5");
						}
						else
						{
							$resultado = $link->query("select * from listas where  zona='".$zona."' and fecha<='".date('Y-m-d')."' order by fecha,estado limit 5");
							//$resultado = $link->query("select * from listas where  zona='".$zona."' and fecha='".date('Y-m-d')."' and estado='C' order by fecha,estado limit 5");
						}
						$rows_pedidos=count($resultado);
						
						$respuesta="";
						
						foreach($resultado as $valores)
						{
							foreach($valores as $valor)
							{
								//$folio++;
								//$linea=$this->linea_captura($folio, $unidad);
								$litrogas='';
								//$sql="select * from litrogas where control =6842 order by folio";
								$sql="select * from litrogas where control =".$valor['ncontrol']." and marca=0 order by folio";
								$reslitrogas = $link->query($sql);
								$rows=count($reslitrogas);
								if ($rows>=1)
								{
									foreach($reslitrogas as $valitrogas)
									{
										foreach($valitrogas as $valitro)
										{
											if ($litrogas=="")
											{
												$litrogas='{"folio":"'.$valitro['folio'].'","fecha":"'.$valitro['fecha'].'","litros":"'.$valitro['litrogas'].'"}';
											}
											else
											{
												$litrogas.=',{"folio":"'.$valitro['folio'].'","fecha":"'.$valitro['fecha'].'","litros":"'.$valitro['litrogas'].'"}';
											}
										}
									}
								}
								else
								{
									//$litrogas='{"folio":"","fecha":"","litrogas":""}';
								}
								if ($respuesta=="")
								{
									$respuesta='{"numero_control":"'.$valor['ncontrol'].'","nombre_cliente":"'.utf8_encode($valor['nombre']).'","direccion_cliente":"'.utf8_encode($valor['direccion']).'","rfc_cliente":"'.$valor['rfc_cliente'].'","capacidad_tanque":"'.$valor['capacid'].'","descuento_centavos":"'.$valor['descuento_centavos'].'","descuento_porcentaje":"'.$valor['descuento_porcentaje'].'","precio_aditivo":"'.$valor['precio_aditivo'].'","precio_gas":"'.$valor['precio_gas'].'","surtido_multiple":"'.$valor['surtido_multiple'].'","numero_prog_tmkt":"'.$valor['numero_prog_tmkt'].'","numero_visitas":"'.$valor['numero_visitas'].'","plazo_credito":"'.$valor['plazo_credito'].'","lista":"'.$valor['lista'].'","tipo_carburacion":"'.$valor['tipo_carburacion'].'","puntos_acumulados":"'.$valor['puntos_acumulados'].'","pago_facil":"'.$valor['pago_facil'].'","status_credito":"'.$valor['credito'].'","latitud":"'.$valor['latitud'].'","longitud":"'.$valor['longitud'].'","credito_disponible":"'.$valor['credito_disponible'].'","numero_cuenta_cliente":"'.$valor['ncta'].'","posicion_verificada":'.$valor['verificado'].',"fecha_fabricacion":"'.$valor['fecha_fabricacion'].'","vigente":"'.$valor['vigente'].'","litrogas":['.$litrogas.']}';
								}
								else
								{
									$respuesta.=',{"numero_control":"'.$valor['ncontrol'].'","nombre_cliente":"'.utf8_encode($valor['nombre']).'","direccion_cliente":"'.utf8_encode($valor['direccion']).'","rfc_cliente":"'.$valor['rfc_cliente'].'","capacidad_tanque":"'.$valor['capacid'].'","descuento_centavos":"'.$valor['descuento_centavos'].'","descuento_porcentaje":"'.$valor['descuento_porcentaje'].'","precio_aditivo":"'.$valor['precio_aditivo'].'","precio_gas":"'.$valor['precio_gas'].'","surtido_multiple":"'.$valor['surtido_multiple'].'","numero_prog_tmkt":"'.$valor['numero_prog_tmkt'].'","numero_visitas":"'.$valor['numero_visitas'].'","plazo_credito":"'.$valor['plazo_credito'].'","lista":"'.$valor['lista'].'","tipo_carburacion":"'.$valor['tipo_carburacion'].'","puntos_acumulados":"'.$valor['puntos_acumulados'].'","pago_facil":"'.$valor['pago_facil'].'","status_credito":"'.$valor['status_credito'].'","latitud":"'.$valor['latitud'].'","longitud":"'.$valor['longitud'].'","credito_disponible":"'.$valor['credito_disponible'].'","numero_cuenta_cliente":"'.$valor['ncta'].'","posicion_verificada":'.$valor['verificado'].',"fecha_fabricacion":"'.$valor['fecha_fabricacion'].'","vigente":"'.$valor['vigente'].'","litrogas":['.$litrogas.']}';
								}
							}
						}			
						if ($rows_pedidos>0)
						{
							$respuesta='{"error":'.$error.',"message":"'.$rows_pedidos.'","datos":['.$respuesta.']}';
						}
						else
						{
							$respuesta='{"error":-1,"message":"No hay pedidos "}';
						}
					}
					else
					{
						$respuesta='{"error":-1,"message":"unidad no se encuentra en la apertura"}';
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