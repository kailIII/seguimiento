<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
	header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];


$senasa = mysql_real_escape_string($_POST['senasa']);
if(preg_match('/^[A-Za-z0-9][,A-Za-z0-9-]*(?:_[A-Za-z0-9]+)*$/', $senasa)==false){

  	$errorId = "Ingrese otro id";
  	header("Location: ../main.php?error=". $errorId);
} else {
	if(strlen($senasa) < 1){
		$senasa = "Sin id";
	}


	$nacimiento = mysql_real_escape_string($_POST['nacimiento']);

	if(preg_match('/[^-0-9\/]/', $nacimiento)){
		$errorNacimiento = "Revise el formato de la fecha";
		header("Location: ../main.php?errorNacimiento=" . $errorNacimiento);
	}else{

	$lote = 1;
			


	if(strpos($senasa, "-")){
		$rango = explode("-", $senasa);
		$dif = $rango[1] - $rango[0];
	}

	if(strpos($senasa, ",")){
		$varias = explode(",", $senasa);
	}

	if($varias){
		foreach ($varias as $senasa) {
			mysql_query("INSERT INTO `hembras` (`senasa_hembra`, `nacimiento_hembra`, `id_lote`, `idusuario_hembra`) 
					VALUES ('{$senasa}', '{$nacimiento}', '{$lote}', '{$id_usuario}')")
					or die (mysql_error());
		}
	}elseif($rango){
		for($i = $rango[0]; $i <= $rango[1]; $i++){

			$senasa = $i;

			mysql_query("INSERT INTO `hembras` (`senasa_hembra`, `nacimiento_hembra`, `id_lote`, `idusuario_hembra`) 
					VALUES ('{$senasa}', '{$nacimiento}', '{$lote}', '{$id_usuario}')")
					or die (mysql_error());
		}
	}else{
		//Query Vacas
		mysql_query("INSERT INTO `hembras` (`senasa_hembra`, `nacimiento_hembra`, `id_lote`, `idusuario_hembra`) 
					VALUES ('{$senasa}', '{$nacimiento}', '{$lote}', '{$id_usuario}')")
					or die (mysql_error());
	}


	//Query Vacunas
    /*
	if($_POST['check'] != 0){
		$query = "INSERT INTO vacunas_int (id_vaca, id_vacuna, semestre, periodo, id_usuario) VALUES ";

		foreach($_POST['check'] as $i => $value) { 
	 		// Get values from post.
	  		$vacuna = mysql_real_escape_string($_POST['check'][$i]);

	  		// Add to database
	  		$query = $query." ('$senasa','$vacuna', '$semestre', '$periodo', '$id_usuario') ,";
		}

		$query = substr($query,0,-1); //remove last char
		mysql_query($query) or die (mysql_error());
	}
	*/

	header('Location: ../main.php');		
	}
}
?>


