        <?php
        include "sidebar.php";



        $conn = $DB->connect();
        // $current = $_SESSION['adminID'];
        $current = "srithesigan98";
        $getUser = $conn->query("SELECT * FROM `admin` WHERE adminID = '$current'");
        $conn->close();

        $target_pic_dir = "img/PIC/";



        while($row = $getUser->fetch_assoc()){
            $adminID = $row['adminID'];
            $adminName = $row['adminName'];
            $adminEmail = $row['adminEmail'];
            $adminContact = $row['adminContact'];
            $adminPicFile = $row['adminPicFile'];

            $adminPicFile = $target_pic_dir.$adminPicFile;
        }

        ?>

<!DOCTYPE html>
<html lang="en">
    <head lang="en">
        <!--    Custom styles   -->
        <title>Admin Profile</title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/default.css" />
        <link rel="stylesheet" href="css/user_profile.css" />
    </head>
    
    <body>
        <hgroup>
            <h1>Admin Profile</h1>
        </hgroup>
        <main id="body">
            <section id="profile">
                <header>
                    <h1>Admin Profile</h1>
                </header>
                <fieldset>
                    <legend>Admin Details</legend>
                    <table>
                        <tr>
                            <td class="leftside">Username:&nbsp;</td>
                            <td><?php echo $adminID; ?></td>
                            <td rowspan="3">Picture/Passport<br/>
                                <img src='<?= $adminPicFile; ?>' width='202.5px' height='127.5px'>
                            </td>
                        </tr>
                        <tr>
                            <td class="leftside">Full Name:&nbsp;</td>
                            <td><?php echo $adminName; ?></td>
                        </tr>
                        <tr>
                            <td class="leftside">Email:&nbsp;</td>
                            <td><?php echo $adminEmail; ?></td>
                        </tr>
                        <tr>
                            <td class="leftside">Phone Number:&nbsp;</td>
                            <td><?php echo $adminContact; ?></td>
                        </tr>
                    </table>
                </fieldset>
                <br />
                <button onclick="window.location.href = './admin_edit_profile.php';">
                    Edit Profile
                </button>
                
            </section>
        </main>
    </body>
</html>
