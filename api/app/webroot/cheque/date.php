<meta charset='utf-8'>
<?php
$miFecha= gmmktime(12,0,0,1,15,2089);
echo 'Antes de setlocale strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';
echo 'Antes de setlocale date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
setlocale(LC_TIME,"es_ES");
echo 'Después de setlocale es_ES date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
echo 'Después de setlocale es_ES strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';
setlocale(LC_TIME, 'es_ES.UTF-8');
echo 'Después de setlocale es_ES.UTF-8 date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
echo 'Después de setlocale es_ES.UTF-8 strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';
setlocale(LC_TIME, 'de_DE.UTF-8');
echo 'Después de setlocale de_DE.UTF-8 date devuelve: '.date("l, d-m-Y (H:i:s)", $miFecha).'<br/>';
echo 'Después de setlocale de_DE.UTF-8 strftime devuelve: '.strftime("%A, %d de %B de %Y", $miFecha).'<br/>';

echo '<br/>';
// $miFecha= gmmktime(12,0,0,1,15,2089);
setlocale(LC_TIME, 'es_ES.UTF-8');
echo 'Después de setlocale es_ES.UTF-8 strftime devuelve: '.strftime("%A, %d de %B de %Y %H:%M", $miFecha).'<br/>';
echo 'Fecha actual: '.strftime("%A, %d de %B de %Y %H:%M").'<br/>';

date_default_timezone_set('America/Mazatlan');

echo 'Establecida zona horaria Europe/Madrid obtenemos: '.strftime("%A, %d de %B de %Y %H:%M", $miFecha).'<br/>';
echo 'Ahora fecha actual es: '.strftime("%A, %d de %B de %Y %H:%M").'<br/>';

?>
