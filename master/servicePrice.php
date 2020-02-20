<?php
    include "object/priceTable.php";
    include "sidebar.php";

    $price = new PriceTable($DB);
    $getPrice = $price->read();

    if(isset($_SESSION["alertClass"])) {
        $alertClass = $_SESSION["alertClass"];
        unset($_SESSION["alertClass"]);
    } else {
        $alertClass = "";
    }

    if(isset($_SESSION["alertText"])){
        $alertText = $_SESSION["alertText"];
        unset($_SESSION["alertText"]);
    }else {
        $alertText = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   <title>Manage Service Price</title>
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
   <link rel="stylesheet" href="css/dashboard.css" />
   <link rel="stylesheet" href="css/servicePrice.css" />
   <link rel="stylesheet" href="css/alert.css" />
   <!--    Icons   -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <hgroup>
        <h1>Manage Service Price</h1>
    </hgroup>

    <div id="body">
        <div id="title">
            <h1>Service Price</h1>
        </div>
        <div id="content">           
            <div class="container">
                <div class="alert-box <?php echo $alertClass; ?>"><?php echo $alertText; ?></div>
                <?php while( $row = $getPrice->fetch_assoc()) { ?>
                    <div class="card">
                        <div class="card-header"><?php echo $row["name"]; ?></div>
                        <div class="card-main">
                            <?php if($row["id"] == 1) {?>
                                <div class="main-description"><?php echo number_format((float)$row["price"], 2, '.',''); ?></div>
                            <?php } elseif($row["id"] == 4) {?>
                                <div class="main-description">MYR <?php echo number_format((float)$row["price"], 2, '.',''); ?> Per Hour</div>
                            <?php } else {?>
                                <div class="main-description">MYR <?php echo number_format((float)$row["price"], 2, '.',''); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
                
            <a href="editPrice.php"><button class="button button1 rightAlign">Modify Rate</button></a>
        </div>
    </div>

    <script src="js/promotion.js"></script>
</body>
</html>