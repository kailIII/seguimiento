<?php

	 function getAge($edad) {
		// set the timezone
		$tz  = new DateTimeZone('America/Argentina/Buenos_Aires');
	 
		// create a DateTime object and retrieve the difference with current time expresed in years
		$age = DateTime::createFromFormat('Y-m-d', $edad, $tz)->diff(new DateTime('now', $tz))->y;
	 
		// get the age, and be ondulao
		return $age;
	}

	function checkVacunas($vacuna){
		${strtolower($vacuna)} = "Si";
		echo ${strtolower($vacuna)};
		return ${strtolower($vacuna)};
	}

?>