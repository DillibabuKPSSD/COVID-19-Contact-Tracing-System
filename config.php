<?php
	//---------------------------------------------------------------------------------------------------------------------
	//Purpose 	: COVID-19 Contact Tracing System:-------------------------------------------------------------------------
	//Developers : 
	//			K.Dilli (mailtodillibabu@gmail.com)
	//			K.Suresh (mailtosureshk87@gmail.com)
	//			K.Sankar (mailtosankark@gmail.com)
	//---------------------------------------------------------------------------------------------------------------------

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();

	//MySQL Config
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_covid19";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//GMap config
	$key = "AIzaSyD9Vz8onySZoQbUyMQ_AdkfnrC2PZFQtb4";
?>