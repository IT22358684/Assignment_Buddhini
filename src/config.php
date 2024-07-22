<?php
//connect to database
    $server = 'localhost';
    $username = 'root';
    $password = 'Buddhi@123';
    $database = 'assignment';

    $conn = new mysqli($server, $username, $password, $database);

    if(!$conn){
            die(mysqli_error($conn));
    }

?>