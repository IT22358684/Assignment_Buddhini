<?php
// Linking the configuration file
include_once 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <div class="searchBar">
            <form action="" method="get">
                <div class="input-group">
                    <label for="start_date" class="input-group-text">Start Date:</label>
                    <input type="date" id="start_date" name="start_date">
                
                    <label for="end_date" class="input-group-text">End Date:</label>
                    <input type="date" id="end_date" name="end_date">

                    <button type="submit" class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class='tableContainer'>
            <h2 class="topic">Invoice Item Details</h2>

            <?php
            // Fetch data from the database
                if (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date'] != '' && $_GET['end_date'] != '') {
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];

                    $sql = "SELECT n.id, n.invoice_no, n.date, c.first_name, c.last_name, d.district, i.item_name, i.item_code, t.category, m.unit_price
                            FROM invoice_master m, invoice n , customer c, item_category t, item i, district d
                            WHERE m.invoice_no = n.invoice_no AND n.customer = c.id AND m.item_id = i.id AND t.id = i.item_category AND c.district = d.id
                            AND n.date BETWEEN '$start_date' AND '$end_date'
                            ORDER BY n.invoice_no";
                } else {
                    $sql = "SELECT n.id, n.invoice_no, n.date, c.first_name, c.last_name, d.district, i.item_name, i.item_code, t.category, m.unit_price
                            FROM invoice_master m, invoice n , customer c, item_category t, item i, district d
                            WHERE m.invoice_no = n.invoice_no AND n.customer = c.id AND m.item_id = i.id AND t.id = i.item_category AND c.district = d.id
                            ORDER BY n.invoice_no";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $current_invoice_no = "";
                    $first_entry = true;

                    echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Customer District</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Item Category</th>
                                    <th>Unit Price</th>
                                </tr>
                            </thead>
                            <tbody class='table-group-divider'>";

                    // Read data
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $invoice_no = $row["invoice_no"];
                        $date = $row["date"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $district = $row["district"];
                        $item_name = $row["item_name"];
                        $item_code = $row["item_code"];
                        $category = $row["category"];
                        $unit_price = $row["unit_price"];

                        if ($invoice_no != $current_invoice_no) {
                            $current_invoice_no = $invoice_no;
                            $first_entry = true;
                        }

                        //display data
                        echo "<tr>
                                <td>" . ($first_entry ? $invoice_no : '') . "</td>
                                <td>" . ($first_entry ? $date : '') . "</td>
                                <td>" . ($first_entry ? $first_name . ' ' . $last_name : '') . "</td>
                                <td>" . ($first_entry ? $district : '') . "</td>
                                <td>" . $item_code . "</td>
                                <td>" . $item_name . "</td>
                                <td>" . $category . "</td>
                                <td>" . $unit_price . "</td>
                            </tr>";

                        $first_entry = false;
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<script>alert('No data found');</script>";
                }
            ?>
        </div>
    </div>
        
    <?php
    // Close the connection
    $conn->close();
    ?>
</body>
</html>
