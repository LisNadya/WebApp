<?php
include "sidebar.php";

if (isset($_GET['fn'])) 
{
    $fullname = $_GET['fn'];
    $contact = $_GET['c'];
    $address = $_GET['a'];
    $paymentOption = $_GET['po'];
}

$conn = $DB->connect();
$sql = "SELECT * FROM payment ORDER BY paymentID DESC LIMIT 1";
$getPayment = $conn->query($sql) or die("Error in $sql");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!--    Custom styles   -->
        <meta charset="UTF-8" />
        <title>Payment Successful</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/payment_complete.css" />
    </head>

    <body>
        <hgroup>
            <h1>Payment</h1>
        </hgroup>
        <!--Page Content-->
        <section id="body">
            <!--Begin page content-->
            <div id="paymentC">
                <header>
                    <h1>Thank you for your purchase</h1>
                    <h2>Your payment has been successful</h2>
                </header>
                <br />
                <fieldset>

                <div class="table-box">
                        <div class="table-row table-head">
                            <div class="table-cell first-cell">
                                <p>Payment Information</p>
                            </div>
                        </div>

                        <?php
                        while($row = $getPayment->fetch_assoc()){
                            $paymentAmt = $row['paymentAmt'];
                            echo 
                            "<div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>Full name</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>$fullname</p>
                                </div>
                            </div>
                            <div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>Contact</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>$contact</p>
                                </div>
                            </div>
                            <div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>Address of Delivery</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>$address</p>
                                </div>
                            </div>
                            <div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>Payment Option</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>$paymentOption</p>
                                </div>
                            </div>
                            <div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>Payment Amount</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>RM $paymentAmt</p>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </fieldset>
                <br />
                <button onclick="window.location.href = './available_cars.php';">
                    Proceed
                </button>
            </div>
        </section>
    </body>
</html>