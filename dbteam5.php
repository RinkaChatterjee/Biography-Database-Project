<?php // db.php

$host = "pluto.hood.edu";
$dbname = "team5db";
$user = "team5";
$pass = "Bashful2018";
try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
   die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>