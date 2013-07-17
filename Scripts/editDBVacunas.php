<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_POST['senasa']);

$id_usuario = $_SESSION['id'];

$time = date(m/Y);

$queryDelete = "DELETE FROM vacunas_int WHERE senasa_vaca = '$UID' AND DATE_FORMAT(time, '%m/%Y') = '$time' AND idusuario_vint = '$id_usuario' ";
mysql_query($queryDelete) or die (mysql_error());

if($_POST['check'] != 0){
	// Recorro vacunas
	foreach($_POST['check'] as $id_vacuna) {

		$query = "INSERT INTO vacunas_int (senasa_vaca, id_vacuna, idusuario_vint) VALUES ('$UID','$id_vacuna', '$id_usuario')";
  		mysql_query($query) or die (mysql_error());
	}
}

header('Location: detail.php?senasa=' . $UID);	
	
?>