<?php
include "sidebar.php";

$conn = $DB->connect();
$current = $_SESSION['userID'];
$getUser = $conn->query("SELECT * FROM customer WHERE cusID = '$current'");
$conn->close();

while($row = $getUser->fetch_assoc()){
    $cusId = $row['cusID'];
    $cusName = $row['cusName'];
    $cusEmail = $row['cusEmail'];
    $cusPass = $row['cusPass'];
    $cusContact = $row['cusContact'];
    $cusDrivingLicence = $row['cusDrivingLicence'];
    $cusNRIC = $row['cusNRIC'];
    $cusLicencePicFile = $row['cusLicencePicFile'];
    $cusNRICPicFile = $row['cusNRICPicFile'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $location = "user_profile.php";
    $extensions= array("jpeg","jpg","png");

    $valid = true;
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pass = $_POST['password'];
    $NRIC = $_POST['NRIC'];
    $licence = $_POST['licence'];
    $profile_pic = basename($_FILES['profile_pic']['name']);
    $NRIC_card = basename($_FILES['NRIC_card']['name']);
    $licence_card = basename($_FILES['licence_card']['name']);

    //check full name
    if(!preg_match("/[a-z]/i", $fullName)) {
        $nameErr = "Only alphabets are allowed in your name";
        $valid = false;
    }
    //check email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $valid = false;
    }
    //check phone number
    if(!preg_match("/^[0-9.]+$/", $contact) || preg_match('/\s/',$contact)) {
        $contactErr = "Invalid contact number format";
        $valid = false;
    }
    //check NRIC number
    if(!preg_match("/[0-9]{12}/", $NRIC) || preg_match('/\s/',$NRIC)) {
        $NRICErr = "Invalid NRIC format";
        $valid = false;
    }
    //check licence number
    if(!preg_match("/[0-9]{8}/", $licence) || preg_match('/\s/',$licence)) {
        $licenceErr = "Invalid licence number format";
        $valid = false;
    }
    //check profile picture
    if($profile_pic) {
        $tmp = explode('.', $_FILES['profile_pic']['name']);
        $profile_file_ext = strtolower(end($tmp));
        if(in_array($profile_file_ext, $extensions) === false) {
            $profileErr = "Only jpeg, jpg, and png images are allowed";
            $valid = false;
        }
    }
    //check NRIC card image
    if($NRIC_card) {
        $tmp = explode('.', $_FILES['NRIC_card']['name']);
        $NRIC_file_ext = strtolower(end($tmp));
        if(in_array($NRIC_file_ext, $extensions) === false) {
            $NRICCardErr = "Only jpeg, jpg, and png images are allowed";
            $valid = false;
        }
    }
    //check licence card image
    if($licence_card) {
        $tmp = explode('.', $_FILES['licence_card']['name']);
        $licence_file_ext = strtolower(end($tmp));
        if(in_array($licence_file_ext, $extensions) === false) {
            $licenceCardErr = "Only jpeg, jpg, and png images are allowed";
            $valid = false;
        }
    } 
    

    if($valid){
        $target_profile_dir = "img/profile/";
        $target_NRIC_dir = "img/NRIC/";
        $target_licence_dir = "img/licence/";

        $target_profile_file = $target_profile_dir.basename($_FILES['profile_pic']['name']);
        $target_NRIC_file = $target_NRIC_dir.basename($_FILES['NRIC_card']['name']);
        $target_licence_file = $target_licence_dir.basename($_FILES['licence_card']['name']);

        $conn = $DB->connect();
        $current = "MoHamEdy92";
        $query_one = true;
        $query_two = true;
        $query_three = true;

        if($profile_pic) {
            $sql = "UPDATE customer SET cusPicFile='$profile_pic' WHERE cusID='$current'";
            $query_one = $conn->query($sql);
        }

        if($NRIC_card) {
            $sql = "UPDATE customer SET cusNRICPicFile='$NRIC_card' WHERE cusID='$current'";
            $query_two = $conn->query($sql);
        }

        if($licence_card) {
            $sql = "UPDATE customer SET cusLicencePicFile='$licence_card' WHERE cusID='$current'";
            $query_three = $conn->query($sql);
        }

        $sql = "UPDATE customer 
        SET cusName='$fullName', cusEmail='$email', cusPass='$pass', cusContact='$contact', cusDrivingLicence='$licence', cusNRIC='$NRIC'
        WHERE cusID='$current'";

        $query_four = $conn->query($sql);
        $conn->close();

        if ($query_one && $query_two && $query_three && $query_four){
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_profile_file);
            move_uploaded_file($_FILES['NRIC_card']['tmp_name'], $target_NRIC_file);
            move_uploaded_file($_FILES['licence_card']['tmp_name'], $target_licence_file);
            header("Location: $location");
        }
        else{
            $formErr = "Profile edit was not successful";
        }

        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!--    Custom styles   -->
        <title>Edit Profile</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/edit_user_profile.css" />
    </head>

    <body>
        <hgroup>
            <h1>Edit Profile</h1>
        </hgroup>
        <!--Begin page content-->
        <section id="body">
            <div id="profile">
                <header>
                    <h1>User Profile</h1>
                </header>
                <form method="POST" action="edit_profile.php" enctype="multipart/form-data">
                    <?php 
                        if(isset($formErr) && !empty($formErr)){ 
                            echo "<div class='error'>⚠ $formErr</div>";
                        } 
                    ?>
                    <fieldset>
                        <legend>Payment Details</legend>

                        <ul class="profile-form">
                            <?php 
                                if(isset($nameErr) && !empty($nameErr)){ 
                                    echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $nameErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Fullname:</label>
                                <input
                                    size="50"
                                    type="text"
                                    name="name"
                                    value="<?= $cusName; ?>"
                                    placeholder="Change your fullname here"
                                />
                            </li>

                            <?php 
                                if(isset($emailErr) && !empty($emailErr)){ 
                                    echo "<div class='error'>⚠ $emailErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Email:</label>
                                <input
                                    size="50"
                                    type="email"
                                    name="email"
                                    value="<?= $cusEmail; ?>"
                                    placeholder="Change your email here"
                                />
                            </li>

                            <li>
                            <label>Password:</label>
                            <input
                                size="50"
                                type="password"
                                name="password"
                                value="<?= $cusPass; ?>"
                                placeholder="Change your password here"
                            />
                            </li>

                            <?php 
                                if(isset($contactErr) && !empty($contactErr)){ 
                                    echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $contactErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Phone Number:</label>
                                <input
                                    size="50"
                                    type="tel"
                                    name="contact"
                                    value="<?= $cusContact; ?>"
                                    placeholder="Change your contact number here"
                                />
                            </li>

                            <?php 
                                if(isset($NRICErr) && !empty($NRICErr)){ 
                                    echo "<div class='error'>⚠ $NRICErr</div>";
                                } 
                            ?>
                            <li>
                                <label>NRIC/Passport:</label>
                                <input
                                    size="50"
                                    type="text"
                                    name="NRIC"
                                    value="<?= $cusNRIC; ?>"
                                    placeholder="Change your NRIC/Passport number here without -"
                                />
                            </li>

                            <?php 
                                if(isset($licenceErr) && !empty($licenceErr)){ 
                                    echo "<div class='error'>⚠ $licenceErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Licence Number:</label>
                                <input
                                    size="50"
                                    type="text"
                                    name="licence"
                                    value="<?= $cusDrivingLicence; ?>"
                                    placeholder="Change your licence number here"
                                />
                            </li>

                            <?php 
                                if(isset($profileErr) && !empty($profileErr)){ 
                                    echo "<div class='error'>⚠ $profileErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Profile Picture:</label>
                                <input type="file" name="profile_pic"/>
                            </li>

                            <?php 
                                if(isset($NRICCardErr) && !empty($NRICCardErr)){ 
                                    echo "<div class='error'>⚠ $NRICCardErr</div>";
                                } 
                            ?>
                            <li>
                                <label>NRIC/Passport Card:</label>
                                <input type="file" name="NRIC_card" value="<?= $cusNRICPicFile; ?>" />
                            </li>

                            <?php 
                                if(isset($licenceCardErr) && !empty($licenceCardErr)){ 
                                    echo "<div class='error'>⚠ $licenceCardErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Licence Card:</label>
                                <input type="file" name="licence_card" value="<?= $cusLicencePicFile; ?>" />
                            </li>
                        </ul>
                        
                    </fieldset>
                    <br />
                    <footer class="footButton">
                        <button type="submit" value="submit" name="submit">
                            Save
                        </button>
                        <button type="reset" name="reset">
                            Clear Form
                        </button>
                    </footer>
                </form>
            </div>
        </section>
    </body>
</html>