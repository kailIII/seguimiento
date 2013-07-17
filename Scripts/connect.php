<?php                                                                                               

require 'app_config.php';

/*
	try{
		$conn = new PDO('mysql:host=localhost;dbname=Normalized', DATABASE_USERNAME, DATABASE_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
	echo "ERROR: " . $e->getMessage();
}
*/

mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD)
or die("<p>Error connecting to database: " . mysql_error() . "</p>");

$mysqlSelectDb = mysql_select_db(DATABASE_NAME)
or die("<p>Error selecting the database " . DATABASE_NAME . mysql_error() . "</p>");


?>
