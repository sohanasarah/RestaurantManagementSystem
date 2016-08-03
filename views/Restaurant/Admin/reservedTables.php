<?php
session_start();
include_once('../../../vendor/autoload.php');

use App\Reservation\Reservation;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;



if(!isset($_SESSION) )session_start();

use App\Admin\Auth;


$auth = new Auth();
$loggedIn = $auth->logged_in();

if(!$loggedIn) {
    return Utility::redirect('Profile/admin-login.php');
}

$reservation= new Reservation();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Table Reservation Chart</title>
    <link href="../../../resource/Admin/css/thumbnail-gallery.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.min.css">
    <script src="../../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../../resource/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <style>
        center
        {
            color: #112e31;
            font-family:bold,"Baskerville Old Face", Times, serif;
            font-size: medium;
        }

        th {
            background-color: #08a6af;
            color: white;
        }

        tr:hover{background-color: #e7faec
        }

        #detail
        {

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        }
    </style>
</head>

<body>

<?php include("topNavigation.php"); ?>


<div class="container">

    <?php include("messageBox.php");?>

    <center><h2>Reserved Tables For <?php if(isset( $_REQUEST['reservationDate'])) echo $_REQUEST['reservationDate']; else { $_REQUEST['reservationDate']= date("Y-m-d");  echo $_REQUEST['reservationDate'];} ?></h2></center>

    <br><br>

    <table style="height: 870px; border-color: #08a6af; margin-left: auto; margin-right: auto;" border="3" width="1106">
        <tbody>
        <tr>
            <td style="text-align: center;">&nbsp;</td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">10am-11am</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">11am-12pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">12pm-1pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">1pm-2pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">2pm-3pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">3pm-4pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">4pm-5pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">5pm-6pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">6pm-7pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">7pm-8pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">8pm-9pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">9pm-10pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">10pm-11pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
            <td style="border-color: white; text-align: center; background-color: #08a6af;"><span style="color: white;">&nbsp;</span>
                <h4><span style="color: white;">11pm-12pm</span></h4>
                <span style="color: white;">&nbsp;</span></td>
        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#1</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#1 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>




        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#2</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#2 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#3</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#3 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#4</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#4 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#5</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#5 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#6</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#6 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#7</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#7 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#8</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#8 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#9</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#9 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#10</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#10 - 4 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>


        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#11</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#11 - 13 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#12</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#12 - 10 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#13</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#13 - 10 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#14</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#14 - 10 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#15</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#15 - 6 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#16</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#16 - 6 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        <tr>
            <td style="text-align: center; background-color: purple;">
                <p><span style="color: white;"><strong>TABLE#17</strong></span></p>
            </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "10:00am-10:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "11:00am-11:59am"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "12:00pm-12:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "1:00pm-1:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "2:00pm-2:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "3:00pm-3:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "4:00pm-4:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "5:00pm-5:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "6:00pm-6:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "7:00pm-7:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "8:00pm-8:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "9:00pm-9:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "10:00pm-10:59pm"); ?>  </td>
            <td style="text-align: center;"> <?php echo "".$reservation->getInvoiceID("Table#17 - 6 Seated", $_REQUEST['reservationDate'], "11:00pm-11:59pm"); ?>  </td>

        </tr>
        </tbody>
    </table>



    <hr>
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>


</div>

<script>
    $("button#expand").click(function() {
        $('td#expansion').show();
    });
</script>
</body>
</html>
