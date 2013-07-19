<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];

//Traigo lotes por usuario
$obtenerLotes = mysql_query("SELECT id, nombre_lote FROM lotes WHERE idusuario_lote = '$id_usuario'") or die(mysql_error());


//Traigo vacunas por usuario
$obtenerVacunas = mysql_query("SELECT id, vacunas FROM vacunas WHERE idusuario_vacunas = '$id_usuario'") or die (mysql_error());


$time = date(Y);

$queryActividades = mysql_query("SELECT DATE_FORMAT(seguimiento_actividades.time_evento, '%m/%Y') AS 'date_evento' , actividades.actividad, lotes.nombre_lote FROM seguimiento_actividades
                    INNER JOIN actividades ON actividades.id = seguimiento_actividades.id_actividad INNER JOIN lotes ON lotes.id = seguimiento_actividades.id_lote WHERE YEAR(seguimiento_actividades.time_evento) = '$time' AND 
                    seguimiento_actividades.idusuario_segact = '$id_usuario' ORDER BY date_evento") or die (mysql_error());  

$queryVacunas = mysql_query("SELECT DATE_FORMAT(seguimiento_vacunacion.time_evento, '%m/%Y') AS 'date_vacunacion', vacunas.vacunas, lotes.nombre_lote FROM seguimiento_vacunacion
                    INNER JOIN vacunas ON vacunas.id = seguimiento_vacunacion.id_vacuna INNER JOIN lotes ON lotes.id = seguimiento_vacunacion.id_lote WHERE YEAR(seguimiento_vacunacion.time_evento) = '$time' AND 
                    seguimiento_vacunacion.idusuario_segvac = '$id_usuario' ORDER BY date_vacunacion") or die (mysql_error());

?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Feed Lot</title>
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
    <ul class="nav nav-pills pull-right">
      <li><a href="#">Usuario: <?php echo $nombre . " " . $apellido; ?></a>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li class="active"><a href="logOut.php" class="btn-danger">Cerrar sesi&oacute;n</a></li>
    </ul>
    <h3>Ganado Bovino</h3>
  </div>
</div>

<h4 class="muted">Eventos</h4>

<div>
  <ul class="nav nav-tabs">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><h5>Vacas<b class="caret"></b></h5></a>
      <ul class="dropdown-menu">
        <li><a href="../main.php"><h5>Vivas</h5></a></li>
        <li><a href="muertas.php"><h5>Muertas</h5></a></li>
        <li><a href="vendidas.php"><h5>Vendidas<h5></a></li>
        <li class="divider"></li>
        <li><a href="perdidas.php"><h5>Perdidas</h5></a></li>
      </ul>
    </li>
    <li><a href="#"><h5>Eventos</h5></a></li>
    <li><a href="#"><h5>Vender</h5></a></li>
  </ul>
</div>

<div class="container-narrow">
  <button href="#" id="addEventButton" onclick="addEvent()" class="btn btn-warning">Nuevo evento</button>
  </br>
  </br>
  <div id="events">
  </br>
    <form id="formEvent" action="addEvent.php" method="POST">
    <fieldset>
        Lote:
        <select name="lote">
          <option value="1">1</option>  

          <?php
          while($lotes = mysql_fetch_array($obtenerLotes)){
            echo "<option value =\" ". $lotes['id'] . "\" >". $lotes['nombre_lote'] . "</option>";
          }

          ?>

        </select>
        <h3>Sanidad</h3>
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
        </br>
        <?php
          $flag = 0;
          while($listadoVacunas = mysql_fetch_array($obtenerVacunas)){
            $flag = $flag + 1;
            echo "<label class=\"checkbox inline\" > ";
            echo "<input type=\"checkbox\" name=\"check[]\" value =\" ". $listadoVacunas['id'] . "\" >". $listadoVacunas['vacunas'] . "</input>";
            echo "</label>";
            if($flag % 3 == 0){
              echo "</br>";
            }
          }
          
        ?>
        <br/>
        <br/>
        <h3>Actividades</h3>

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
        <input type="submit" value="Agregar" class="btn btn-success"></input>
      </fieldset>
  </form>
  </div>
  <div id="eventos">
      <?php

      $fechaLote = false;
      $fechaVacuna = false;
      if(mysql_num_rows($queryActividades)){
        echo "<ul>";

        while($row = mysql_fetch_array($queryActividades)){

          if("Actividades - " . $row['date_evento'] . " - Lote " . $row['nombre_lote'] != $fechaLote){

            $fechaLote = "Actividades - " . $row['date_evento'] . " - Lote " . $row['nombre_lote'];
            echo "<h4><strong>" . $fechaLote . "</strong></h4>";
          }

        echo "<li>" . $row['actividad'];

        }
        echo "</ul>";
      }

      ?>
  </div>
  </br>

  <div id="vacunacion">
      <?php

      if(mysql_num_rows($queryVacunas)){
        echo "<ul>";

        while($row = mysql_fetch_array($queryVacunas)){

          if("Vacunacion - " . $row['date_vacunacion'] . " - Lote " . $row['nombre_lote'] != $fechaVacuna){

            $fechaVacuna = "Vacunacion - " . $row['date_vacunacion'] . " - Lote " . $row['nombre_lote'];
            echo "<h4><strong>" . $fechaVacuna . "</strong></h4>";
          }

        echo "<li>" . $row['vacunas'];

        }
        echo "</ul>";
      }


    ?>
  </div>
</div>

</div>

  <div class="footer"></div>
  <script type="text/javascript" src="../jquery/jquery-latest.min.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="../Js/vacas.js"></script> 

 </body>
</html>