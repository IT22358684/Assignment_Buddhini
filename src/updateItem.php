<?php
// Linking the configuration file
include_once 'config.php';

// Get the item id from the URL
$id = intval($_GET['updateid']); // Sanitize input

// Fetching the data from the database
$sql = "SELECT i.*, c.id AS category_id, c.category, s.id AS subcategory_id, s.sub_category
        FROM item i
        JOIN item_category c ON i.item_category = c.id
        JOIN item_subcategory s ON i.item_subcategory = s.id
        WHERE i.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Item not found');
}

// Assigning data from the database to variables
$item_code = htmlspecialchars($row["item_code"]);
$item_category = htmlspecialchars($row["category"]);
$item_subcategory = htmlspecialchars($row["sub_category"]);
$item_name = htmlspecialchars($row["item_name"]);
$quantity = intval($row["quantity"]);
$unit_price = floatval($row["unit_price"]);
$current_category = intval($row['category_id']);
$current_subcategory = intval($row['subcategory_id']);

if (isset($_POST['submit'])) {
    // Sending data through the update form
    $item_code = $_POST["item_code"];
    $item_category = intval($_POST["item_category"]);
    $item_subcategory = intval($_POST["item_subcategory"]);
    $item_name = $_POST["item_name"];
    $quantity = intval($_POST["quantity"]);
    $unit_price = floatval($_POST["unit_price"]);

    // Updating database
    $sql = "UPDATE item 
            SET item_code=?, item_category=?, item_subcategory=?, item_name=?, quantity=?, unit_price=?
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siisidi', $item_code, $item_category, $item_subcategory, $item_name, $quantity, $unit_price, $id);

    // Check updated data
    if ($stmt->execute()) {
        // Redirect to items page
        header("Location: items.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
// Linking the configuration file
include_once 'header.php';
?>
    <div class="position-absolute top-50 start-50 translate-middle" id= "formFull">
        <form method="POST" class="row g-3">
            <h2 class="topic"> Update Item Details </h2>

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="col-md-12">
                <label class="form-label"> Item Code * </label>
                <input type="text" name="item_code" class="form-control" value="<?php echo $item_code; ?>" required>
            </div>

            <div class="col-md-12">
                <label class="form-label"> Item Name * </label>
                <input type="text" name="item_name" class="form-control" value="<?php echo $item_name; ?>" required>
            </div>

            <div class = row>
                <div class="col-6">
                    <label class="form-label"> Item Category * </label>
                    <select class="form-select" name="item_category" required>
                        <option value="<?php echo $current_category; ?>" selected><?php echo $item_category; ?></option>
                        <?php
                        // Fetching the data from the database
                        $sql = "SELECT * FROM item_category";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Read data
                            while ($row = $result->fetch_assoc()) {
                                $category_id = $row["id"];
                                $category_name = $row["category"];
                                // Skip the current category as it's already added
                                if ($category_id != $current_category) {
                                    echo "<option value='$category_id'>$category_name</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-6">
                    <label class="form-label"> Item Sub Category * </label>
                    <select class="form-select" name="item_subcategory" required>
                        <option value="<?php echo $current_subcategory; ?>" selected><?php echo $item_subcategory; ?></option>
                        <?php
                        // Fetching the data from the database
                        $sql = "SELECT * FROM item_subcategory";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Read data
                            while ($row = $result->fetch_assoc()) {
                                $subcategory_id = $row["id"];
                                $subcategory_name = $row["sub_category"];
                                // Skip the current subcategory as it's already added
                                if ($subcategory_id != $current_subcategory) {
                                    echo "<option value='$subcategory_id'>$subcategory_name</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label"> Quantity * </label>
                <input type="number" class="form-control" name="quantity" min="0" value="<?php echo $quantity; ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label"> Unit Price * </label>
                <br> Rs. <input type="number" class="form-control" name="unit_price" value="<?php echo $unit_price; ?>" min="0">
            </div>            

            <div class="col-6">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-light">
            </div>
            <div class="col-6">
                <a class='btn btn-light' href="items.php" role='button' id="submit"> Cancel </a>
            </div>
            <p class='p'> * required </p>
        </form>
    </div>
</body>
</html>
