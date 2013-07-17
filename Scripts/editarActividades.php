<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];

$senasa = $_POST['senasa'];

$time = date(Y);


if($_POST['check2'] != 0){
	// Recorro actividades
	foreach($_POST['check2'] as $id_actividad) {
		$query3 = "INSERT INTO actividades_int (senasa_vaca, id_actividad, idusuario_actividadesint) VALUES ('$senasa','$id_actividad', '$id_usuario')";
		mysql_query($query3) or die (mysql_error());
	}
}

header('Location: detail.php?senasa=' . $senasa);