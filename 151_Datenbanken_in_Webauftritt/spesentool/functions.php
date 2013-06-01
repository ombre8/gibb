<?php

// Database Stuff

function dbConnect(){
	// get db-credentials
	require_once('dbconnection/connection.php');
	// Create connection
	$con=mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

	// Check connection
	if (mysqli_connect_errno($con))
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	return $con;
};

function queryDb($con, $query)
{
	return mysqli_query($con,$query);
}

// Close DB
function closeDb($con)
{
	mysqli_close($con);

}

// Output stuff

?>
