<?php
        include "sidebar.php";

        $conn = $DB->connect();
        // $current = $_SESSION['adminID'];
        $current = "srithesigan98";
        $getUser = $conn->query("SELECT * FROM `admin` WHERE adminID = '$current'");
        $conn->close();

        while($row = $getUser->fetch_assoc()){
            $adminID = $row['adminID'];
            $adminName = $row['adminName'];
            $adminEmail = $row['adminEmail'];
            $adminContact = $row['adminContact'];
            $adminPicFile = $row['adminPicFile'];
        }

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $location = "admin_profile.php";
    $extensions= array("jpeg","jpg","png");

    $valid = true;
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pass = $_POST['password'];
    $NRIC = $_POST['NRIC'];
    $admin_pic = basename($_FILES['admin_pic']['name']);


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
    //check profile picture
    if($admin_pic) {
        $tmp = explode('.', $_FILES['admin_pic']['name']);
        $profile_file_ext = strtolower(end($tmp));
        if(in_array($profile_file_ext, $extensions) === false) {
            $profileErr = "Only jpeg, jpg, and png images are allowed";
            $valid = false;
        }
    }

    if($valid){

        $target_profile_dir= "img/PIC/";

        $target_profile_file = $target_profile_dir.basename($_FILES['admin_pic']['name']);

        $conn = $DB->connect();
        $current = "srithesigan98";
        $query_one = true;

        if($admin_pic) {
            $sql = "UPDATE `admin` SET adminPicFile='$admin_pic' WHERE adminID='$current'";
            $query_one = $conn->query($sql);
        }

        $sql = "UPDATE admin 
        SET adminName='$fullName', adminEmail='$email', adminPass='$pass', adminContact='$contact'
        WHERE adminID='$current'";

        $query_four = $conn->query($sql);
        $conn->close();

        if ($query_one && $query_four){
            move_uploaded_file($_FILES['admin_pic']['tmp_name'], $target_profile_file);
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
    <head lang="en">
        <!--    Custom styles   -->
        <title>Admin Profile</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/edit_user_profile.css" />
    </head>
    
    <body>
        <hgroup>
            <h1>Admin Profile Edit</h1>
            </hgroup>
        <!--Begin page content-->
        <section id="body">
            <div id="profile">
                <header>
                    <h1>Admin Profile</h1>
                </header>
                <form method="POST" action="admin_edit_profile.php" enctype="multipart/form-data">
                    <?php 
                        if(isset($formErr) && !empty($formErr)){ 
                            echo "<div class='error'>⚠ $formErr</div>";
                        } 
                    ?>
                    <fieldset>

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
                                    value="<?= $adminName; ?>"
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
                                    value="<?= $adminEmail; ?>"
                                    placeholder="Change your email here"
                                />
                            </li>

                            <li>
                            <label>Password:</label>
                            <input
                                size="50"
                                type="password"
                                name="password"
                                value="<?= $adminPass; ?>"
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
                                    value="<?= $adminContact; ?>"
                                    placeholder="Change your contact number here"
                                />
                            </li>

                        

                            <?php 
                                if(isset($profileErr) && !empty($profileErr)){ 
                                    echo "<div class='error'>⚠ $profileErr</div>";
                                } 
                            ?>
                            <li>
                                <label>Profile Picture:</label>profi
                                <input type="file" name="admin_pic"/>
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