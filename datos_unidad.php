<?php

	date_default_timezone_set('America/Guatemala');
	$fechaatual = date("Y-m-d");

	$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA")
	or die("Problemas con la conexión");

	$la_unidad = $_POST['unidad'];

	echo '<tr>
				<td>Codigo de la Generadora</td>
				<td>'. $la_unidad.'</td>
			</tr>';

	$registros=mysqli_query($conexion,
			'SELECT capacidad_nominal, Nombre_Tipo_G, Nombre_Tecnologia, Estado
			FROM unidad_generadora U, tipo_generacion TG, tipo_tecnologia TT
			WHERE U.Cod_Tipo_G = TG.Cod_Tipo_G
			AND TG.cod_tecnologia = TT.Cod_tecnologia
			AND U.Cod_unidad = '. $la_unidad )
	or die("Problemas en la consulta".mysqli_error($conexion));

	mysqli_close($conexion);

	$reg = mysqli_fetch_array($registros);

	echo '<tr>
				<td>Tipo de Generador</td>
				<td>'. $reg['Nombre_Tipo_G'].'</td>
			</tr>
			<tr>
				<td>Tipo de Tegnologia</td>
				<td>'. $reg['Nombre_Tecnologia'].'</td>
			</tr>
			<tr>
				<td>Capacidad Nominal</td>
				<td>'. $reg['capacidad_nominal'].'</td>
			</tr>
			<tr>
				<td>Estado </td>
				<td>';
		if($reg['Estado']=="1"){
			echo "Activo";
			echo '</td>
				</tr>
				<tr>
					<td colspan="2" >
						<label for="capacidad_real">Ingrese la Capacidad Real</label>
						<input type="text" name="capacidad_real" value="" placeholder="ingrese cantidad">
						<input type="submit" name="Guardar" value=" Guardar ">
					</td>
				</tr>
				<tr>
					<td colspan="2" >
						<label for="reparacion">Reporte si la unidad no esta funcionando</label>
						<input type="submit" name="reparacion" value=" Alertar Falla ">
					</td>
				</tr>
					<tr>
						<td colspan="2" >
							<input type="date" name="fecha" step="1" min="'.$fechaatual.'" max="2018-12-31" value="">
							<input type="submit" name="mantenimiento" value=" Programar Mantenimiento ">
						</td>
					</tr>';
		}else{
			echo "En Reparación ";

			echo '<input type="submit" name="Activacion" value=" Repraración finalizada ">';
			echo '</td>
				</tr>';
		};
?>
