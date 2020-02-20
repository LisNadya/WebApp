<?php
include 'sidebar.php';

$conn = $DB->connect();
$sql = "select *, case when booked = 1 then 'Booked' else 'Available' end as carBooked from car where vendorID = '$USERID'";
$getCar = $conn->query($sql) or die("Error in $sql");

$sql = "select count(carID) as noCar from car where vendorID = '$USERID'";
$getNoCar = $conn->query($sql) or die("Error in $sql");

$sql = "select count(carID) as noCar from car where vendorID = '$USERID' and booked = 1";
$getNoBookedCar = $conn->query($sql) or die("Error in $sql");

$sql = "select count(carID) as noCar from car where vendorID = '$USERID' and booked = 0";
$getNoAvailableCar = $conn->query($sql) or die("Error in $sql");
$conn->close();


$profile = array();
while($row = $getCar->fetch_assoc()){
    $profile[] = array('vendorID'=>$row['vendorID'], 
    'carPlateNo'=>$row['carPlateNo'], 
    'carRoadTaxExpDate'=>$row['carRoadTaxExpDate'], 
    'carBrand'=>$row['carBrand'], 
    'carModel'=>$row['carModel'],
    'carColor'=>$row['carColor'],
    'carYearBought'=>$row['carYearBought'],
    'carType'=>$row['carType'],
    'carNoSeats'=>$row['carNoSeats'],
    'carPicFile'=>$row['carPicFile'],
    'carPrice'=>$row['carPrice'],
    'carBooked'=>$row['carBooked'],
);
}

$noCar = $noBookedCar = $noAvailableCar = 0;
while($row = $getNoCar->fetch_assoc()){
    $noCar = $row['noCar'];
}
while($row = $getNoBookedCar->fetch_assoc()){
    $noBookedCar = $row['noCar'];
}
while($row = $getNoAvailableCar->fetch_assoc()){
    $noAvailableCar = $row['noCar'];
}
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='css\vendorDashboard.css'>
    <title>
        Vendor Dashboard
    </title>
    
    <style>
        #body{
            left:50px;
        }

        body{
            background:#f8f4f3;
        }

        .carbox{
            background:#e94b2e;
            color:black;
            border:none;
        }

        .carbox .left, .carbox .right{
            color:black;
        }
        
        .car-list{
            margin-left:50px;
        }

        .cardesc{
            box-shadow:2px 2px 2px #ccc;
        }
    </style>
</head>

<body>
    <main id='body'>
        <h1 id='overview'>Overview</h1>
        <div id='caroverview'>
            <div class='carbox'>
                <span class='left'><?php echo $noCar?></span><span class='right'> Total <br />Cars</span>
            </div>
            <!--End of carbox-->
            <div class='carbox'>
                <span class='left'><?php echo $noBookedCar?></span><span class='right'> Rented <br />Cars</span>
            </div>
            <!--End of carbox-->
            <div class='carbox'>
                <span class='left'><?php echo $noAvailableCar;?></span><span class='right'> Available <br />Cars</span>
            </div>
            <!--End of carbox-->
        </div>
        <div id='content'>
            <?php 

            foreach($profile as $i => $val){
                $picFile = $val["carPicFile"];
                $carBrand = $val['carBrand'] ;
                $carModel = $val['carModel'];
                $carNoSeats = $val['carNoSeats'];
                $carType = $val['carType'];
                $carYearBought = $val['carYearBought'];
                $carColor = $val['carColor'];
                $carBooked = $val['carBooked'];
                echo "
                <div class='car'>
                    <div class='cardesc'>
                        <img src='$picFile' alt='Proton Iriz'>
                        <div class='carinfo'>
                            <p class='car-name'>$carBrand $carModel</p>
                            <ul class='car-list'>
                                <li class='car-desc'>
                                    $carNoSeats Seater
                                </li>
                                <li class='car-desc'>
                                    $carType
                                </li>
                                <li class='car-desc'>
                                    $carYearBought
                                </li>
                                <li class='car-desc'>
                                    $carColor Color
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class='carstatus'>Status: <br /><b>$carBooked </b></div>
                </div>";
            }
            ?>
        </div>
        <!--End of content-->
    </main>

</body></html>