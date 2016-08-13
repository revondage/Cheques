<wsdl:definitions xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:tns="app:servicios" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns="http://schemas.xmlsoap.org/wsdl/" targetNamespace="app:servicios">
<wsdl:types>
<xsd:schema targetNamespace="app:servicios"
>
 <xsd:import namespace="http://schemas.xmlsoap.org/soap/encoding/" />
 <xsd:import namespace="http://schemas.xmlsoap.org/wsdl/" />
</xsd:schema>
</wsdl:types>
<wsdl:message name="loginRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="usuario" type="xsd:int" />
  <wsdl:part name="password" type="xsd:int" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="loginResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="login_outRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="usuario" type="xsd:int" />
  <wsdl:part name="password" type="xsd:int" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="login_outResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="posicionRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="latitud" type="xsd:string" />
  <wsdl:part name="longitud" type="xsd:string" />
  <wsdl:part name="rssi" type="xsd:int" /></wsdl:message>
<wsdl:message name="posicionResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="asigna_valoresRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="asigna_valoresResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_puntosRequest">
  <wsdl:part name="key" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_puntosResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_puntos_oroRequest">
  <wsdl:part name="key" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_puntos_oroResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_pagofacilRequest">
  <wsdl:part name="key" type="xsd:string" /></wsdl:message>
<wsdl:message name="tabla_pagofacilResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="inicio_rutaRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque_carburacion" type="xsd:int" />
  <wsdl:part name="odometro" type="xsd:int" />
  <wsdl:part name="horometro" type="xsd:int" /></wsdl:message>
<wsdl:message name="inicio_rutaResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="solicitar_servicioRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="solicitar_servicioResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="no_surtidoRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="numero_control" type="xsd:int" />
  <wsdl:part name="motivo" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque" type="xsd:int" />
  <wsdl:part name="fecha_compromiso" type="xsd:date" /></wsdl:message>
<wsdl:message name="no_surtidoResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="realizar_surtidoRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="numero_control" type="xsd:int" />
  <wsdl:part name="numero_servicio" type="xsd:int" />
  <wsdl:part name="litros_surtidos" type="xsd:decimal" />
  <wsdl:part name="importe_gas" type="xsd:decimal" />
  <wsdl:part name="importe_aditivo" type="xsd:decimal" />
  <wsdl:part name="importe_descuento" type="xsd:decimal" />
  <wsdl:part name="forma_de_pago" type="xsd:int" />
  <wsdl:part name="hora_inicio" type="xsd:datetime" />
  <wsdl:part name="hora_final" type="xsd:datetime" />
  <wsdl:part name="porcentaje_tanque_cliente" type="xsd:int" />
  <wsdl:part name="fecha_compromiso" type="xsd:date" />
  <wsdl:part name="porcentaje_tanque" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque_carburacion" type="xsd:int" />
  <wsdl:part name="puntos_ganados" type="xsd:int" />
  <wsdl:part name="puntos_oro_ganados" type="xsd:int" />
  <wsdl:part name="tipo_de_venta" type="xsd:string" />
  <wsdl:part name="numero_de_nota" type="xsd:int" />
  <wsdl:part name="capacidad_tanque_cliente" type="xsd:int" />
  <wsdl:part name="alarma_ra" type="xsd:int" />
  <wsdl:part name="constante_calibracion" type="xsd:string" /></wsdl:message>
<wsdl:message name="realizar_surtidoResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="arribo_domicilioRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="numero_control" type="xsd:int" />
  <wsdl:part name="odometro" type="xsd:int" /></wsdl:message>
<wsdl:message name="arribo_domicilioResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="solicitar_permisoRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="solicitar_permisoResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="alarmasRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="alarmasResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="fin_de_rutaRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" />
  <wsdl:part name="totalizador" type="xsd:int" />
  <wsdl:part name="odometro" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque" type="xsd:int" />
  <wsdl:part name="porcentaje_tanque_carburacion" type="xsd:int" />
  <wsdl:part name="carga_bateria" type="xsd:int" />
  <wsdl:part name="reservado" type="xsd:string" /></wsdl:message>
<wsdl:message name="fin_de_rutaResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:message name="venta_ruteoRequest">
  <wsdl:part name="key" type="xsd:string" />
  <wsdl:part name="sv600_id" type="xsd:int" /></wsdl:message>
<wsdl:message name="venta_ruteoResponse">
  <wsdl:part name="return" type="xsd:string" /></wsdl:message>
<wsdl:portType name="APPServiciosPortType">
  <wsdl:operation name="login">
    <wsdl:input message="tns:loginRequest"/>
    <wsdl:output message="tns:loginResponse"/>
  </wsdl:operation>
  <wsdl:operation name="login_out">
    <wsdl:input message="tns:login_outRequest"/>
    <wsdl:output message="tns:login_outResponse"/>
  </wsdl:operation>
  <wsdl:operation name="posicion">
    <wsdl:input message="tns:posicionRequest"/>
    <wsdl:output message="tns:posicionResponse"/>
  </wsdl:operation>
  <wsdl:operation name="asigna_valores">
    <wsdl:input message="tns:asigna_valoresRequest"/>
    <wsdl:output message="tns:asigna_valoresResponse"/>
  </wsdl:operation>
  <wsdl:operation name="tabla_puntos">
    <wsdl:input message="tns:tabla_puntosRequest"/>
    <wsdl:output message="tns:tabla_puntosResponse"/>
  </wsdl:operation>
  <wsdl:operation name="tabla_puntos_oro">
    <wsdl:input message="tns:tabla_puntos_oroRequest"/>
    <wsdl:output message="tns:tabla_puntos_oroResponse"/>
  </wsdl:operation>
  <wsdl:operation name="tabla_pagofacil">
    <wsdl:input message="tns:tabla_pagofacilRequest"/>
    <wsdl:output message="tns:tabla_pagofacilResponse"/>
  </wsdl:operation>
  <wsdl:operation name="inicio_ruta">
    <wsdl:input message="tns:inicio_rutaRequest"/>
    <wsdl:output message="tns:inicio_rutaResponse"/>
  </wsdl:operation>
  <wsdl:operation name="solicitar_servicio">
    <wsdl:input message="tns:solicitar_servicioRequest"/>
    <wsdl:output message="tns:solicitar_servicioResponse"/>
  </wsdl:operation>
  <wsdl:operation name="no_surtido">
    <wsdl:input message="tns:no_surtidoRequest"/>
    <wsdl:output message="tns:no_surtidoResponse"/>
  </wsdl:operation>
  <wsdl:operation name="realizar_surtido">
    <wsdl:input message="tns:realizar_surtidoRequest"/>
    <wsdl:output message="tns:realizar_surtidoResponse"/>
  </wsdl:operation>
  <wsdl:operation name="arribo_domicilio">
    <wsdl:input message="tns:arribo_domicilioRequest"/>
    <wsdl:output message="tns:arribo_domicilioResponse"/>
  </wsdl:operation>
  <wsdl:operation name="solicitar_permiso">
    <wsdl:input message="tns:solicitar_permisoRequest"/>
    <wsdl:output message="tns:solicitar_permisoResponse"/>
  </wsdl:operation>
  <wsdl:operation name="alarmas">
    <wsdl:input message="tns:alarmasRequest"/>
    <wsdl:output message="tns:alarmasResponse"/>
  </wsdl:operation>
  <wsdl:operation name="fin_de_ruta">
    <wsdl:input message="tns:fin_de_rutaRequest"/>
    <wsdl:output message="tns:fin_de_rutaResponse"/>
  </wsdl:operation>
  <wsdl:operation name="venta_ruteo">
    <wsdl:input message="tns:venta_ruteoRequest"/>
    <wsdl:output message="tns:venta_ruteoResponse"/>
  </wsdl:operation>
</wsdl:portType>
<wsdl:binding name="APPServiciosBinding" type="tns:APPServiciosPortType">
  <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
  <wsdl:operation name="login">
    <soap:operation soapAction="app:servicios#login_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:login_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:login_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="login_out">
    <soap:operation soapAction="app:servicios#login_out_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:login_out_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:login_out_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="posicion">
    <soap:operation soapAction="app:servicios#posicion_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:posicion_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:posicion_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="asigna_valores">
    <soap:operation soapAction="app:servicios#asigna_valores_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:asigna_valores_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:asigna_valores_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="tabla_puntos">
    <soap:operation soapAction="app:servicios#tabla_puntos_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:tabla_puntos_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:tabla_puntos_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="tabla_puntos_oro">
    <soap:operation soapAction="app:servicios#tabla_puntos_oro_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:tabla_puntos_oro_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:tabla_puntos_oro_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="tabla_pagofacil">
    <soap:operation soapAction="app:servicios#tabla_pagofacil_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:tabla_pagofacil_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:tabla_pagofacil_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="inicio_ruta">
    <soap:operation soapAction="app:servicios#inicio_ruta_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:inicio_ruta_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:inicio_ruta_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="solicitar_servicio">
    <soap:operation soapAction="app:servicios#solicitar_servicio_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:solicitar_servicio_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:solicitar_servicio_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="no_surtido">
    <soap:operation soapAction="app:servicios#no_surtido_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:no_surtido_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:no_surtido_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="realizar_surtido">
    <soap:operation soapAction="app:servicios#realizar_surtido_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:realizar_surtido_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:realizar_surtido_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="arribo_domicilio">
    <soap:operation soapAction="app:servicios#arribo_domicilio_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:arribo_domicilio_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:arribo_domicilio_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="solicitar_permiso">
    <soap:operation soapAction="app:servicios#solicitar_permiso_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:solicitar_permiso_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:solicitar_permiso_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="alarmas">
    <soap:operation soapAction="app:servicios#alarmas_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:alarmas_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:alarmas_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="fin_de_ruta">
    <soap:operation soapAction="app:servicios#fin_de_ruta_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:fin_de_ruta_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:fin_de_ruta_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
  <wsdl:operation name="venta_ruteo">
    <soap:operation soapAction="app:servicios#venta_ruteo_fn" style="rpc"/>
    <wsdl:input><soap:body use="encoded" namespace="app:venta_ruteo_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:input>
    <wsdl:output><soap:body use="encoded" namespace="app:venta_ruteo_fn" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></wsdl:output>
  </wsdl:operation>
</wsdl:binding>
<wsdl:service name="APPServicios">
  <wsdl:port name="APPServiciosPort" binding="tns:APPServiciosBinding">
    <soap:address location="http://10.1.1.18/web/htdocs/solemti/Posts/service"/>
  </wsdl:port>
</wsdl:service>
</wsdl:definitions>