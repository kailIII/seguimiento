<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_REQUEST['senasa']);

$id_usuario = $_SESSION['id'];


$q2 = "SELECT vacunas.id, vacunas.vacunas, DATE_FORMAT(vacunas_int.time, '%m/%Y') as 'date_vacunacion' FROM vacunas INNER JOIN vacunas_int ON vacunas_int.id_vacuna = vacunas.id 
          WHERE vacunas_int.senasa_vaca = '$UID' AND `idusuario_vint` = '$id_usuario' ";

$resultVac = mysql_query($q2) or die (mysql_error());

if(mysql_num_rows($resultVac)){
  $vacunasLista = true;
}



$q3 = "SELECT actividades.id, actividades.actividad, DATE_FORMAT(actividades_int.time_actividades, '%m/%Y') as 'date_actividad' FROM actividades INNER JOIN actividades_int ON actividades_int.id_actividad = actividades.id 
          WHERE actividades_int.senasa_vaca = '$UID' AND `idusuario_actividadesint` = '$id_usuario' ";

$resultActividades = mysql_query($q3) or die (mysql_error());

if(mysql_num_rows($resultActividades)){
  $actividades = true;
}



$queryComentarios = "SELECT comentario, DATE_FORMAT(time_comentario, '%d/%m/%Y') as 'date_comentario' FROM comentarios WHERE `senasa_comentario` = '$UID' AND `idusuario_comentario` = '$id_usuario' ";

$resultComentarios = mysql_query($queryComentarios) or die (mysql_error());

if(mysql_num_rows($resultComentarios)){
  $comentarios = true;
}

?>

<head>
  <title>Detalle Perdida</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="../bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
  <link href="../Css/vacas.css" type="text/css" rel="stylesheet" />

</head>
<body>
  <div class="container-narrow">
    <div class="masthead">
        <h3 class="muted">Detalle Vaca N&#176; <?php echo $UID; ?> (Perdida)</h3>
    </div>
<table id="completeTable" class="table table-striped">
	<thead>
    	<tr>
    		<th>A&ntilde;o</th>
        	<th>Nac.</th>
        	<th>Tacto</th>
        	<th>Parici&oacute;n</th>
        	<th>Sanidad</th>
        	<th>Estado</th>
          <th>Eliminar</th>
        	<th></th>
      	</tr>
    </thead>
    <tbody>
    <?php 
    
      $result2 = mysql_query("SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.sanidad_hembra, hembras.estado_hembra, YEAR(hembras.time_hembra) AS 'periodo', tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE `existencia_hembra` = '4' AND `senasa_hembra` = '$UID' AND `idusuario_hembra` = '$id_usuario' ") or die (mysql_error());
      while($row2 = mysql_fetch_array($result2)){

      echo "<tr><td>".$row2['periodo']."</td>
      <td>".$row2['nacimiento_hembra']."</td>
      <td>".$row2['tacto']."</td>
      <td>".$row2['paricion']."</td>
      <td>".$row2['sanidad_hembra']."</td>
      <td>".$row2['estado_hembra']."</td>
      <td><a href=\"delete.php?id=" . $row['id_hembra'] . "&senasa=" . $row['senasa_hembra'] . "\" ><i class=\"icon-remove\"></a></td></tr>";
      }
    ?>
    </tbody>
</table>
<h3 class="muted" id="showHideVacunas" <?php if($vacunasLista)echo "style=\"display:block\"" ?>><button class="btn dropdown-toggle" data-toggle="dropdown">Vacunas<span class="caret"></span></button></h3>
<strong <?php if($vacunasLista) echo "style=\"display:none\"" ?>>No se Registraron Vacunas</br></strong>
<div id="listaVacunas">
  <?php

  $fechaVacuna = false;

  if($vacunasLista){
    echo "<ul>";

    while($row = mysql_fetch_array($resultVac)){

     if($row['date_vacunacion']!= $fechaVacuna){

        $fechaVacuna = $row['date_vacunacion'];
        echo "<h4><strong>" . $fechaVacuna . "</strong></h4>";
      }

      echo "<li>" . $row['vacunas'];

    }
    echo "</ul>";
  }

  ?>
</div>
<h3 class="muted" id="showHideActividades" <?php if($actividades)echo "style=\"display:block\"" ?>><button class="btn dropdown-toggle" data-toggle="dropdown">Eventos<span class="caret"></span></button></h3>
<strong <?php if($actividades) echo "style=\"display:none\"" ?>>No se Registraron Eventos</br></strong>
<div id="listaActividades">
  <?php

  $fechaActividad = false;

  if($actividades){
    echo "<ul>";

    while($row2 = mysql_fetch_array($resultActividades)){

     if($row2['date_actividad']!= $fechaActividad){

        $fechaActividad = $row2['date_actividad'];
        echo "<h4><strong>" . $fechaActividad . "</strong></h4>";
      }

      echo "<li>" . $row2['actividad'];

    }
    echo "</ul>";
  }

  ?>
</div>
<h3 class="muted" id="showHideComentarios" <?php if($comentarios)echo "style=\"display:block\"" ?>><button class="btn dropdown-toggle" data-toggle="dropdown">Comentarios<span class="caret"></span></button></h3>
<strong <?php if($comentarios) echo "style=\"display:none\"" ?>>No se Registraron Comentarios</br></strong>
<div id="listaComentarios">
  <?php

  if($comentarios){
    echo "<ul>";

    while($row3 = mysql_fetch_array($resultComentarios)){
      echo "<li>" . $row3['date_comentario'] ." - " . $row3['comentario'];
    }
    echo "</ul>";
  }

  ?>
</div>
 
<br/>

<div id="estadoVacas">
  <h5 class="text-error">Cambiar estado.</h5>
  <a <?php echo "href=\"encontrada.php?senasa=" . $UID . " \" "; ?> class="btn btn-info">Encontrada</a><span>&nbsp;&nbsp;&nbsp;</span>
  <a <?php echo "href=\"muerta.php?senasa=" . $UID . " \" "; ?> class="btn btn-inverse">Muerta</a>
</div>

</br>
</br>
<a href="perdidas.php" id="volver" class="btn btn-primary">Volver</a>
</div>
  <script type="text/javascript" src="../jquery/jquery-latest.min.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../Js/vacas.js"></script>
</body>
</html>




