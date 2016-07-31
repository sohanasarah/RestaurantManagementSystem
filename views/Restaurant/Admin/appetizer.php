<?php

include_once('../../../vendor/autoload.php');

use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;



if(!isset($_SESSION) )session_start();

use App\Admin\Auth;
use App\Admin\Admin;


$auth = new Auth();
$loggedIn = $auth->logged_in();

if(!$loggedIn) {
    return Utility::redirect('Profile/admin-login.php');
}

//
$food_item=new Admin();
$allFood=$food_item->getMenueByCategory('Appetizer');

//Utility::d($allFood);
//Utility::d($_FILES);


?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Menue-Appetizer</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.min.css">
    <script src="../../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../../resource/bootstrap-3.3.6/js/bootstrap.min.js"></script>

    <!--    <link href="../../../resource/Admin/css/thumbnail-gallery.css" rel="stylesheet">-->
    <style>

        h2 {
            font-family: "Baskerville Old Face", Times, serif;
            position: absolute;
            top: 100px;
            width: 100%;
        }
        h2 span {
            color: white;
            font: bold 24px/45px "Baskerville Old Face", Times, serif;
            letter-spacing: 0px;
            background: rgb(0, 0, 0); /* fallback color */
            background: rgba(0, 0, 0, 0.6);
            padding: 10px;
            max-width : 100%;
        }
        h2 span.spacer {
            padding:0 5px;
        }
        #color
        {
            color: brown;
            font: bold 24px/45px "Baskerville Old Face", Times, serif;
        }

        #pic {
            min-height : 100%;
            min-width : 100%;
            background-size:100% 100%;
            background-repeat:no-repeat;
            overflow-y: hidden;
            overflow-x: hidden;
        }

        .image {
            position: relative;
            width: 100%; /* for IE 6 */

        }
        center
        {
            color: black;
            font-family:bold,"Baskerville Old Face", Times, serif;
            font-size: medium;
        }

    </style>

</head>

<body>

<div class="image">

    <img id="pic" src="../../../resource/FoodImage/entry pic.jpg" height="250" width="900">
    <?php include("messageBox.php"); ?>

</div>

<div class="container">

    <center><h3 id="color">Appetizer</h3></center>

    <!-- Navigation -->
    <?php include("topNavigation.php"); ?>

    <!-- Page Content -->

    <div class="row">
        <?php
        $sl=0; ?>


        <?php foreach($allFood as $food) {

            $sl++; ?>
            <div class="col-lg-4 col-md-4 col-xs-12 thumb">


                <a class="thumbnail" href="../../../resource/FoodImage/<?php echo $food['food_image']?>">
                    <img src="../../../resource/FoodImage/<?php echo $food['food_image']?>" alt="image" height="100" width="100" class="img-responsive ">
                    <center><?php echo " ".$food['food_name']?></center>
                    <center>Item Code:<?php echo " ".$food['food_code']?></center>
                    <center>Price: <?php echo " ".$food['price']?></center>
                </a>
                <center><a href="editMenue.php?id=<?php echo $food['id']?>" class="btn btn-primary" role="button">Edit</a>
                    <a href="deleteItem.php?id=<?php echo $food['id']?>" class="btn btn-danger" role="button">Delete</a></center>
            </div>

            <?php
            if ( $sl % 3 === 0 ) { echo '</div><div class="row">'; }
        }?>


    </div>

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
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>

