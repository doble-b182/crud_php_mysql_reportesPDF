<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>GENERADORA ELECTRICA</title>
		<link href="style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="functions.js"></script>
		</head>

  <body>
		<header>
		  <div class="">
		    <img  class="logo" src="IMG/logo2energia.jpg" width="20%" alt="logotipo" align="">
		  </div>
		    <nav>
		      <ul>
		        <li><a href="index.php">inicio</a></li>
		        <li><a href="Ingreso.php">ingreso de informacion</a></li>
		        <li><a href="reportes.php">reportes</a></li>
		      </ul>
		    </nav>
		  </header>

	<form class="" action="guardar_real.php" method="post">
	<div Class="Seccion">
		<table width="100%">
			<tr>
				<td>
    			<h2>Central Generadora:</h2>
		 <!--select cenetral generadora -->
					<select class="Cen_gen" name="Cen_gen" id="Cen_gen">
						<option value="0">Seleccione</option>
        	</select>
				</td>
				<td>
					<h2>Unidad Generadora</h2>
		<!--select unidad generadora -->
					<select class="unid_gen" name="unid_gen" id="unid_gen">
						<option value="0">Seleccione</option>
					</select>
				</td>
			</tr>
		</table>
		<!--datos de la unidad generadora -->
		<center>
			<table id="datos_unidad" border-radius="1px" border= "2px">
			</table>
		</center>
	</div>
    </form>
		<br>
		<footer>
		  <p>PROYECTO SEMIMINARIO DE PRIVADO SEGUDDA FASE UNIVERSIDAD MARIANO GALVEZ, JUTIAPA INGENIERIA EN SISTEMAS</p>
		</footer>
  </body>
</html>
