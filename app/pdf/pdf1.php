<?php

require_once('../lib/mpdf.php'); //solicita la libreria


$html= '<header>
  <img src="img/logo.jpg" width="35%" alt="">
  <hr>
  <h1>Lista de centrales de generación</h1>
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
      <th> NOMBRE </th><th> UBICACION </th><th> REGION </th>
    </tr>';
    //$conexion=mysqli_connect("sql100.mipropia.com", "mipc_20849719", "78442792", "mipc_20849719_CONTROL_ENERGIA");
    $conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA");
  $resultado = mysqli_query($conexion,
      "SELECT Nombre, Ubicacion, Nombre_region
  FROM central_generadora, region
  WHERE central_generadora.Cod_region= region.Cod_region");
  while ($consulta= mysqli_fetch_array($resultado)) {
    $html.='
      <tr>
        <td> '.
          $consulta['Nombre'] .
      ' </td>
        <td> '.
          $consulta['Ubicacion'].
      ' <td>'.
        $consulta['Nombre_region'].'</td>'.
    '</tr>';
}
mysqli_close($conexion);
$html .='  </table>
  <br>
<footer>
<hr>
<p>CONOCEREIS LA VERDAD Y LA VERDAD OS HARA LIBRES</p>
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
