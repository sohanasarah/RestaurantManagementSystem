<?php
include_once('../../../vendor/autoload.php');

if(!isset($_SESSION) )session_start();
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

use App\Admin\Auth;
use App\Admin\Admin;


$auth = new Auth();
$loggedIn = $auth->logged_in();

if(!$loggedIn) {
    return Utility::redirect('Profile/admin-login.php');
}
?>





<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Create Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
        #style
        {
            font-family: "fantasy", Times, serif;
            font-size: 150%;
            color: darkcyan;
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
        #wrapper .text {
            position:relative;
            bottom:30px;
            left:0px;
            visibility:hidden;
        }

        #wrapper:hover .text {
            visibility:visible;
        }
    </style>
</head>



<body>

<div class="image">

    <img id="pic" src="../../../resource/FoodImage/entry pic.jpg" height="250" width="900">
    <?php include("messageBox.php"); ?>

</div>

<div class="container">

    <center><h3 id="color">Insert Food Item</h3></center>


    <?php include("topNavigation.php"); ?>
    
    
    
    
    
    
    <form role="form" method="post" action="store.php" enctype="multipart/form-data">
        <div class="form-group">
            <label id="style">Food Category:Select One</label>
            <select name ="category" class="form-control">
                <option value="Appetizer">APPETIZER</option>
                <option value="Main Course">MAIN COURSE</option>
                <option value="DESSERTS or DRINKS">DESSERTS or DRINKS</option>
                </select>
        </div>
        <div class="form-group">
            <label id="style">Item Name</label>
            <input type="text" name ="food_name" class="form-control" placeholder="Enter Food Item Name">
        </div>

        <div class="form-group">
            <label id="style">Item price</label>
            <input type="text" name ="price" class="form-control" placeholder="Enter Item Price">
        </div>

        <div class="form-group">
            <label id="style">Picture of the Food Item</label>
            <input type="file" name ="food_image" class="form-control">
        </div>

        <center><button type="submit" class="btn btn-primary btn-lg">Submit</button></center>
    </form>

</div>

</body>
</html>

