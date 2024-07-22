<?php
// Linking the configuration file
include_once 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Items</title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="row">
        <div class="col-7">
            <h2 class="topic">Items</h2>
            <?php
                // Fetching data from the database
                $sql = "SELECT *, i.id AS item_id   
                        FROM item i
                        JOIN item_category c ON i.item_category = c.id
                        JOIN item_subcategory s ON i.item_subcategory = s.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Read data
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["item_id"];
                        $item_code = $row["item_code"];
                        $item_category = $row["category"];
                        $item_subcategory = $row["sub_category"];
                        $item_name = $row["item_name"];
                        $quantity = $row["quantity"];
                        $unit_price = $row["unit_price"];

                        //display data
                        echo "<div class='card' id='cusCard'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $item_code . " " . $item_name . "</h5>
                                    <div class='btns'>
                                        <a class='btn btn-warning' href='updateItem.php?updateid=$id' role='button'><i class='fa-solid fa-pen-to-square'></i></a>
                                        <a class='btn btn-danger' href='deleteItem.php?deleteid=$id' role='button' onclick=\"return confirm('Are you sure you want to delete this record?')\"><i class='fa-solid fa-trash'></i></a>
                                    </div>
                                    <p class='card-text'>" . $item_category . " | " . $item_subcategory . " <br>
                                    Unit Price : Rs. " . $unit_price . "<br>Quantity : " . $quantity . " </p>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<script>alert('No data found');</script>";
                }
            ?>
        </div>

        <!-- form to add details -->
        <div class="col-5">
            <div id="fixed-form-container">
                <form class="row g-3" method="POST" action="addItem.php" id="form">
                    <h2 class="topic">Add New Item</h2>

                    <div class="col-md-12">
                        <label class="form-label">Item Code *</label>
                        <input type="text" name="item_code" class="form-control" required>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label">Item Name *</label>
                        <input type="text" name="item_name" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Item Category *</label>
                            <select class="form-select" name="item_category" required>
                                <option></option>
                                <?php
                                    // Fetching data from the database
                                    $sql = "SELECT * FROM item_category";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Read data
                                        while ($row = $result->fetch_assoc()) {
                                            $category_id = $row["id"];
                                            $category = $row["category"];
                                            
                                            // Display the data
                                            echo "<option value='$category_id'>$category</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-6">
                            <label class="form-label">Item Sub Category *</label>
                            <select class="form-select" name="item_subcategory" required>
                                <option></option>
                                <?php
                                    // Fetching data from the database
                                    $sql = "SELECT * FROM item_subcategory";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Read data
                                        while ($row = $result->fetch_assoc()) {
                                            $subcategory_id = $row["id"];
                                            $subcategory = $row["sub_category"];
                                            
                                            // Display the data
                                            echo "<option value='$subcategory_id'>$subcategory</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Quantity *</label>
                            <input type="number" class="form-control" name="quantity" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit Price *</label>
                            Rs. <input type="number" class="form-control" name="unit_price" min="0" required>
                        </div>    
                    </div>        

                    <div class="col-12">
                        <input type="submit" id="submit" value="Submit" class="btn">
                    </div>
                    <p class='p'>* required</p>
                </form>
            </div>
        </div>
    </div>
    
    <?php
        // Close the connection
        $conn->close();
    ?>
</body>
</html>
