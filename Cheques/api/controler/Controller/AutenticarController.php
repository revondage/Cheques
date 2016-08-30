<?php
class AutenticarController extends AppController{
	public function autenticar($link,$key,$sv600_id,$funcion)
	{
		try
		{
			//$resultado = $link->query("select * from sistema_key where sistema_key='".$key."'and funcion='".$funcion."'");
			$resultado = $link->query("select * from sistema_key where sistema_key='".$key."'");
			$rows= count($resultado);	
			$resultado_entrada =$link->query("insert into bitacora_entradas(sv600_id,sistema_key,funcion,fecha,hora,acceso) values('".$sv600_id."','".$key."','".$funcion."','".date('Y-m-d')."','".date('H:i:s')."','".$rows."')");
			
			return $rows;
		}
		catch(Exception $ex)
		{
			return 0;
		}
	}
}
?>