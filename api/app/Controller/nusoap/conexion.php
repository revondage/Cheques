<?php
 	
	
	function Conexion()
	{
	
	$servidor = "10.1.1.212";
	$usuario = "j_casas";
	$contra = "pyansa";
	$base = "camiones";
	
	
		$link = mysql_connect($servidor,$usuario,$contra);
		
		if(!$link)
		{
			echo "Error al conectarse al servidor";
			die();
		}
		
		if(!mysql_select_db($base,$link))
		{
			echo "Error al conectarse a la base de datos";
			die();
		}
		
		return $link;
	} 
	
 ?>