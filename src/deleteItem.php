<?php
	// Linking the configuration file
	include_once 'config.php';

	$id = $_GET['deleteid'];

	$sql = "DELETE FROM item
			WHERE id = $id";

	// check inserted data
	if($conn->query($sql)){
		echo "<script> alert ('Deleted successfully')</script>";
		header ('location:items.php');
	}
	else{
		echo "<script> alert ('Error')</script>";
	}
	
	// close the connection
	$conn->close();
?>