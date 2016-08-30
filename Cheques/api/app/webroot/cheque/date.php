<?php
$fecha = "02-03-2010";
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha=strtotime($fecha);
$fecha=strftime("%d de %B de %Y",$fecha);
$fecha=strtoupper($fecha);
echo $fecha;
?>
