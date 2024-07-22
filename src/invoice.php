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
        <div class=" row searchBar sticky-top">
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
            <h2 class="topic">Invoice Details</h2>

            <table class="table">
                <thead>
                    <tr> 
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Customer District</th>
                        <th>Item Count</th>
                        <th>Invoice Amount</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <?php
                        // Fetch data from the database
                        if (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date'] != '' && $_GET['end_date'] != '') {
                            $start_date = $_GET['start_date'];
                            $end_date = $_GET['end_date'];

                            $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name, d.district, i.item_count, i.amount 
                                    FROM invoice i, district d, customer c  
                                    WHERE i.customer = c.id  AND c.district = d.id AND i.date BETWEEN '$start_date' AND '$end_date'";
                        } else {
                            $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name, d.district, i.item_count, i.amount 
                                    FROM invoice i, district d, customer c  
                                    WHERE i.customer = c.id  AND c.district = d.id";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Read data
                            while ($row = $result->fetch_assoc()) {
                                $invoice_no = $row["invoice_no"];
                                $date = $row["date"];
                                $first_name = $row["first_name"];
                                $last_name = $row["last_name"];
                                $district = $row["district"];
                                $item_count = $row["item_count"];
                                $amount = $row["amount"];

                                //display data
                                echo "<tr> 
                                        <td>$invoice_no</td>
                                        <td>$date</td>
                                        <td>$first_name $last_name</td>
                                        <td>$district</td>
                                        <td>$item_count</td>
                                        <td>$amount</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
        // Close the connection
        $conn->close();
    ?>
</body>
</html>
