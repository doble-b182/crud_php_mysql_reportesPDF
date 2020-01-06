<?php

	$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA") or
		die("Problemas con la conexión");

	$registros=mysqli_query($conexion,
		"SELECT Nombre, Cod_central
		FROM central_generadora")
	or die("Problemas en la consulta".mysqli_error($conexion));

	mysqli_close($conexion);

echo '<option value="0">Seleccione</option>'."\n";

while ($reg=mysqli_fetch_array($registros))
{
	echo '<option value="' . $reg['Cod_central']. '">' . $reg['Nombre'] . '</option>' . "\n";
}
?>
