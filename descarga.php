<?php 
	//$theFile=basename($Fichero);
         
         header("Content-Disposition:attachment;filename=excel.xls");
         header("Content-Type:application/vnd.ms-excel");
         header("Content-Transfer-Encoding: binary");

         function conectar(){
	$usuario = "trafalgar";
	$password = "Trafalgar2019*";
	$servidor = "localhost";
	$basededatos = "prueba1";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	// Selección del a base de datos a utilizar
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );


return $conexion;
}

function desconectar($conexion){
	mysqli_close( $conexion );
}

function datos(){
	//error_reporting(0);
	$conexion=conectar();

	$consulta = "SELECT * from datos limit 10";

	//echo "<pre>".print_r($consulta)."</pre>";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);
	$search=array();
	$replace=array();
	echo "<table border=1>";
	while ($columna = mysqli_fetch_array( $resultado ))
	{
		echo "<tr><td>".$columna[1]."</td>";
		echo "<td>".$columna[2]."</td></tr>";
	}
	desconectar($conexion);
}
datos();
         ?>