<?php
function Conexion()
{
	$servidor = "10.1.1.18";
	$usuario = "j_casas";
	$contra = "pyansa";
	$base = "tabletas";
	
	$link = @mysql_connect($servidor,$usuario,$contra);
		
	if(!$link)
	{
		return false;
		//echo "Error al conectarse al servidor";
		//die();
	}
	if(!@mysql_select_db($base,$link))
	{
		return false;
		//echo "Error al conectarse a la base de datos";
		//die();
	}
	@mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'",$link);	
	return $link;
}

function Conexion_cpipas()
{
	$servidor = "10.1.1.18";
	$usuario = "j_casas";
	$contra = "pyansa";
	$base = "cpipas";
	
	$link = @mysql_connect($servidor,$usuario,$contra);
		
	if(!$link)
	{
		return false;
		//die();
	}
	if(!@mysql_select_db($base,$link))
	{
		return false;
		//die();
	}
	@mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'",$link);	
	return $link;
}
function Conexion2($servidor,$usuario,$contra,$base)
{
		
	$link = @mysql_connect($servidor,$usuario,$contra);
		
	if(!$link)
	{
		return false;
		//die();
	}
	if(!@mysql_select_db($base,$link))
	{
		return false;
		//die();
	}
	@mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'",$link);	
	return $link;
}


function bloqueo($link) 
{
	mysql_query("SET AUTOCOMMIT=0",$link);
	mysql_query("START TRANSACTION",$link);
}

function commit($link)
{
	mysql_query("COMMIT",$link);
}

function rollback($link)
{
	mysql_query("ROLLBACK",$link);
}

function reemplaza($dato)
{
	$dato=str_replace("&","&amp;",$dato);
	return $dato;
}
function linea_captura($servicio,$camion)
{
	$servicio=ceros((4-strlen($servicio))).$servicio;
	$camion=ceros((4-strlen($camion))).$camion;
	
	$seg=date('s');
	$min=date('i');
	$hora=date('hh');
	$dia=date('d');
	
	$base=$servicio.$seg.$min.$hora.$dia;
	
	$llave=((1/$base));
	$expo=explode('-',$llave);
	$mil='1'.ceros($expo[1]);
	$llave=(((1/$base))*$mil);

	$llave=number_format($llave,15);
	$divicion_ex=explode('.',$llave);
	$llave=$divicion_ex[1];	
		
	return $camion.$llave;
}
function ceros($cuantos)
{
	if ($cuantos>0)
	{
		$valor="";
		for($x=0;$x<$cuantos;$x++)
		{
			if ($valor=="")
			$valor="0";
			else
			$valor=$valor."0";
		}
	}
	return $valor;
}
	
 ?>