<?php

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


function soap(){
error_reporting(0);

//ini_set('display_errors', true);
//ini_set('display_startup_errors', true);

$location = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/ServiciosAZDigital.wsdl";
 $uri      = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php";
   $url = $location;
   try {

   $client = new SoapClient($url,[ "trace" => 1 ]);
   $client->__setLocation($uri);
    
$p1='FechaInicial';
$p2='2019-07-01 00:00:00';
$parametros=array('Tipo'=>$p1, 'Expresion'=>$p2);
   
   //var_dump($client->__getFunctions()); 
   //var_dump($client->__getTypes());


   //$para=['Condiciones'=>['Condicion'=>['Tipo'=>$p1, "Expresion" => "2019-07-01 00:00:00"]]];
                
class myObject  
{
  public function __set($name, $value) {
    $this->{$name} = $value;
  }
}

$obj = new myObject;

$obj->Condiciones->Condicion = array('Tipo'=>'FechaInicial', 'Expresion' => '2019-07-01 00:00:00');

//var_dump($obj);
//print_r($obj);


   //$result =$client->BuscarArchivo( [$obj]);
   $result = $client->__soapCall("BuscarArchivo",array($obj));
   
   /*echo "<pre>";
   echo print_r($result);
   echo "</pre>";*/
   //var_dump($result);

foreach ($result as $obj){

    $dat=$obj;
}

$data = json_decode(json_encode($dat), true);
//print_r($data);

for ($i=0; $i <count($data) ; $i++) { 
	//echo $data[$i]['Id']." -- ".$data[$i]['Nombre']."<br>";
	guardar($data[$i]['Id'],substr($data[$i]['Nombre'],0,-3),substr($data[$i]['Nombre'], -3));
}

	echo '<script type="text/javascript">
			alert("Se lee WS");
		</script>';

	echo "<table>";
	echo "<tr><th>Datos leidos</th></tr>";
	echo "</table>";


  }

  catch(Exception $e) 

  {

   die($e->getMessage());
  }
}



function guardar($id,$nom,$ext){
	$conexion=conectar();

	$consulta = "INSERT INTO datos (idarchivo,info)VALUES('".$id."','".$nom."')";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);

	$consulta = "INSERT INTO ext (idarchivo,extencion)VALUES('".$id."','".$ext."')";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);
	
	desconectar($conexion);
}

function borrar(){
	$conexion=conectar();

	$consulta = "TRUNCATE TABLE datos;";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);

	$consulta = "TRUNCATE TABLE ext;";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);
	
	desconectar($conexion);
}


function consulta1(){
	$conexion=conectar();

	$consulta = "SELECT * from datos d INNER JOIN ext e ON d.idarchivo = e.idarchivo";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);
	$cantidad=mysqli_num_rows($resultado);

	if ($cantidad<=0) {
	echo "<table>";
	echo "<tr><th>No hay datos</th></tr>";
	echo "</table>";
	}else{
	echo "<table>";
	echo "<tr><th colspan=4>Consultar Ws</th></tr>";
	echo "<tr>";

	echo "<th>No</th>";
	echo "<th>Idarchivo</th>";
	echo "<th>Descripcion</th>";
	echo "<th>Extencion</th>";
	echo "</tr>";
	$c=1;
	while ($columna = mysqli_fetch_array( $resultado ))
	{
		echo "<tr>";
		echo "<td>";
		echo $c;
		$c++;
		echo "</td>";

		echo "<td>";
		echo $columna['idarchivo'];
		echo "</td>";

		echo "<td>";
		echo $columna['info'];
		echo "</td>";

		echo "<td>";
		echo $columna['extencion'];
		echo "</td>";
		echo "</tr>";
	}

	echo "</table>";
	}
	desconectar($conexion);
}

function consulta2(){
	$conexion=conectar();

	$consulta = "SELECT extencion, COUNT(*) as total  from ext  GROUP BY extencion;";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos".$consulta);
	$cantidad=mysqli_num_rows($resultado);

	if ($cantidad<=0) {
	echo "<table>";
	echo "<tr><th>No hay datos</th></tr>";
	echo "</table>";
	}else{
	
	echo "<table>";
	echo "<tr><th colspan=3>Consultar Ws</th></tr>";
	echo "<tr>";

	echo "<tr>";
	echo "<th>No</th>";
	echo "<th>Extencion</th>";
	echo "<th>Total</th>";
	echo "</tr>";
	$c=1;
	while ($columna = mysqli_fetch_array( $resultado ))
	{
		echo "<tr>";
		echo "<td>";
		echo $c;
		$c++;
		echo "</td>";

		echo "<td>";
		echo $columna['extencion'];
		echo "</td>";

		echo "<td>";
		echo $columna['total'];
		echo "</td>";
		
	}

	echo "</table>";
	}
	desconectar($conexion);
}

function nom(){
	?>
	<table>
		<tr>
			<td>Jerson Stiven Olaya A</td>
		</tr>
		<tr>
			<td>Tel: 320 848 5836 o 322 904 7920</td>
		</tr>
		<tr>
			<td><a href="mailto:jsolaya1@gmail.com">jsolaya1@gmail.com</a> </td>
		</tr>
		<tr>
			<td>Ing de sistemas</td>
		</tr>
	</table>
	<?php
}

//phpinfo()




?>