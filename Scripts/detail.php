<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_REQUEST['senasa']);

$id_usuario = $_SESSION['id'];

$q = "SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.vacunas_hembra, hembras.estado_hembra, tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE `existencia_hembra` = '1' AND `senasa_hembra` = '$UID' AND `idusuario_hembra` = '$id_usuario' ";

$result = mysql_query($q) or die (mysql_error());
$row = mysql_fetch_array($result);

$senasa = $row['senasa_hembra'];
$nacimiento = $row['nacimiento_hembra'];
$tacto = $row['tacto'];
$paricion = $row['paricion'];
$vacunas = $row['vacunas_hembra'];
$estado = $row['estado_hembra'];


//Traigo vacunas de acuerdo al usuario
$obtenerVacunas = mysql_query("SELECT id, vacunas FROM vacunas WHERE idusuario_vacunas = '$id_usuario'") or die (mysql_error());



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
  <title>Detail View</title>
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
        <h3 class="muted">Detalle Vaca N&#176; <?php echo $UID; ?></h3>
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
    
      $result2 = mysql_query("SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.vacunas_hembra, hembras.estado_hembra, YEAR(hembras.time_hembra) AS 'periodo', tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE `existencia_hembra` = '1' AND `senasa_hembra` = '$UID' AND `idusuario_hembra` = '$id_usuario' ") or die (mysql_error());
      while($row2 = mysql_fetch_array($result2)){

      echo "<tr><td>".$row2['periodo']."</td>
      <td>".$row2['nacimiento_hembra']."</td>
      <td>".$row2['tacto']."</td>
      <td>".$row2['paricion']."</td>
      <td>".$row2['vacunas_hembra']."</td>
      <td>".$row2['estado_hembra']."</td>
      <td><a href=\"delete.php?id=" . $row['id_hembra'] . "&senasa=" . $row['senasa'] . "\" ><i class=\"icon-remove\"></a></td></tr>";
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
<h3 class="muted" id="showHideActividades" <?php if($actividades)echo "style=\"display:block\"" ?>><button class="btn dropdown-toggle" data-toggle="dropdown">Actividades<span class="caret"></span></button></h3>
<strong <?php if($actividades) echo "style=\"display:none\"" ?>>No se Registraron Actividades</br></strong>
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
<a href="#" onclick="editForm()" id="editButton" class="btn btn-warning">Editar Vaca</a><span>&nbsp;&nbsp;&nbsp;</span>
<a <?php echo "href=\"editarvacunas.php?senasa=" . $UID . " \" " ?> id="editarVacunas" class="btn btn-warning">Editar vacunas</a><span>&nbsp;&nbsp;&nbsp;</span>
<a href="#" onclick="editFormActividades()" id="editarActividades" class="btn btn-warning">Agregar Actividad</a></br></br>

<form id="edit" action="editDb.php" method="POST">
  <legend>Editar Vaca</legend>
  <label>Caravana:</label>
  <input type="text" name="senasa" value="<?php echo $senasa; ?>" readonly>
  <span>&nbsp;&nbsp;</span>
  <label>Fecha de Nac.:</label>
  <input type="text" name="nacimiento" placeholder="Fecha Nac." value="<?php echo $nacimiento; ?>" >
  <br/>
  <label>Tacto:</label>
  <select name="tacto" >
    <option <?php if ($tacto == "Si" ) echo 'SELECTED'; ?> value="1">Si</option>
    <option <?php if ($tacto == "Llena" ) echo 'SELECTED'; ?> value="2">Llena</option>
    <option <?php if ($tacto == "Vacia" ) echo 'SELECTED'; ?> value="3">Vacia</option>
    <option <?php if ($tacto == "No" ) echo 'SELECTED'; ?> value="4">No</option>

  </select>
  <br/>
  <label>Paricion:</label>
  <select name="paricion">
    <option <?php if ($paricion == "Macho" ) echo 'SELECTED'; ?> value="1">Macho</option>
    <option <?php if ($paricion == "Hembra" ) echo 'SELECTED'; ?> value="2">Hembra</option>
    <option <?php if ($paricion == "Mal pario" ) echo 'SELECTED'; ?> value="3">Malpario</option>
    <option <?php if ($paricion == "No" ) echo 'SELECTED'; ?> value="4">No</option>
    <option <?php if ($paricion == "No sabe" ) echo 'SELECTED'; ?> value="5">No sabe</option>
  </select>
  <br/>
  <label>Vacunas:</label>
  <select name="vacunas">
    <option <?php if ($vacunas == "Si" ) echo 'SELECTED'; ?> value="Si">Si</option>
    <option <?php if ($vacunas == "No" ) echo 'SELECTED'; ?> value="No">No</option>
  </select>
  <br/>
  <p>Estado</p>
  <select name="estado">
    <option <?php if ($estado == 1 ) echo 'SELECTED'; ?> value="1">1</option>
    <option <?php if ($estado == 2 ) echo 'SELECTED'; ?> value="2">2</option>
    <option <?php if ($estado == 3 ) echo 'SELECTED'; ?> value="3">3</option>
    <option <?php if ($estado == 4 ) echo 'SELECTED'; ?> value="4">4</option>
    <option <?php if ($estado == 5 ) echo 'SELECTED'; ?> value="5">5</option>
    <option <?php if ($estado == 6 ) echo 'SELECTED'; ?> value="6">6</option>
  </select>
  <br/>
  <input name="id" type="hidden" name="id" value="<? echo $row['id_hembra']; ?>">
  <button type="submit" name="submit" class="btn btn-success" value="Edit">Editar</button>
</form>


<div id="formVacunas">
  <form action="editarvacunas.php" method="POST">
    <h4 class="text-error">Se&ntilde;ale todas las vacunas que tiene el animal el d&iacute;a de la fecha.</h4>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="1">Antiparasitario</input>
        </label>
        <span>&nbsp;&nbsp;</span>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="2">Brucelosis</input>
        </label>
        <span>&nbsp;&nbsp;</span>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="3">Aftosa</input>
        </label>
        <?php
          while($listadoVacunas = mysql_fetch_array($obtenerVacunas)){
            echo "<label class=\"checkbox inline\" > ";
            echo "<input type=\"checkbox\" name=\"check[]\" value =\" ". $obtenerVacunas['id'] . "\" >". $obtenerVacunas['vacunas'] . "</input>";
            echo "</label>";
          }
        ?>
        </br>
        </br>
        <input type="hidden" name="senasa" value="<? echo $UID; ?>">
        <button type="submit" name="submit" class="btn btn-success" value="Edit">Editar</button>
      </form>
</div>

<div id="formActividades">
  <form action="editarActividades.php" method="POST">
    <h3>Indique las actividades que desea agregar</h3>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="1">Servicio</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="2">Destete</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="3">Descorne</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="4">Se&ntilde;alada</input>
        </label>
        </br>
        </br>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="5">Marcacion</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="6">Castracion</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="7">Tacto Rectal</input>
        </label>
        </br>
        </br>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="8">Descarte de Vacas</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="9">Revisi&oacute;n de Toros</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="10">Inventario</input>
        </label>
        <br/>
        <br/>
        <input type="hidden" name="senasa" value="<? echo $UID; ?>">
        <input type="submit" value="Agregar" class="btn btn-success"></input>
      </fieldset>
  </form>
</div>

<a <?php echo "href=\"perdida.php?senasa=" . $senasa . " \" "; ?> id="vacaPerdida" class="btn btn-info">Perdida</a><span>&nbsp;&nbsp;&nbsp;</span>
<a <?php echo "href=\"muerta.php?senasa=" . $senasa . " \" "; ?> id="vacaMuerta" class="btn btn-inverse">Muerta</a>
</br>
</br>
<a href="../index.php" id="volver" class="btn btn-primary">Volver</a>
</div>
  <script type="text/javascript" src="../jquery/jquery-latest.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../Js/vacas.js"></script>
</body>
</html>




