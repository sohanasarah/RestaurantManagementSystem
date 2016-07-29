<?php

include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//
$food_item=new Admin();
$allFood=$food_item->getMenueByCategory('DESSERTS or DRINKS');

//Utility::d($allFood);
//Utility::d($_FILES);


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menue-Admin</title>
    <!-- Custom CSS -->
    <link href="../../../resource/Admin/css/thumbnail-gallery.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.min.css">
    <script src="../../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../../resource/bootstrap-3.3.6/js/bootstrap.min.js"></script>
    <style>
        center
        {
            color: black;
            font-family:bold,"Baskerville Old Face", Times, serif;
            font-size: medium;
        }
    </style>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top navbar-right" role="navigation">
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
                    <a href="#">Order List</a>
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

<!-- Page Content -->
<div class="container">
    <div>
        <form role="form">
            <div class="form-group">
                <label>How many items per page? (select one):</label>
                <select class="form-control" name="itemPerPage">
                    <option<?php if($itemPerPage==5){?> selected <?php }?>>5</option>
                    <option<?php if($itemPerPage==10){?> selected <?php }?>>10</option>
                    <option<?php if($itemPerPage==15){?> selected <?php }?>>15</option>
                    <option<?php if($itemPerPage==20){?> selected <?php }?>>20</option>
                    <option<?php if($itemPerPage==25){?> selected <?php }?>>25</option>
                </select>
                <br>
                <button type="submit">Go!</button>
            </div>
        </form>
    </div>

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



    <!--        <div>-->
    <!--            <center><ul class="pagination">-->
    <!--                    --><?php //if($pageNumber>1){?>
    <!--                        <li><a href="totalMenue.php?pageNumber=--><?php //echo $prevPage?><!--">Prev</a></li>-->
    <!--                    --><?php //}?>
    <!--                    --><?php //echo $pagination?>
    <!--                    --><?php //if($pageNumber<$totalPage){?>
    <!--                        <li><a href="totalMenue.php?pageNumber=--><?php //echo $nextPage?><!--">Next</a></li>-->
    <!--                </ul></center>-->
    <!--        </div>-->
    <!--    --><?php //} ?>
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
