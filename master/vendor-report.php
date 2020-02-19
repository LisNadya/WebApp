<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/vendorReport.css">
    <title>Vendor Monthly Report</title>
</head>

<body>
    <?php
    include "sidebar.php";

    $conn = $DB->connect();
    // $sql = "select * from car";
    // $getCar = $conn->query($sql) or die("Error in $sql");;
    // $conn->close();

    ?>
    <main id="body">
        <div id="profile-box">
            <h1>Monthly Report for <?php echo date('F, Y') ?></h1>
            <table id="car-rented">
                <tr>
                    <th>Car</th>
                    <th>Daily Rate</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>No. of Days</th>
                    <th>Profit</th>
                </tr>
                <?php
                    $totalprofit = 0.0;
                    $sqlquery = mysqli_query($conn, "select * from car where booked = 1 and month(enddate) = month(current_date())");
                    while($row = mysqli_fetch_array($sqlquery)){
                        echo "<tr>";
                        echo "<td>".$row['carModel']."</td>";
                        echo "<td>"."RM".$row['carPrice']."/day</td>";
                        echo "<td>".$row['startdate']."</td>";
                        echo "<td>".$row['enddate']."</td>";
                        $date1 = new DateTime($row['startdate']);
                        $date2 = new DateTime($row['enddate']);
                        $interval = $date1->diff($date2);
                        echo "<td>".$interval->d." Day(s)</td>";
                        echo "<td>RM ".number_format($interval->d * $row['carPrice'],2)."</td>";
                        $totalprofit = (float)$totalprofit + (float)($interval->d * $row['carPrice']);
                    }
                ?>
                <tr>
                    <th colspan="5">Total Profit</th>
                    <td>RM <?php echo number_format($totalprofit,2); ?></td>
                </tr>
            </table>
            <div id="profit-calculator">
                <p><b>Profit Calculator</b></p>
                <table>
                    <tr>
                        <th class="profit">
                            Service Tax:
                        </th>
                        <td>
                            10%
                        </td>
                    </tr>
                    <tr>
                        <th class="profit">
                            Service Fee:
                        </th>
                        <td>
                            RM <?php echo $servicefee = $totalprofit * 0.1; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="profit">
                            GST:
                        </th>
                        <td>
                            6%
                        </td>
                    </tr>
                    <tr>
                        <th class="profit">
                            GST Fee:
                        </th>
                        <td>
                        RM <?php echo $gst = $totalprofit * 0.06; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="profit">
                            Nett Profit:
                        </th>
                        <td>
                            <b>RM <?php echo number_format($totalprofit - $servicefee - $gst,2); ?></b>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </main>
</body>
