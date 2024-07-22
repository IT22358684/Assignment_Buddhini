<?php
    // Linking the configuration file
    include_once 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sending data through the form
        $item_code = $_POST["item_code"];
        $item_category = $_POST["item_category"];
        $item_subcategory = $_POST["item_subcategory"];
        $item_name = $_POST["item_name"];
        $quantity = $_POST["quantity"];
        $unit_price = $_POST["unit_price"];

        // Inserting values
        $sql = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price)
                VALUES ('$item_code', '$item_category', '$item_subcategory', '$item_name', '$quantity', '$unit_price')";

        // Check inserted data
        if ($conn->query($sql) === TRUE) {
            // Redirect to items page
            header('Location: items.php');
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }

        // Close the connection
        $conn->close();
    }
?>
