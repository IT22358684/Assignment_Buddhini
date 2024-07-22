<?php
    // Linking the configuration file
    include_once 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title> Customers </title>
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
    <div class="row">

        <div class="col-7">

            <h2 class="topic"> Customers </h2>

            <?php
                //calling the data from the database
                $sql = "SELECT *, c.id AS cusId 
                        FROM customer c, district d 
                        WHERE c.district = d.id";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    //read data
                    while($row = $result->fetch_assoc()) {
                        $id = $row["cusId"];
                        $title = $row["title"];
                        $first_name = $row["first_name"];
                        $middle_name = $row["middle_name"];
                        $last_name = $row["last_name"];
                        $contact_no = $row["contact_no"];
                        $district = $row["district"];
                        
                         echo "<div class='card' id = 'cusCard'>
                                <div class='card-body'>
		                            <h5 class='card-title'>" . $title . " " . $first_name . " " . $middle_name . " "  . $last_name . "</h5>
                                    <div class='btns'>
                                    <a class='btn btn-warning' href = \"updateCustomer.php?updateid=$id\" role='button'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a class='btn btn-danger' href=\"deleteCustomer.php?deleteid=$id\" role='button' onclick=\"return confirm('Are you sure you want to delete this record?')\"><i class='fa-solid fa-trash'></i></a>
                                    </div>
                                    <p class='card-text'>" . $contact_no . "<br>" . $district . "</p>
                                    
                                </div>
                               </div>";
                    } 
                } else {
                    echo "<script> alert ('No data found'); </script>";
                }
            ?>
        </div>

        <div class="col-5">
  <div id="fixed-form-container">
    <form class="row g-3" method="POST" action="addCustomer.php" id="form">
      <h2 class="topic"> Add New Customer </h2>
      <div class="col-md-4">
        <label class="form-label"> Title * </label>
      </div>
      <div class="col-md-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="title" value="Mr" required>
          <label class="form-check-label"> Mr </label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="title" value="Mrs" required>
          <label class="form-check-label"> Mrs </label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="title" value="Miss" required>
          <label class="form-check-label"> Miss </label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="title" value="Dr" required>
          <label class="form-check-label"> Dr </label>
        </div>
      </div>
      <div class="col-md-4">
        <label class="form-label"> First Name * </label>
        <input type="text" class="form-control" name="first_name" pattern="[A-Za-z]+" id="name" required>
      </div>
      <div class="col-md-4">
        <label class="form-label"> Middle Name </label>
        <input type="text" class="form-control" name="middle_name" pattern="[A-Za-z]+" id="name">
      </div>
      <div class="col-md-4">
        <label class="form-label"> Last Name * </label>
        <input type="text" class="form-control" name="last_name" id="name" pattern="[A-Za-z]+" required>
      </div>
      <div class="col-12">
        <label class="form-label"> Contact Number * </label>
        <input class="form-control" type="tel" name="contact_no" id="contact_no" pattern="[0-9]{10}" size="10" required>
      </div>
      <div class="col-12">
        <label class="form-label"> District * </label>
        <select class="form-select" name="district" required>
          <option></option>
          <?php
            $sql = "SELECT id, district FROM district";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $district_id = $row["id"];
                $district = $row["district"];
                echo "<option value='$district_id'>$district</option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="col-12">
        <input type="submit" id="submit" value="Submit" class="btn">
      </div>
      <p class='p'> * required </p>
    </form>
  </div>
</div>

    </div>
        
        <?php
            // close the connection
            $conn->close();
        ?>
    </div>
                        
    <script src="js/myScript.js"></script>                     
</body>
</html>
