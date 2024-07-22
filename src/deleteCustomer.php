<?php
	// Linking the configuration file
	include_once 'config.php';

	$id = $_GET['deleteid'];

	$sql = "DELETE FROM customer
			WHERE id = $id";

	// check inserted data
	if($conn->query($sql)){
		echo "<script> alert ('Deleted successfully')</script>";
		header ('location:customers.php');
	}
	else{
		echo "<script> alert ('Error')</script>";
	}
	
	// close the connection
	$conn->close();
?>

