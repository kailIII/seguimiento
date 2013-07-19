<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];

$senasa = $_GET['senasa'];

$existencia = 1;

$query = "UPDATE hembras SET `existencia_hembra` = $existencia WHERE `senasa_hembra` = $senasa AND `idusuario_hembra` = $id_usuario ";

mysql_query($query) or die (mysql_error());


header('Location: ../main.php');

?>