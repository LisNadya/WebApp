<?php
include "sidebar.php";

$conn = $DB->connect();
$current = $_SESSION['cusID'];
$getUser = $conn->query("SELECT * FROM customer WHERE cusID = '$current'");
$conn->close();

$target_NRIC_dir = "img/NRIC/";
$target_licence_dir = "img/licence/";

while($row = $getUser->fetch_assoc()){
    $cusID = $row['cusID'];
    $cusName = $row['cusName'];
    $cusEmail = $row['cusEmail'];
    $cusContact = $row['cusContact'];
    $cusDrivingLicence = $row['cusDrivingLicence'];
    $cusNRIC = $row['cusNRIC'];
    $cusLicencePicFile = $row['cusLicencePicFile'];
    $cusNRICPicFile = $row['cusNRICPicFile'];

    $cusNRICPicFile = $target_NRIC_dir.$cusNRICPicFile;
    $cusLicencePicFile = $target_licence_dir.$cusLicencePicFile;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <!--    Custom styles   -->
        <title>User Profile</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/user_profile.css" />
    </head>
    
    <body>
        <hgroup>
            <h1>User Profile</h1>
        </hgroup>
        <main id="body">
            <section id="profile">
                <header>
                    <h1>User Profile</h1>
                </header>
                <fieldset>
                    <legend>User Details</legend>
                    <table>
                        <tr>
                            <td class="leftside">Username:&nbsp;</td>
                            <td><?= $cusID; ?></td>
                            <td rowspan="3">NRIC/Passport<br/>
                                <img src='<?= $cusNRICPicFile; ?>' width='202.5px' height='127.5px'>
                            </td>
                        </tr>
                        <tr>
                            <td class="leftside">Full Name:&nbsp;</td>
                            <td><?= $cusName; ?></td>
                        </tr>
                        <tr>
                            <td class="leftside">Email:&nbsp;</td>
                            <td><?= $cusEmail; ?></td>
                        </tr>
                        <tr>
                            <td class="leftside">Phone Number:&nbsp;</td>
                            <td><?= $cusContact; ?></td>
                            <td rowspan="3">Licence <br/>
                                <img src='<?= $cusLicencePicFile; ?>' width='202.5px' height='127.5px'>
                            </td>
                        </tr>
                        <tr>
                            <td class="leftside">NRIC/Passport:&nbsp;</td>
                            <td><?= $cusNRIC; ?></td>
                        </tr>
                        <tr>
                            <td class="leftside">Licence Number:&nbsp;</td>
                            <td><?= $cusDrivingLicence; ?></td>
                        </tr>
                    </table>
                </fieldset>
                <br />
                <button onclick="window.location.href = './edit_profile.php';">
                    Edit Profile
                </button>
                
            </section>
        </main>
    </body>
</html>
