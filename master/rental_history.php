<?php
include "sidebar.php";

$conn = $DB->connect();
$current = $_SESSION['cusID'];
$sql = "SELECT carModel, carPlateNo, paymentDate, bookingDate, bookingDuration FROM car 
    INNER JOIN (booking INNER JOIN payment ON payment.bookingID = booking.bookingID) ON car.carID = booking.carID
    WHERE booking.cusID = '$current'
    GROUP BY bookingDate";
$getHistory = $conn->query($sql) or die("Error in $sql");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $starting_date = $_POST['rental_history'];
    $sql = "SELECT carModel, carPlateNo, paymentDate, bookingDate, bookingDuration FROM car 
    INNER JOIN (booking INNER JOIN payment ON payment.bookingID = booking.bookingID) ON car.carID = booking.carID
    WHERE bookingDate > '$starting_date' AND booking.cusID = '$current'
    GROUP BY bookingDate";
    $getHistory = $conn->query($sql) or die("Error in $sql");
}
$conn->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <!--    Custom styles   -->
        <title>Rental History</title>
        <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="./css/default.css" />
        <link rel="stylesheet" href="./css/history.css" />
    </head>

    <body>
        <hgroup>
            <h1>Rental History</h1>
        </hgroup>
        <main id="body">
            <section id="history">
                <header>
                    <h1>Car Rent History</h1>
                </header>
                <br />
                <form method="POST">
                    <label>From:</label>
                    <input type="date" name="rental_history" />
                    <button type="submit" name="submit" value="submit">
                        Enter
                    </button>
                </form>
                <br />
                <br />
                <fieldset>
                    <legend>Car Rent Details</legend>

                    <div class="table-box">
                        <div class="table-row table-head">
                            <div class="table-cell first-cell">
                                <p>No</p>
                            </div>
                            <div class="table-cell second-cell">
                                <p>Car Model</p>
                            </div>
                            <div class="table-cell third-cell">
                                <p>Car Plate No</p>
                            </div>
                            <div class="table-cell fourth-cell">
                                <p>Date of Payment</p>
                            </div>
                            <div class="table-cell fifth-cell">
                                <p>Date of Pickup</p>
                            </div>
                            <div class="table-cell last-cell">
                                <p>Date of Return</p>
                            </div>
                        </div>

                        <?php
                        $number = 1;
                        while($row = $getHistory->fetch_assoc()){
                            $carModel = $row['carModel'];
                            $carPlateNo = $row['carPlateNo'];
                            $paymentDate = $row['paymentDate'];
                            $bookingDate = $row['bookingDate'];
                            $bookingDuration = $row['bookingDuration'];
                            echo 
                            "<div class='table-row'>
                                <div class='table-cell first-cell'>
                                    <p>$number</p>
                                </div>
                                <div class='table-cell second-cell'>
                                    <p>$carModel</p>
                                </div>
                                <div class='table-cell third-cell'>
                                    <p>$carPlateNo</p>
                                </div>
                                <div class='table-cell fourth-cell'>
                                    <p>$paymentDate</p>
                                </div>
                                <div class='table-cell fifth-cell'>
                                    <p>$bookingDate</p>
                                </div>
                                <div class='table-cell last-cell'>
                                    <p>$bookingDuration</p>
                                </div>
                            </div>";
                            $number++;
                        }
                        ?>
                    </div>
                </fieldset>
                <br />
            </section>
        </main>
    </body>
</html>
