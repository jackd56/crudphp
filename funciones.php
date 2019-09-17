<?php
	function conexion(){
		try{
			$conexion = new PDO('mysql:host=localhost;dbname=GestionActivos','root','');
			return $conexion;
		}catch(PDOException $e){
			return false;
		}
	}
	function limpiarDatos($datos){
		$datos = trim($datos);
		$datos = stripslashes($datos);
		$datos = htmlspecialchars($datos);
		return $datos;
	}
	function id_numeros($id){
		return (int)limpiarDatos($id);
	}
		function obtener_id($conexion,$id){
		$resultado = $conexion->query("SELECT * FROM ACTIVOS WHERE ID = $id LIMIT 1");
		$resultado = $resultado->fetchAll();
		return ($resultado) ? $resultado : false;
	}
?>