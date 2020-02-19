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

    // $conn = $DB->connect();
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
                <tr>
                    <td>Perodua Axia</td>
                    <td>RM30/day</td>
                    <td>11/1/2020</td>
                    <td>20/1/2020</td>
                    <td>9 Day(s)</td>
                    <td>RM270</td>
                </tr>
                <tr>
                    <td>Proton Iriz</td>
                    <td>RM40/day</td>
                    <td>5/1/2020</td>
                    <td>10/1/2020</td>
                    <td>5 Day(s)</td>
                    <td>RM200</td>
                </tr>
                <tr>
                    <td>Perodua Alza</td>
                    <td>RM60/day</td>
                    <td>10/1/2020</td>
                    <td>17/1/2020</td>
                    <td>7 Day(s)</td>
                    <td>RM420</td>
                </tr>
                <tr>
                    <td>Honda Jazz</td>
                    <td>RM90/day</td>
                    <td>10/1/2020</td>
                    <td>11/1/2020</td>
                    <td>1 Day(s)</td>
                    <td>RM90</td>
                </tr>
                <tr>
                    <th colspan="5">Total Profit</th>
                    <td>RM980</td>
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
                            RM98
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
                            RM58.8
                        </td>
                    </tr>
                    <tr>
                        <th class="profit">
                            Nett Profit:
                        </th>
                        <td>
                            <b>RM823.2</b>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </main>
</body>
