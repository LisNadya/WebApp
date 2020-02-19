<?php
    include "db/conn.php";
    include_once "object/promotionTable.php";

    // Get Database connection
    //$db = $DB->connect();
    $promotion = new PromotionTable($DB);

    if(isset($_GET['editId'])){
        $currPromo = $promotion->recordById($_GET['editId']);
    }

    if(isset($_POST['modifyPromotion']))
    {
        $promotion->updatePromo($_POST,$_GET['editId']);
        header("Location: promotion.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   
   <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   <title>Edit Promotion</title>
   <!--    Custom styles   -->
   <link rel="stylesheet" href="css/reset.css" />
   
   <link rel="stylesheet" href="css/default.css" />
   <link rel="stylesheet" href="css/sidebar.css" />
   <link rel="stylesheet" href="css/editServicePricePromotion.css" />
   <link rel="stylesheet" href="css/alert.css" />
   <!--    Icons   -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="leftBar">
        <div id="user">
            <img src="img/default.jpg" alt="Profile Image">
            <p>
                Hi <br/>
                <b >Kuang Tar</b>
            </p>
        </div>
        <nav>
            <a href="cartype.html">Manage Types of Vehicles</a>
            <a href="user.html">Manage Users</a>
            <a href="servicePrice.html">Manage Service Price</a>
            <a href="promotion.html"  id="selected">Manage Promotions</a>
          </nav>
        <div id="signOut">
            <a href="login.html"><i class="fa fa-sign-out"></i> Sign Out</a>
        </div>
    </div>
    <hgroup>
        <h1>Edit Promotion</h1>
    </hgroup>
    <div id="body">
        <div id="title">
            <h1>Promotions</h1>
        </div>
        <div id="content">
            <div class="container form-style">
                <a href="promotion.php"><button class="button button2 leftAlign">Back</button></a>
                <form method="POST" id="updatePromo" enctype="multipart/form-data">
                    <ul class="form-style-1">
                        <li>
                            <label>Event Title: </label>
                            <input type="text" name="eventTitle" id="eventTitle" value="<?php echo $currPromo["event"]; ?>" class="form-control field-long" placeholder="Enter Promotion Title">
                        </li> 
                        <li>
                            <label>Description: </label>
                            <textarea name="descriptionPromo" id="descriptionPromo" class="form-control field-long field-textarea" placeholder="Enter Promotion Description"><?php echo $currPromo["description"]; ?></textarea>
                        </li>
                        <li>
                            <label>Date:</label>
                            <input type="text" value="<?php echo $currPromo['date_created']; ?>" class="form-control field-long" readonly>
                        </li> 
                        <li>
                            <label>Image: <?php echo $currPromo['image']; ?></label>
                            <img src="img/events/<?php echo $currPromo['image']; ?>" class="img-thumbnail"><br>
                            Upload New Image: <input type="file" name="mynewfile" id="mynewfile">
                        </li>
                    </ul>  
                    <input class="button button1 rightAlign" name="modifyPromotion" type="submit" value="Modify">
                </form>
            </div>
        </div>
    </div>
</body>
</html>