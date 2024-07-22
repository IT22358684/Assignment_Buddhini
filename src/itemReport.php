<?php
    // Linking the configuration file
    include_once 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title> Items </title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class='tableContainer'>

    <h2 class="topic"> Items </h2>

    <?php
      //calling the data from the database
      $sql = "SELECT *, i.id AS item_id   
   						FROM item i
   						JOIN item_category c ON i.item_category = c.id
   						JOIN item_subcategory s ON i.item_subcategory = s.id";
			$result = $conn->query($sql);

      if($result->num_rows > 0) {
	      echo "<table class='table'>
          <thead>
            <tr>
              <th>Item Code</th>
              <th>Item Name</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Quantity</th>
              <th>Unit Price</th>
            </tr>
          </thead>
          <tbody class='table-group-divider'>";

        // Read data
        while($row = $result->fetch_assoc()) {
          $id = $row["item_id"];
          $item_code = $row["item_code"];
          $item_category = $row["category"];
          $item_subcategory = $row["sub_category"];
          $item_name = $row["item_name"];
          $quantity = $row["quantity"];
          $unit_price = $row["unit_price"];
          echo "<tr>
            <td>{$item_code}</td>
            <td>{$item_name}</td>
            <td>{$item_category}</td>
            <td>{$item_subcategory}</td>
            <td>{$quantity}</td>
            <td>Rs. {$unit_price}</td>
          </tr>";
        }

        echo "</tbody></table>";
      } else {
          echo "<script> alert('No data found'); </script>";
      }
    ?>
  </div>
        
  <?php
    // close the connection
    $conn->close();
  ?>
                                          
</body>
</html>
