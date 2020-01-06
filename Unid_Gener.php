<?php

	$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA")
	or die ("Problemas con la conexión");

	$la_central = $_POST['central'];

	$registros=mysqli_query($conexion,
			'SELECT Cod_unidad
			 FROM unidad_generadora
			 WHERE Cod_central = '. $la_central .'
			 ORDER BY Cod_unidad ASC')
	or die("Problemas en la consulta".mysqli_error($conexion));

	mysqli_close($conexion);

	echo '<option value="0">Seleccione</option>'. "\n";

	while ($reg=mysqli_fetch_array($registros))
	{
		echo '<option value="' . $reg['Cod_unidad']. '">' . $reg['Cod_unidad'] . '</option>' . "\n";
	}

?>
