<?php
include "sidebar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $paymentID = $paymentAmt = $paymentDate = $bookingID = $location = "";

    $current = $_SESSION['cusID'];
    $paymentAmt = "((SELECT carPrice FROM car WHERE carID = '1') + 
        ((SELECT carPrice FROM car WHERE carID = '1') * (SELECT priceAmt FROM price WHERE priceID = '1')))"; //To be refined
    $paymentDate = "NOW()";
    $bookingID = "(SELECT bookingID FROM booking WHERE carID = '1' AND cusID = '$current')"; //To be refined
    
    $valid = true;
    $query = true;
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $paymentOption = $_POST['paymentOption'];

    //check full name
    if(!preg_match("/[a-z]/i", $fullname)) {
        $nameErr = "Only alphabets are allowed in your name";
        $valid = false;
    }
    //check phone number
    if(!preg_match("/^[0-9.]+$/", $contact) || preg_match('/\s/',$contact)) {
        $contactErr = "Invalid contact number format";
        $valid = false;
    }
    if(empty($address)) {
        $addressErr = "Please fill in your address of delivery";
        $valid = false;
    }
    if($valid){
        $conn = $DB->connect();
        $sql = "INSERT INTO payment (paymentAmt, paymentDate, bookingID) VALUES ($paymentAmt, $paymentDate, $bookingID)";
        $query = $conn->query($sql);
        $location = "payment_complete.php?fn=$fullname&c=$contact&a=$address&po=$paymentOption";
            
        $conn->close();
        if ($query){
            header("Location: $location");
        } else {
            $formErr = "Payment was not successful";
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <!--    Custom styles   -->
        <meta charset="UTF-8" />
        <title>Payment</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/payment.css" />
    </head>
    <body>
        <main id="body">
            <hgroup>
                <h1>Payment</h1>
            </hgroup>

            <!--Page Content-->
            <section id="payment">
                <!--Begin page content-->
                <header>
                    <h1>Thank you for your purchase</h1>
                    <h2>Please proceed with the payment</h2>
                </header>
                
                <br />
                <form method="POST" action="payment_page.php">
                    <?php 
                        if(isset($formErr) && !empty($formErr)){ 
                            echo "<div class='error'>⚠ $formErr</div>";
                        } 
                    ?>
                    <fieldset>
                        <legend>Payment Details</legend>

                        <ul class="payment-form">
                            <?php 
                                if(isset($nameErr) && !empty($nameErr)){ 
                                    echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $nameErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Full Name:</label>
                                <input
                                    type="text"
                                    name="fullname"
                                    placeholder="Enter your full name here"
                                    id="fullname"
                                    class="field-long"
                                />
                            </li>

                            <?php 
                                if(isset($contactErr) && !empty($contactErr)){ 
                                    echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $contactErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Contact Number:</label>
                                <input
                                    type="tel"
                                    name="contact"
                                    placeholder="Enter your contact number here"
                                    id="contact"
                                    class="field-long"
                                />
                            </li>

                            <?php 
                                if(isset($addressErr) && !empty($addressErr)){ 
                                    echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $addressErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Adress of Delivery:</label>
                                <textarea
                                    name="address"
                                    placeholder="Enter address for delivery here"
                                    id="address"
                                    class="field-textarea"
                                ></textarea
                                >
                            </li>
                            
                            <li>
                                <label>Payment via:</label>
                                <select name="paymentOption" id="paymentOption">
                                    <option value="Direct Payment">Direct Payment</option>
                                    <option value="Online Banking">Online Banking</option>
                                    <option value="Credit/Debit card">Credit/Debit card</option>
                                </select>
                            </li>
                        </ul>
                    </fieldset>
                    <br />
                    <!-- <a href="payment_complete.php?fn=<?= $fullname; ?>"> -->
                        <button type="submit" value="payment_submit" name="payment_submit">
                            Proceed
                        </button>
                    <!-- </a> -->
                    <button type="reset" name="reset">
                        Clear Form
                    </button>
                </form>
            </section>
        </main>
    </body>
</html>