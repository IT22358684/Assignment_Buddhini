<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav class="navbar sticky-top bg-body-tertiary">
    <div class="container-fluid justify-content-center">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php"> Home </a>
        </li>
        <?php
          // Function to get the current page name
          function getCurrentPage() {
            return basename($_SERVER['PHP_SELF']);
          }

          // Determine the current page
          $currentPage = getCurrentPage();
        ?>
        <li class="nav-item">
          <a class="nav-link <?php echo $currentPage == 'customers.php' ? 'active' : ''; ?>" aria-current="page" href="customers.php"> Customers </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $currentPage == 'items.php' ? 'active' : ''; ?>" href="items.php"> Items </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $currentPage == 'invoice.php' ? 'active' : ''; ?>" href="invoice.php"> Invoice Report </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $currentPage == 'invoiceItem.php' ? 'active' : ''; ?>" href="invoiceItem.php"> Invoice Item Report </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $currentPage == 'itemReport.php' ? 'active' : ''; ?>" href="itemReport.php"> Item Report </a>
        </li>
      </ul>
    </div>
  </nav>

</body>
</html>