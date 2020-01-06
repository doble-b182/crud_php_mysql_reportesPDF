<?php

require_once('../lib/mpdf.php'); //solicita la libreria


$html= '<header>
  <img src="img/logo.jpg" width="25%" alt="">
  <hr>
  <h1>Lista de centrales de generación</h1>
  <hr>
</header>
<div id="project">
  <div><span></span>BRYAN BOSVELY </div>
  <div><span></span> MAYEN MOLINA</div>
  <div><span></span> 0905-08-13357</div>
  <div><span></span> <a href="bmayer182">bmayer182@gmail.com</a></div>
  <hr>';
    //$conexion=mysqli_connect("sql100.mipropia.com", "mipc_20849719", "78442792", "mipc_20849719_CONTROL_ENERGIA");
    $conexion=mysqli_connect("localhost","root","","CONTROL_ENERGIA");
  $resultado = mysqli_query($conexion,
      "SELECT Nombre, Nombre_region, Cod_unidad, Nombre_Tipo_G, Nombre_Tecnologia, Capacidad_Nominal, Estado
        from central_generadora, region, unidad_generadora, tipo_generacion, tipo_tecnologia
        WHERE central_generadora.Cod_region = region.Cod_region
        and central_generadora.Cod_central= unidad_generadora.Cod_central
        AND unidad_generadora.Cod_Tipo_G=tipo_generacion.Cod_Tipo_G
        AND tipo_generacion.cod_tecnologia=tipo_tecnologia.Cod_tecnologia");

$html.='
      <table class="tablareport">
        <tr>
          <th> NOMBRE </th>
          <th> NOMBRE DE REGION </th>
          <th> CODIGO DE UNIDAD </th>
          <th> NOBRE DE GENERADORA </th>
          <th> TIPO DE TECNOLOGIA</th>
          <th> CAPACIDAD NOMINAL</th>
          <th> ESTADO</th>
        </tr>';

    while ($consulta= mysqli_fetch_array($resultado)) {
        $html.='
          <tr>
          <td>' . $consulta['Nombre'].'</td>'.
          '<td>' . $consulta['Nombre_region'].'</td>'.
           '<td>' . $consulta['Cod_unidad'] . '</td>' .
            '<td>' . $consulta['Nombre_Tipo_G'].'</td>'.
            '<td>' . $consulta['Nombre_Tecnologia'].'</td>
            <td>' . $consulta['Capacidad_Nominal'].'</td>
            <td>';

            if($consulta['Estado']=="1"){
               $html .="Activo";
            }else{
               $html .="En Reparación ";
            }
             $html .='</td>
            </tr>';
      } $html .='</table>';


mysqli_close($conexion);
$html .='
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
