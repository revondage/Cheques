<?php
for ($i=1; $i<=6; $i++) { 
    $valornip.=mt_rand(1,9); 
}
	
// $valores = array("9","8","7","6","5","4","3","2","1");

// $arreglo = array();

// while(count($arreglo) < 6) {$x = mt_rand(0, count($valores)-1);if(!in_array($x, $arreglo)){$arreglo[] = $x;}}

// foreach($arreglo as $vuelta){$valornip .= $valores[$vuelta];}

echo $valornip;
?>