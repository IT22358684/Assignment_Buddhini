<?php
    // Linking the configuration file
    include_once 'config.php';
    
    // sending data through the form
    $title = $_POST["title"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];        
    $last_name = $_POST["last_name"];
    $contact_no = $_POST["contact_no"];
    $district = $_POST["district"];

    //inserting values
    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
            VALUES ('$title', '$first_name', '$middle_name', '$last_name', '$contact_no', '$district')";
    
    // check inserted data
    if($conn->query($sql) === TRUE){
        // redirect to viewFeedback page
        header('Location: customers.php');
    } else {
        echo "<script> alert ('Error: " . $sql . "<br>" . $conn->error . "'); </script>";
    }
    
    // close the connection
    $conn->close();
?>
