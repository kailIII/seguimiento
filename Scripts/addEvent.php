<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];

$lote = $_POST['lote'];
$time = date(Y);

$vacasLote = mysql_query("SELECT senasa_hembra FROM hembras 
             WHERE existencia_hembra = '1' AND YEAR(time_hembra) = '$time' AND id_lote = '$lote' AND idusuario_hembra = '$id_usuario' ") or die (mysql_error());

$vacasObjetivo = array();
while($row = mysql_fetch_array($vacasLote)){
	array_push($vacasObjetivo, $row['senasa_hembra']);
}


if($_POST['check'] != 0){
	// Recorro vacunas
	foreach($_POST['check'] as $id_vacuna) {

		$query2 = "INSERT INTO seguimiento_vacunacion (id_vacuna, id_lote, idusuario_segvac) VALUES ('$id_vacuna', '$lote', '$id_usuario')";
  		mysql_query($query2) or die (mysql_error());

		foreach($vacasObjetivo as $senasa) { 

			$query = "INSERT INTO vacunas_int (senasa_vaca, id_vacuna, idusuario_vint) VALUES ('$senasa','$id_vacuna', '$id_usuario')";
  			mysql_query($query) or die (mysql_error());
		}
	}	
}

if($_POST['check2'] != 0){
	// Recorro actividades
	foreach($_POST['check2'] as $id_actividad) {

		$query4 = "INSERT INTO seguimiento_actividades (id_actividad, id_lote, idusuario_segact) VALUES ('$id_actividad', '$lote', '$id_usuario')";
		mysql_query($query4) or die (mysql_error());

		foreach($vacasObjetivo as $senasa) { 
			//Marco Si en tacto
			if($id_actividad == 7){
				mysql_query("UPDATE hembras SET tacto = '1' WHERE senasa_hembra = '$senasa' AND YEAR(time_hembra) = '$time' AND idusuario_hembra = '$id_usuario'") or die(mysql_error());
			}

			$query3 = "INSERT INTO actividades_int (senasa_vaca, id_actividad, idusuario_actividadesint) VALUES ('$senasa','$id_actividad', '$id_usuario')";
			mysql_query($query3) or die (mysql_error());
		}
	}	
}

header("Location: eventos.php");

?>