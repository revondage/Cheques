<?php
class FinalizarSurtidoController extends AppController{
	public function finalizar_surtido_fn($key,$sv600_id,$numero_control,$numero_servicio,$litros_surtidos,$importe_gas,$importe_aditivo,$importe_descuento,$forma_de_pago,$hora_inicio,$hora_final,$porcentaje_tanque_cliente,$fecha_compromiso,$porcentaje_tanque,$porcentaje_tanque_carburacion,$puntos_ganados,$puntos_oro_ganados,$tipo_de_venta,$numero_de_nota,$capacidad_tanque_cliente,$alarma_ra,$constante_calibracion,$porcentaje_final,$puntos_utilizados,$latitud,$longitud,$folio_litrogas,$linea_captura,$funcion)
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
					
					$link = $this->conexion2($host,$login,$password,$database,'FinalizarSurtidoController');
					if ($folio_litrogas!="")
					{
						$resultado_litrogas = $link->query("update litrogas set marca=1 where folio in (".$folio_litrogas.")");
					}
					
					$resultado = $link->query("update listas set  estado='U',surtido='S',horasurtido='".date('YmdHis')."',numero_servicio='".$numero_servicio."',litros_surtidos='".$litros_surtidos."',importe_gas='".$importe_gas."',importe_aditivo='".$importe_aditivo."',importe_descuento='".importe_descuento."',forma_de_pago='".$forma_de_pago."',hora_inicio='".$hora_inicio."',hora_final='".$hora_final."',porcentaje_tanque_cliente='".$porcentaje_tanque_cliente."',fecha_compromiso='".$fecha_compromiso."',porcentaje_tanque='".$porcentaje_tanque."',porcentaje_tanque_carburacion='".$porcentaje_tanque_carburacion."',puntos_ganados='".$puntos_ganados."',puntos_oro_ganados='".$puntos_oro_ganados."',tipo_de_venta='".$tipo_de_venta."',numero_de_nota='".$numero_de_nota."',capacid='".$capacidad_tanque_cliente."',alarma_ra='".$alarma_ra."',constante_calibracion='".$constante_calibracion."',porcentaje_final='".$porcentaje_final."',puntos_utilizados='".$puntos_utilizados."',linea_captura='".$linea_captura."' where ncontrol=".$numero_control);
					
					if ($latitud!="" && $longitud!="")
					{
						$resultado2 = $link->query("update listas set  verificado=1,latitud='".$latitud."',longitud='".$longitud."' where verificado=0 and ncontrol=".$numero_control);
					}
					
					if($resultado>=1)
					{
						return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio',1);
					}
					else
					{
						$respuesta=  '{"error":-1,"message":"no se pudo guardar la informacion del surtido"}';
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
			$sql="update litrogas set marca=1 where folio in (".$folio_litrogas.")";
			
			$respuesta=  '{"error":-1,"message":"Error Interno ('.$sql.')"}';
		}
		return  $respuesta;		
	} 
}
?>