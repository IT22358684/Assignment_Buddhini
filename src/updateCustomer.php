<?php
    // Linking the configuration file
    include_once 'config.php';

    // Get the customer id from the URL
    $id = $_GET['updateid'];

    // Fetching the data from the database
    $sql = "SELECT c.*, d.district AS district_name FROM customer c, district d WHERE c.id = $id AND c.district = d.id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Assigning data from the database to variables
    $title = $row['title'];
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $last_name = $row['last_name'];
    $contact_no = $row['contact_no'];
    $current_district_id = $row['district'];
    $current_district_name = $row['district_name'];

    if (isset($_POST['submit'])) {
        // Sending data through the update form
        $title = $_POST["title"];
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $contact_no = $_POST["contact_no"];
        $district = $_POST["district"];

        // Updating database
        $sql = "UPDATE customer 
                SET title='$title', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', contact_no='$contact_no', district='$district'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: customers.php");
        } else {
            echo "<script> alert ('Error: " . $sql . "<br>" . $conn->error . "'); </script>";
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- update form -->
    <div class="position-absolute top-50 start-50 translate-middle" id= "formFull">
        <form method="POST" class="row g-3">
            <h2 class="topic"> Update Customer Details </h2>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="col-md-4">
                <label class="form-label"> Title * </label>
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="title" id="flexRadioDefault1" value="Mr" <?php if ($title == "Mr") echo "checked"; ?>>
                    <label class="form-check-label"> Mr </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="title" id="flexRadioDefault1" value="Mrs" <?php if ($title == "Mrs") echo "checked"; ?>>
                    <label class="form-check-label"> Mrs </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="title" id="flexRadioDefault1" value="Miss" <?php if ($title == "Miss") echo "checked"; ?>>
                    <label class="form-check-label"> Miss </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="title" id="flexRadioDefault1" value="Dr" <?php if ($title == "Dr") echo "checked"; ?>>
                    <label class="form-check-label"> Dr </label>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label"> First Name * </label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"> Middle Name </label>
                <input type="text" class="form-control" name="middle_name" value="<?php echo $middle_name; ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label"> Last Name * </label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label"> Contact Number * </label>
                <input class="form-control" type="tel" name="contact_no" id="mobile" pattern="[0-9]{10}" value="<?php echo $contact_no; ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label"> District * </label>
                <select class="form-select" name="district" required>
                    <option value="<?php echo $current_district_id; ?>" selected><?php echo $current_district_name; ?></option>
                    <?php
                        $sql = "SELECT id, district FROM district";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                            while($district_row = $result->fetch_assoc()) {
                                $district_id = $district_row["id"];
                                $district_name = $district_row["district"];
                                echo "<option value='$district_id'>$district_name</option>";
                            }
                        } 
                    ?>
                </select>
            </div>

            <div class="col-6">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-light">
            </div>
            <div class="col-6">
                <a class='btn btn-light' href="customers.php" role='button' id="submit"> Cancel </a>
            </div>
            <p class='p'> * required </p>
        </form>
    </div>
</body>
</html>
