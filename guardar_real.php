<html>
	<html>
		<head>
			<title>Insert PHP -insert-</title>
			<link href="style.css" rel="stylesheet">
		</head>
	<body>
		<header>
		  <div class="">
		    <img  class="logo" src="IMG/logo2energia.jpg" width="20%" alt="logotipo" align="">
		  </div>
		    <nav>
		      <ul>
		        <li><a href="inicio.php">inicio</a></li>
		        <li><a href="Ingreso.php">ingreso de informacion</a></li>
		        <li><a href="reportes.php">reportes</a></li>
		      </ul>
		    </nav>
		  </header>

			<section class="cuerpo">

		<?php
			if(isset($_POST['Guardar'])){

				$cap_real = $_POST['capacidad_real'];
				if($cap_real == ""){
					echo "<h2> no has ingresado valor en la capacidad real</h2><br>";
				}else {
					$cod_unidad = $_POST['unid_gen'];

					//$conexion=mysqli_connect("sql100.mipropia.com", "mipc_20849719", "78442792", "mipc_20849719_CONTROL_ENERGIA");
					$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA") or
					die("Problemas con la conexión");

					mysqli_query($conexion,"INSERT INTO interrogacion (Cod_Unidad, Capacidad_Real)
																	VALUES (
																	$cod_unidad,
																	$cap_real
																	)")
					or die("Problemas en la incersion de la capaciedad real ".mysqli_error($conexion));

					mysqli_close($conexion);

					echo "<h2>se ha ingresado la capacidad real con exito</h2>";
					echo "<br> * Codigo de Unidad : ".$cod_unidad;
					echo "<br> * Capacidad Real   : ".$cap_real;
				}
// asignar reparacion a la bd
			}elseif(isset($_POST['reparacion'])){
				$cod_unidad = $_POST['unid_gen'];

				$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA") or
				die("Problemas con la conexión");

				mysqli_query($conexion,"UPDATE unidad_generadora SET Estado = '0'
																WHERE Cod_unidad = ".$cod_unidad)
				or die("Problemas en el select".mysqli_error($conexion));

				mysqli_close($conexion);

				echo "<h2>La unidad a pasado a un estado de reparación</h2><br>";
				echo "<br>* Codigo de Unidad : ".$cod_unidad;
// asignar activacion a la bd
			}elseif(isset($_POST['Activacion'])){
				$cod_unidad = $_POST['unid_gen'];

				//$conexion=mysqli_connect("sql100.mipropia.com", "mipc_20849719", "78442792", "mipc_20849719_CONTROL_ENERGIA");
				$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA") or
				die("Problemas con la conexión");

				mysqli_query($conexion,"UPDATE unidad_generadora SET Estado = '1'
																WHERE Cod_unidad = ".$cod_unidad)
				or die("Problemas en el select".mysqli_error($conexion));

				mysqli_close($conexion);

				echo "<h2>La unidad a salido del estado de reparacion</h2><br>";
				echo "<br>* Codigo de Unidad : ".$cod_unidad;

// asignar mantenimiento a la bd
			}elseif(isset($_POST['mantenimiento'])){
				$cod_unidad = $_POST['unid_gen'];
				$fecha = $_POST['fecha'];

				//obtener fecha actual
				date_default_timezone_set('America/Guatemala');
				$fechaatual = date("Y-m-d");
				echo $fecha."<br>";
				if($fecha == ""){
					echo "<h2> No as ingresado una fecha para el mantenimiento </h2><br>";
				}elseif ($fecha < $fechaatual){
					echo "<h2>la fecha ingresada es menor a la actual,</h2><br>
								No puedes establecer una fecha de mantenimiento fuera de rango <br>
								intenta nuevamente";
				}else{
					$conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA") or
					die("Problemas con la conexión");

					mysqli_query($conexion,"INSERT INTO mantenimiento (Cod_Generadora, Fecha)
																VALUES (".$cod_unidad.",".
																				$fecha.")")
					or die("Problemas en la incersion del mantenimiento,
					puede ser que ya se se encuentre estalbecido un mantenimiento para esa fecha".
					mysqli_error($conexion));

					echo "<h2>se ha programado un estado de mantenimiento</h2><br>";
					echo "<br> * Codigo de Unidad : ".$cod_unidad;
					echo "<br> * fecha programada : ".$fecha;

				}
			};
			echo '<center> <a class= "enboton" href="Ingreso.php">
	          <input type="submit" name="" value=" Regresar ">
	          </a></center>';
		?>
	</section>
<br>
		<footer>
		  <p>PROYECTO SEMIMINARIO DE PRIVADO SEGUDDA FASE UNIVERSIDAD MARIANO GALVEZ, JUTIAPA INGENIERIA EN SISTEMAS</p>
		</footer>
	</body>
</html>
