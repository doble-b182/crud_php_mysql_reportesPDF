<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>REPORTES</title>
    <link rel="stylesheet" href="style.css">
    <STYLE>A {text-decoration: none;} </STYLE>
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

    <center>
<?php

// comienzan las sentencias para generar con la bd
//------------------------------sentencia numero 1
if (isset($_POST['btn1'])) {
  $conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA");

  $resultado = mysqli_query($conexion,
    "SELECT Nombre, Ubicacion, Nombre_region
FROM central_generadora, region
WHERE central_generadora.Cod_region= region.Cod_region");

  mysqli_close($conexion);

  echo '
    <table class="tablareport">
      <tr>
        <th> NOMBRE </th><th> UBICACION </th><th> NOMBRE DE REGION </th>
      </tr>';

  while ($consulta= mysqli_fetch_array($resultado)) {
        echo '
          <tr>
            <td> '. $consulta['Nombre'] .' </td>
            <td> '. $consulta['Ubicacion'] .'</td>
            <td> '. $consulta['Nombre_region'].'</td>'.
        '</tr>';
    }
    echo "</table>";
      echo '<center> <a class= "enboton" href="reportes.php">
            <input type="submit" name="" value=" Regresar ">
            </a></center>';

}
//------------------------------sentencia numero 2
elseif (isset($_POST['btn2'])) {

$central= $_POST['Cen_gen'];
if ($central == 0){
  echo '<h2> debes selecionar una central para poder ver los datos </h2>';
}else{
  $conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA");

  $resultado = mysqli_query($conexion,
    'SELECT Cod_unidad, Nombre_Tipo_G, Nombre_Tecnologia, Capacidad_Nominal, Estado
      from central_generadora, region, unidad_generadora, tipo_generacion, tipo_tecnologia
      WHERE central_generadora.Cod_region = region.Cod_region
      and central_generadora.Cod_central= unidad_generadora.Cod_central
      AND unidad_generadora.Cod_Tipo_G=tipo_generacion.Cod_Tipo_G
      AND tipo_generacion.cod_tecnologia=tipo_tecnologia.Cod_tecnologia
      AND central_generadora.Cod_central = '.$central);

  mysqli_close($conexion);

  echo '
    <table class="tablareport">
      <tr>
        <th> Codigo de unidad </th>
        <th> Tipo de generador </th>
        <th> Tipo de Tegnologia </th>
        <th> Capaciad Nominal</th>
        <th> Estado</th>
      </tr>';

  while ($consulta= mysqli_fetch_array($resultado)) {
      echo '
        <tr>
          <td>' . $consulta['Cod_unidad'] . '</td>' .
          '<td>' . $consulta['Nombre_Tipo_G'].'</td>'.
          '<td>' . $consulta['Nombre_Tecnologia'].'</td>
          <td>' . $consulta['Capacidad_Nominal'].'</td>
          <td>';

          if($consulta['Estado']=="1"){
            echo "Activo";
          }else{
            echo "En Reparación ";
          }
          echo '</td>
          </tr>';
    }
    echo '</table>';
  }
      echo '<center> <a class= "enboton" href="reportes.php">
            <input type="submit" name="" value=" Regresar ">
            </a></center>';
  }

//-------------------------------------------sentencia numero 3
elseif (isset($_POST ['btn3'])) {
  $conexion = mysqli_connect('localhost', 'root', '', 'CONTROL_ENERGIA');

$resultado = mysqli_query($conexion,'SELECT Nombre, sum(Capacidad_Nominal) as cap_nom, sum(Capacidad_Real) as cap_real
from central_generadora, unidad_generadora, interrogacion
WHERE central_generadora.Cod_central=unidad_generadora.Cod_central
AND unidad_generadora.Cod_unidad=interrogacion.Cod_Unidad
Group by nombre' );

mysqli_close($conexion);

echo '
  <table class="tablareport">
    <tr>
      <th> NOMBRE </th><th> CAPACIDAD NOMINAL </th><th> CAPACIDAD REAL </th>
    </tr>';

while ($consulta = mysqli_fetch_array($resultado) ) {
  echo '
   <tr>
    <td>' . $consulta['Nombre'] . '</td>' .
    '<td>' . $consulta['cap_nom'].'</td>'.
    '<td>' . $consulta['cap_real'].'</td>'.
  '</tr>';
}
  echo '</table>';
  echo "</table>";
    echo '<center> <a class= "enboton" href="reportes.php">
          <input type="submit" name="" value=" Regresar ">
          </a></center>';
}

//--------------------------------sentencia numero 4

elseif (isset($_POST['btn4'])) {
  $conexion = mysqli_connect('localhost', 'root', '', 'CONTROL_ENERGIA');

  $resultado = mysqli_query($conexion,
    'SELECT Nombre, unidad_generadora.Cod_unidad, Capacidad_Nominal, fecha, Capacidad_Real
    FROM central_generadora, unidad_generadora, interrogacion
    where central_generadora.Cod_central=unidad_generadora.Cod_central
    AND unidad_generadora.Cod_unidad=interrogacion.Cod_Unidad
    ORDER BY fecha DESC');

  mysqli_close($conexion);

echo '
  <table class="tablareport">
    <tr>
      <th> FECHA </th><th> NOMBRE </th><th> CAPACIDAD NOMINAL </th><th> CAPACIDAD REAL </th>
    </tr>';

  while ($consulta = mysqli_fetch_array($resultado)) {
    echo '
      <tr>
        <td>' . $consulta['fecha'] . '</td>' .
        '<td>' . $consulta['Nombre'].'</td>'.
        '<td>' . $consulta['Capacidad_Nominal'].'</td>'.
        '<td>' . $consulta['Capacidad_Real'].'</td>'
    . '</tr>';
  }
  echo '</table>';
  echo "</table>";
    echo '<center> <a class= "enboton" href="reportes.php">
          <input type="submit" name="" value=" Regresar ">
          </a></center>';
}

//-----------------------------------------------SENTENCIA NUMERO 5
elseif (isset($_POST['btn5'])) {
  $conexion = mysqli_connect('localhost', 'root', '', 'CONTROL_ENERGIA');

  $resultado = mysqli_query($conexion,
'SELECT central_generadora.Nombre, central_generadora.Ubicacion, region.Nombre_region,
SUM(unidad_generadora.Capacidad_Nominal) AS c_nominal, unidad_generadora.Estado, interrogacion.fecha,
SUM(interrogacion.Capacidad_Real) AS c_real, tipo_generacion.Nombre_Tipo_G, tipo_tecnologia.Nombre_Tecnologia
FROM central_generadora, region, unidad_generadora,interrogacion, tipo_generacion,tipo_tecnologia
WHERE central_generadora.Cod_region=region.Cod_region
AND central_generadora.Cod_central=unidad_generadora.Cod_central
AND unidad_generadora.Cod_unidad=interrogacion.Cod_Unidad
AND unidad_generadora.Cod_Tipo_G=tipo_generacion.Cod_Tipo_G
AND tipo_generacion.cod_tecnologia=tipo_tecnologia.Cod_tecnologia
GROUP BY central_generadora.Nombre');

echo '
  <table class="tablareport">
    <tr>
      <th>NOMBRE </th><th>UBICACION </th><th> REGION </th><th> FECHA </th><th> CAPACIDAD NOMINAL</th>
      <th>CAPACIDAD REAL</th><th> TIPO DE GENERACION </th><th>TIPO DE TECNOLOGIA </th><th> ESTADO </th>
    </tr>';
  while ($consulta = mysqli_fetch_array($resultado)) {
echo '
  <tr>
    <td> '. $consulta['Nombre'] . ' </td>
    <td> '. $consulta['Ubicacion'].'</td>
    <td> '. $consulta['Nombre_region'] .'</td>
    <td> '. $consulta['fecha'] . ' </td>
    <td> '. $consulta['c_nominal'].'</td>
    <td>'.  $consulta['c_real'].'</td>
    <td> '. $consulta['Nombre_Tipo_G'] .' </td>
    <td> '. $consulta['Nombre_Tecnologia'].'</td>
    <td> '. $consulta['Estado'].'</td>
</tr>';
  }
mysqli_close($conexion);
  echo '</table>';
  echo "</table>";
    echo '<center> <a class= "enboton" href="reportes.php">
          <input type="submit" name="" value=" Regresar ">
          </a></center>';

}else {
  ?>
  <form class="" action="reportes.php" method="post">
                                                                  <!-- BOTONES E IMAGENES PARA LOS REPORTES -->
  <input type="submit" name="btn1" value="CENTRALES DE GENERACION">
  <a href="app/pdf/pdf1.php" target="_blank"><img src="IMG/pdf1.ico" width='30px' alt=""></a><br />
  <label for="Cen_gen"> SELECCIONE UNA GENERADORA </label>

  <select class="generadora" name="Cen_gen" id="Cen_gen">
    <option value="0">Seleccione</option>
  </select>

  <input type="submit" class="btn2" name="btn2" value="TIPO DE UNIDADES POR CENTRAL">
  <a href="app/pdf/pdf2.php" target="_blank"><img src="IMG/pdf1.ico" width='30px' alt=""></a><br />
  <input type="submit" name="btn3" value="CENTRALES CON GENERACION NOMINAL Y REAL">
  <a href="app/pdf/pdf3.php" target="_blank"><img src="IMG/pdf1.ico" width='30px' alt=""></a><br />
  <input type="submit" name="btn4" value="FECHAS DE GENERACION REAL">
  <a href="app/pdf/pdf4.php" target="_blank"><img src="IMG/pdf1.ico" width='30px' alt=""></a><br />
  <input type="submit" name="btn5" value="DESCRIPCION DE CENTRAL GENERADORA">
  <a href="app/pdf/pdf5.php" target="_blank"><img src="IMG/pdf1.ico" width='30px' alt=""></a><br />

  </form>

  <?php
  }
    ?>
    <br>
    <footer>
      <p>PROYECTO SEMIMINARIO DE PRIVADO SEGUNDA FASE UNIVERSIDAD MARIANO GALVEZ,
       JUTIAPA INGENIERIA EN SISTEMAS</p>
    </footer>
    </center>
  </body>
</html>
