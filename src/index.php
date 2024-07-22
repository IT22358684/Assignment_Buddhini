<html>
<head>
    <title> Home </title>
    <link rel="stylesheet" href="styles/myStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/989548542d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class = "position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-2"> </div>
            <div class="col-4">
                <a class='btn ' href = "customers.php" role='button' id='homeBtn'> 
                    <div class="text-center">
                        <img src="images/users.png" class="rounded homeImg" alt="...">
                    </div>
                    Customers 
                </a>
            </div>
            <div class="col-4">
                <a class='btn ' href = "items.php" role='button' id='homeBtn'> 
                    <div class="text-center">
                        <img src="images/items.png" class="rounded homeImg" alt="...">
                    </div>
                    Items 
                </a>
            </div>
            <div class="col-2"> </div>
        </div>

        <div class="row">
            <div class="col-4">
                <a class='btn ' href = "itemReport.php" role='button' id='homeBtn'> 
                    <div class="text-center">
                        <img src="images/report.png" class="rounded homeImg" alt="...">
                    </div>
                    Item Report 
                </a>
            </div>
            <div class="col-4">
                <a class='btn ' href = "invoice.php" role='button' id='homeBtn'> 
                    <div class="text-center">
                        <img src="images/report.png" class="rounded homeImg" alt="...">
                    </div>
                    Invoice Report 
                </a>
            </div>
            <div class="col-4">
                <a class='btn ' href = "invoiceItem.php" role='button' id='homeBtn'> 
                    <div class="text-center">
                        <img src="images/report.png" class="rounded homeImg" alt="...">
                    </div>
                    Invoice Item Report 
                </a>
            </div>
        </div>
    </div>

</body>
</html>