<?php

require_once('../lib/mpdf.php'); //solicita la libreria


$html= '<header>
  <img src="img/logo.jpg" width="35%" alt="">
  <hr>
  <h1>Detalle de la información de una central de generación</h1>
  <hr>
</header>
<div id="project">
  <div><span></span>BRYAN BOSVELY </div>
  <div><span></span> MAYEN MOLINA</div>
  <div><span></span> 0905-08-13357</div>
  <div><span></span> <a href="bmayer182">bmayer182@gmail.com</a></div>
  <hr>


  <table class="tablareport">
    <tr>
      <th>NOMBRE </th><th>UBICACION </th><th> REGION </th><th> FECHA </th><th> CAPACIDAD NOMINAL</th>
      <th>CAPACIDAD REAL</th><th> TIPO DE GENERACION </th><th>TIPO DE TECNOLOGIA </th><th> ESTADO </th>
    </tr>';
      //$conexion=mysqli_connect("sql100.mipropia.com", "mipc_20849719", "78442792", "mipc_20849719_CONTROL_ENERGIA");
    $conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA");
  $resultado = mysqli_query($conexion,
      "SELECT central_generadora.Nombre, central_generadora.Ubicacion, region.Nombre_region,
      SUM(unidad_generadora.Capacidad_Nominal) AS c_nominal, unidad_generadora.Estado, interrogacion.fecha,
      SUM(interrogacion.Capacidad_Real) AS c_real, tipo_generacion.Nombre_Tipo_G, tipo_tecnologia.Nombre_Tecnologia
      FROM central_generadora, region, unidad_generadora,interrogacion, tipo_generacion,tipo_tecnologia
      WHERE central_generadora.Cod_region=region.Cod_region
      AND central_generadora.Cod_central=unidad_generadora.Cod_central
      AND unidad_generadora.Cod_unidad=interrogacion.Cod_Unidad
      AND unidad_generadora.Cod_Tipo_G=tipo_generacion.Cod_Tipo_G
      AND tipo_generacion.cod_tecnologia=tipo_tecnologia.Cod_tecnologia
      GROUP BY central_generadora.Nombre");


  while ($consulta= mysqli_fetch_array($resultado)) {


    $html.='
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
$html .='  </table>
  <br>
<footer>
<hr>
<p>CONOCEREIS LA VERDAD Y LA VERDAD OS HARA LIBRES </p>
<hr>
</footer>';


//se crea el constructor

$mpdf = new mPDF('c', 'A4'); //se espesifica los valores de la pagina
//$css=file_get_contents('css/style.css');
//$mpdf->writeHTML($css, 1);  //asignamos la hoja de estilos
$mpdf->writeHTML($html); //permite escribir html al objeto simplexml_load_file
$mpdf->output('reporte.pdf', 'I');



  mysqli_close($conexion);


 ?>
