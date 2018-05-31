<?php
	
	require('db_credentials.php');

function db_connect() {
	if( ! $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) ) {
		die('No connection: ' . mysqli_connect_error());
	}
	return $connection;
}

function db_disconnect($connection) {
	if(isset($connection)) {
		mysqli_close($connection);
	}
}

?>