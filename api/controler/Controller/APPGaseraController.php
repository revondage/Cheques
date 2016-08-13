<?php
class APPGaseraController extends AppController {
	
	var $components = array('RequestHandler');
        
	public function index()
	{	
		
		//$db=$this->conexion();
		//debug($db->query('select * from usuarios', array('usuarios')));
	}
		
	public function service() {
		//$this->layout = false;
		$this->autoRender = false;
		Configure::write('debug', 0);
		ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
		$server = new SoapServer('wsdl/APPServicios.wsdl');
		//$server->setPersistence(SOAP_PERSISTENCE_SESSION);
		$server->setClass('APPFuncionesController');
		$server->handle();
	}	
}

class APPFuncionesController extends AppController{
	
	function login($key,$sv600_id,$usuario,$password)
	{
		App::uses('LoginController','Controller');
		$LoginController = new LoginController;
		return $LoginController->login_fn($key,$sv600_id,$usuario,$password,'login');
	}
	
	function login_out($key,$sv600_id,$usuario,$password)
	{
		App::uses('LoginOutController','Controller');
		$LoginOutController = new LoginOutController;
		return $LoginOutController->login_out_fn($key,$sv600_id,$usuario,$password,'login_out');
	}
	  
	function posicion($key,$sv600_id,$latitud,$longitud,$rssi)
	{
		App::uses('PosicionController','Controller');
		$PosicionController = new PosicionController;
		return $PosicionController->posicion_fn($key,$sv600_id,$latitud,$longitud,$rssi,'posicion');
	}
	
	function asigna_valores($key,$sv600_id)
	{
		App::uses('AsignaValoresController','Controller');
		$AsignaValoresController = new AsignaValoresController;
		return $AsignaValoresController->asigna_valores_fn($key,$sv600_id,'asigna_valores');
	}
	
	function tabla_puntos($key,$sv600_id)
	{
		App::uses('TablaPuntosController','Controller');
		$TablaPuntosController = new TablaPuntosController;
		return $TablaPuntosController->tabla_puntos_fn($key,$sv600_id,'tabla_puntos');
	}
	
	function tabla_puntos_oro($key,$sv600_id)
	{
		App::uses('TablaPuntosOroController','Controller');
		$TablaPuntosOroController = new TablaPuntosOroController;
		return $TablaPuntosOroController->tabla_puntos_oro_fn($key,$sv600_id,'tabla_puntos_oro');
	}
	
	function tabla_pagofacil($key,$sv600_id)
	{
		App::uses('TablaPagofacilController','Controller');
		$TablaPagofacilController = new TablaPagofacilController;
		return $TablaPagofacilController->tabla_pagofacil_fn($key,$sv600_id,'tabla_pagofacil');
	}
	
	function inicio_ruta($key,$sv600_id,$porcentaje_tanque,$porcentaje_tanque_carburacion,$odometro,$horometro)
	{
		App::uses('InicioRutaController','Controller');
		$InicioRutaController = new InicioRutaController;
		return $InicioRutaController->inicio_ruta_fn($key,$sv600_id,$porcentaje_tanque,$porcentaje_tanque_carburacion,$odometro,$horometro,'inicio_ruta');
	}
	
	function solicitar_servicio($key,$sv600_id)
	{
		App::uses('SolicitarServicioController','Controller');
		$SolicitarServicioController = new SolicitarServicioController;
		return $SolicitarServicioController->solicitar_servicio_fn($key,$sv600_id,'solicitar_servicio');
	}
	
	function no_surtido($key,$sv600_id,$numero_control,$motivo,$porcentaje_tanque,$fecha_compromiso)
	{
		App::uses('NoSurtidoController','Controller');
		$NoSurtidoController = new NoSurtidoController;
		return $NoSurtidoController->no_surtido_fn($key,$sv600_id,$numero_control,$motivo,$porcentaje_tanque,$fecha_compromiso,'no_surtido');
	}
	
	function finalizar_surtido($key,$sv600_id,$numero_control,$numero_servicio,$litros_surtidos,$importe_gas,$importe_aditivo,$importe_descuento,$forma_de_pago,$hora_inicio,$hora_final,$porcentaje_tanque_cliente,$fecha_compromiso,$porcentaje_tanque,$porcentaje_tanque_carburacion,$puntos_ganados,$puntos_oro_ganados,$tipo_de_venta,$numero_de_nota,$capacidad_tanque_cliente,$alarma_ra,$constante_calibracion,$porcentaje_final,$puntos_utilizados,$latitud,$longitud,$folio_litrogas,$linea_captura)
	{
		App::uses('FinalizarSurtidoController','Controller');
		$FinalizarSurtidoController = new FinalizarSurtidoController;
		return $FinalizarSurtidoController->finalizar_surtido_fn($key,$sv600_id,$numero_control,$numero_servicio,$litros_surtidos,$importe_gas,$importe_aditivo,$importe_descuento,$forma_de_pago,$hora_inicio,$hora_final,$porcentaje_tanque_cliente,$fecha_compromiso,$porcentaje_tanque,$porcentaje_tanque_carburacion,$puntos_ganados,$puntos_oro_ganados,$tipo_de_venta,$numero_de_nota,$capacidad_tanque_cliente,$alarma_ra,$constante_calibracion,$porcentaje_final,$puntos_utilizados,$latitud,$longitud,$folio_litrogas,$linea_captura,'finalizar_surtido');
	}
	
	function arribo_domicilio($key,$sv600_id,$numero_control,$odometro)
	{
		App::uses('ArriboDomicilioController','Controller');
		$ArriboDomicilioController = new ArriboDomicilioController;
		return $ArriboDomicilioController->arribo_domicilio_fn($key,$sv600_id,$numero_control,$odometro,'arribo_domicilio');
	}
	
	function solicitar_permiso($key,$sv600_id)
	{
		App::uses('SolicitarPermisoController','Controller');
		$SolicitarPermisoController = new SolicitarPermisoController;
		return $SolicitarPermisoController->solicitar_permiso_fn($key,$sv600_id,'solicitar_permiso');
	}
	
	function volver_actividad($key,$sv600_id)
	{
		App::uses('VolverActividadController','Controller');
		$VolverActividadController = new VolverActividadController;
		return $VolverActividadController->volver_actividad_fn($key,$sv600_id,'volver_actividad');
	}
	
	function venta_ruteo($key,$sv600_id)
	{
		App::uses('VentaRuteoController','Controller');
		$VentaRuteoController = new VentaRuteoController;
		return $VentaRuteoController->venta_ruteo_fn($key,$sv600_id,'venta_ruteo');
	}
	
	function alarmas($key,$sv600_id,$alarma)
	{
		App::uses('AlarmasController','Controller');
		$AlarmasController = new AlarmasController;
		return $AlarmasController->alarmas_fn($key,$sv600_id,$alarma,'alarmas');
	}
	
	
	function fin_de_ruta($key,$sv600_id,$totalizador,$odometro,$porcentaje_tanque,$porcentaje_tanque_carburacion,$carga_bateria,$reservado)
	{
		App::uses('FinDeRutaController','Controller');
		$FinDeRutaController = new FinDeRutaController;
		return $FinDeRutaController->fin_de_ruta_fn($key,$sv600_id,$totalizador,$odometro,$porcentaje_tanque,$porcentaje_tanque_carburacion,$carga_bateria,$reservado,'fin_de_ruta');
	}
	
	function tipo_cliente($key,$sv600_id)
	{
		App::uses('TipoClienteController','Controller');
		$TipoClienteController = new TipoClienteController;
		return $TipoClienteController->tipo_cliente_fn($key,$sv600_id,'tipo_cliente');
	}
	
	function forma_pago($key,$sv600_id)
	{
		App::uses('FormaPagoController','Controller');
		$FormaPagoController = new FormaPagoController;
		return $FormaPagoController->forma_pago_fn($key,$sv600_id,'forma_pago');
	}
	
	function motivo($key,$sv600_id)
	{
		App::uses('MotivosController','Controller');
		$MotivosController = new MotivosController;
		return $MotivosController->motivo_fn($key,$sv600_id,'motivo');
	}
	
	function tipo_venta($key,$sv600_id)
	{
		App::uses('TipoVentaController','Controller');
		$TipoVentaController = new TipoVentaController;
		return $TipoVentaController->tipo_venta_fn($key,$sv600_id,'tipo_venta');
	}
}
?>