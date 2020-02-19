<?php
include "sidebar.php";

$conn = $DB->connect();
$sql = "select * from vendor where vendorID = '$USERID'";
$result = $conn->query($sql) or die("Error in $sql");
$conn->close();

$profile = array();
while($row = $result->fetch_assoc()){
    $profile[] = array("vendorID"=>$row["vendorID"], 
    "vendorName"=>$row["vendorName"], 
    "vendorRegNo"=>$row["vendorRegNo"], 
    "vendorEmail"=>$row["vendorEmail"], 
    "vendorContact"=>$row["vendorContact"],
    "vendorNRIC"=>$row["vendorNRIC"],
    "vendorPersonInCharge"=>$row["vendorPersonInCharge"],
    "vendorRegNoFile"=>$row["vendorRegNoFile"],
    "vendorNRICFile"=>$row["vendorNRICFile"]
);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/vendorProfile.css">
    <title>Vendor Profile</title>
</head>

<body>
    <main id="body">
        <div id="profile-box">
            <h1>Vendor Profile</h1>
            <div class="row">
                <div class="column">
                    <table>
                        <tr>
                            <th>Vendor Name: </th>
                            <td><?php echo $profile[0]["vendorName"];?></td>
                        </tr>
                        <tr>
                            <th>Email: </th>
                            <td><?php echo $profile[0]["vendorEmail"];?></td>
                        </tr>
                        <tr>
                            <th>Person In-Charged: </th>
                            <td><?php echo $profile[0]["vendorPersonInCharge"];?></td>
                        </tr>
                        <tr>
                            <th>Phone Number: </th>
                            <td><?php echo $profile[0]["vendorContact"];?></td>
                        </tr>
                        <tr>
                            <th>NRIC/Passport: </th>
                            <td><?php echo substr($profile[0]["vendorNRIC"],0,6)."-".substr($profile[0]["vendorNRIC"],6,2)."-".substr($profile[0]["vendorNRIC"],8);?></td>
                        </tr>
                    </table>
                </div>
                <div class="column">
                    <div id="ic">
                        <b>NRIC/Passport</b>
                        <img src=<?php $file = $profile[0]["vendorNRICFile"]; echo "'$file'";?>>
                        
                    </div>
                    <div id="driving-license">
                        <b>Driving License</b>
                        <img src=<?php $file = $profile[0]["vendorRegNoFile"]; echo "'$file'";?>>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
</body></html>