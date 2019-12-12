<?php
include ('funciones.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>AZDigital_Pruebas</title>
</head>
<link rel=StyleSheet href="style.css" title="Contemporaneo">
<body>

	<center>
		<?php
		nom();
		?>
		<table>
			<tr>
				<td>
					<form method="POST" action="">
						<input type="hidden" name="tipo" value="3">
						<button type="submit">Consumir WS</button>
					</form>
			    </td>


				<td>
					<form method="POST" action="">
						<input type="hidden" name="tipo" value="1">
						<button type="submit">Consultar lectura WS</button>
					</form>
			    </td>

			    <td>
			    	<form method="POST" action="">
						<input type="hidden" name="tipo" value="2">
						<button type="submit">Cantidad de archivos</button>
					</form>
			    </td>

			    <td>
			    	<form method="POST" action="">
						<input type="hidden" name="tipo" value="4">
						<button type="submit">Borrar tablas </button>
					</form>
			    </td>
			</tr>	
		</table>
	<br>
	<br>
	<?php
	
	//phpinfo()


if (empty($_POST)) {
	
}else{

	if ($_POST['tipo']==1) {
		consulta1();
	}elseif ($_POST['tipo']==2) {
		consulta2();
	}elseif ($_POST['tipo']==3) {
		borrar();
		soap();
	}elseif ($_POST['tipo']==4) {
		borrar();
		?>
		<script type="text/javascript">
			alert("Tablas borradas");
		</script>
		<table><tr><th>Tabla borrada</th></tr></table>
		 <?php
	}else{
		echo "error al enviar";
	}

}

	?>
	</center>
</body>
</html>
