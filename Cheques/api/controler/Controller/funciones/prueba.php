<?php
prueba();
function prueba()
{
	include('conexion.php');
	$link = Conexion_tabletas();
	$sql="replace into posiciones (unidad,sv600,fecha,latitud,longitud,velocidad,rssi) values ('731','707f1f803c','2014-08-11 13:03:53','23.2324566','-106.3921033','0.00','102')";
	mysql_query($sql,$link);
	mysql_close($link);
	echo "guardado";
} 
?>