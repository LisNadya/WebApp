<?php
    include "db/conn.php";
    include "object/priceTable.php";
    //include "sidebar.php"

    $price = new PriceTable($DB);
    $getPrice = $price->read();
    $alertClass = "";
    $alertText = "";
    $i = 1;

    $conn = $DB->connect();
    $sql = "SELECT * FROM price";
    $getPrice = $conn->query($sql) or die("Error in $sql");

    $array1 = array();
    $sql = "SELECT price from price";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $array1 = array_merge($array1, array_map('trim', explode(",", $row['price'])));

    }

    if(isset($_GET["modifyPrice"])){
        if(empty($_GET["priceRate"])){
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Price Rate is empty, Please Try Again';
        } else {
            $price1 = $_GET["priceRate"];
            $price->updatePrice($price1, 1);
            $_SESSION["alertClass"] = 'success';
            $_SESSION["alertText"] = 'New Rate Charge Successfully Updated';
        }

        if(empty($_GET["serviceCharge"])){
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Service Charge is empty, Please Try Again';
        } else {
            $price2 = $_GET["serviceCharge"];
            $price->updatePrice($price2, 2);
            $_SESSION["alertClass"] = 'success';
            $_SESSION["alertText"] = 'New Rate Charge Successfully Updated';
        }

        if(empty($_GET["deliveryCharge"])){
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Delivery Charge is empty, Please Try Again';
        } else {
            $price3 = $_GET["deliveryCharge"];
            $price->updatePrice($price3, 3);
            $_SESSION["alertClass"] = 'success';
            $_SESSION["alertText"] = 'New Rate Charge Successfully Updated';
        }

        if(empty($_GET["extraTime"])){
            $_SESSION["alertClass"] = 'failure';
            $_SESSION["alertText"] = 'Extra Time is empty, Please Try Again';
        } else {
            $price4 = $_GET["extraTime"];
            $price->updatePrice($price4, 4);
            $_SESSION["alertClass"] = 'success';
            $_SESSION["alertText"] = 'New Rate Charge Successfully Updated';
        }

        header("Location: servicePrice.php");
    }
    
    $conn->close();
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
   <link rel="stylesheet" href="css/editServicePricePromotion.css" />
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
            <a href="cartype.html" >Manage Types of Vehicles</a>
            <a href="user.html" >Manage Users</a>
            <a href="servicePrice.html" id="selected">Manage Service Price</a>
            <a href="promotion.html">Manage Promotions</a>
          </nav>
        <div id="signOut">
            <a href="login.html"><i class="fa fa-sign-out"></i> Sign Out</a>
        </div>
    </div>
    
    <hgroup>
        <h1>Manage Service Price</h1>
    </hgroup>

    <div id="body">
        <div id="title">
            <h1>Edit Service Price</h1>
        </div>
        <div id="content"> 
            <div class="alert-box <?php echo $alertClass; ?>"><?php echo $alertText; ?></div>          
            <div class="container form-style">
                <form method="GET" id="updatePrice" action="">
                    <ul class="form-style-1">
                        <li>
                            <label>Price Rate:</label>
                            <input type="text" name="priceRate" id="priceRate" value="<?php echo number_format((float) $array1[0], 2, '.',''); ?>" class="form-control field-long" placeholder="Enter Current Price Rate">
                        </li> 
                        <li>
                            <label>Service Charge: </label>
                            <input type="text" name="serviceCharge" id="serviceCharge" value="<?php echo number_format((float) $array1[1], 2, '.',''); ?>" class="form-control field-long" placeholder="Enter Service Charge">
                        </li>
                        <li>
                            <label>Delivery Charge:</label>
                            <input type="text" name="deliveryCharge" id="deliveryCharge" value="<?php echo number_format((float) $array1[2], 2, '.',''); ?>" class="form-control field-long" placeholder="Enter Delivery Charge">
                        </li>
                        <li>
                            <label>Extra Time (Per Hour):</label>
                            <input type="text" name="extraTime" id="extraTime" value="<?php echo number_format((float) $array1[3], 2, '.',''); ?>" class="form-control field-long" placeholder="Enter Extra Time Charge Per Hour">
                        </li> 
                    </ul>  
                    <input class="button button1 rightAlign" name="modifyPrice" type="submit" value="Modify">
                </form>
            </div>
        </div>
    </div>
</body>
</html>