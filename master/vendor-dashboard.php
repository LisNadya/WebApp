<?php
include "sidebar.php";

// $conn = $DB->connect();
// $sql = "select * from car";
// $getCar = $conn->query($sql) or die("Error in $sql");;
// $conn->close();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css\vendorDashboard.css">
    <title>
        Vendor Dashboard
    </title>
</head>

<body>
    <main id="body">
        <h1 id="overview">Overview</h1>
        <div id="caroverview">
            <div class="carbox">
                <span class="left">3</span><span class="right"> Total <br />Cars</span>
            </div>
            <!--End of carbox-->
            <div class="carbox">
                <span class="left">3</span><span class="right"> Rented <br />Cars</span>
            </div>
            <!--End of carbox-->
            <div class="carbox">
                <span class="left">0</span><span class="right"> Available <br />Cars</span>
            </div>
            <!--End of carbox-->
        </div>
        <div id="content">
            <div class="car">
                <div class="cardesc">
                    <img src="http://www.protoncommerce.com/v3/wp-content/uploads/2019/11/IRIZ-FINAL-3-copy.png" alt="Proton Iriz">
                    <div class="carinfo">
                        <p class="car-name">Proton Iriz 1.6 (A) </p>
                        <ul class="car-list">
                            <li class="car-desc">
                                5 Seater
                            </li>
                            <li class="car-desc">
                                Auto
                            </li>
                            <li class="car-desc">
                                2019
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="carstatus">Status: <br /><b>Booked</b></div>
            </div>
            <div class="car">
                <div class="cardesc">
                    <img src="https://semakanonline.com/wp-content/uploads/2019/08/axia-baru-2019-680x350.jpg" alt="Perodua Axia">
                    <div class="carinfo">
                        <p class="car-name">Perodua Axia 1.0 (M) </p>
                        <ul class="car-list">
                            <li class="car-desc">
                                5 Seater
                            </li>
                            <li class="car-desc">
                                Manual
                            </li>
                            <li class="car-desc">
                                2017
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="carstatus">Status: <br /><b>Booked</b></div>
            </div>
            <div class="car">
                <div class="cardesc">
                    <img src="https://s3.paultan.org/image/2016/01/Honda-Jazz-Carnival-Red-2-630x319.jpg" alt="Honda Jazz">
                    <div class="carinfo">
                        <p class="car-name">Honda Jazz 1.5 (A)</p>
                        <ul class="car-list">
                            <li class="car-desc">
                                5 Seater
                            </li>
                            <li class="car-desc">
                                Auto
                            </li>
                            <li class="car-desc">
                                2017
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="carstatus">Status: <br /><b>Booked</b></div>
            </div>
        </div>
        <!--End of content-->
    </main>

</body></html>