<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];

$senasa = $_POST['senasa'];

$comentario = $_POST['comment'];

$existencia = 2;


$insert = "INSERT INTO comentario_muerte (senasa_muerta, comentario_muerte, idusuario_comentario) VALUES ('$senasa', '$comentario', '$id_usuario' )";
mysql_query($insert)or die(mysql_error());



$muerte = "UPDATE hembras SET `existencia_hembra` = $existencia, `comentario_muerte` = LAST_INSERT_ID() WHERE `senasa_hembra` = $senasa AND `idusuario_hembra` = $id_usuario";
mysql_query($muerte)or die (mysql_error());


header('Location: muertas.php');

?>