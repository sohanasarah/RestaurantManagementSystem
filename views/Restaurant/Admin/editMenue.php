<?php

include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//Utility::d($_GET);
$food_item=new Admin();
$food_item->prepare($_GET);
$singleItem=$food_item->view();
//Utility::dd($singleItem);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Create Menue</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        h2 {
            font-family: "Baskerville Old Face", Times, serif;
        }
        #color
        {
            color: brown;
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
    </style>
</head>



<body>


<img id="pic" src="../../../resource/FoodImage/entry pic.jpg" height="300" width="1000">
<center><h2 id="color">Welcome Admin</h2></center>

<div class="container">
    <center><h2>Update Food Item</h2></center>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Food Reviews</a>
                    </li>
                    <li>
                        <a href="insertMenue.php">Insert Menue</a>
                    </li>
                    <li>
                        <a href="orderList.php">Order List</a>
                    </li>
                    <li>
                        <a href="totalMenue.php">View All Item</a>
                    </li>
                    <li>
                        <a href="#">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <form role="form" method="post" action="updateMenue.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $singleItem['id']?>">
        <div class="form-group">
            <label id="style">Food Category:Select One</label>
            <select name ="category" class="form-control">
                <option <?php if($singleItem['category']=="Appetizer"){?> selected="selected" <?php }?>>APPTIZER</option>
                <option <?php if($singleItem['category']=="Main Course"){?> selected="selected" <?php }?>>MAIN COURSE</option>
                <option <?php if($singleItem['category']=="DESSERTS or DRINKS"){?> selected="selected" <?php }?>>DESSERTS or DRINKS</option>
            </select>
        </div>
        <div class="form-group">
            <label id="style">Item Name</label>
            <input type="text" name ="food_name" class="form-control" value="<?php echo $singleItem['food_name']?>">
        </div>

        <div class="form-group">
            <label id="style">Item price</label>
            <input type="text" name ="price" class="form-control" value="<?php echo $singleItem['price']?>">
        </div>

        <div class="form-group">
            <label id="style">Picture of the Food Item</label>
            <input type="file" name ="food_image" class="form-control">
            <img src="../../../resource/FoodImage/<?php echo $singleItem['food_image']?>" alt="image" height="100" width="100" class="img-responsive">

        </div>

        <center><button type="submit" class="btn btn-primary btn-lg">Update</button></center>
    </form>

</div>

</body>
</html>


