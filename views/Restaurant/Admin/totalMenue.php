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



//Utility::d($_GET);
$food_item=new Admin();
//$allFood=$food_item->getTotalMenue();

//Utility::d($allFood);
//Utility::d($_FILES);
if(array_key_exists('itemPerPage',$_SESSION)) {
    if (array_key_exists('itemPerPage', $_GET)) {
        $_SESSION['itemPerPage'] = $_GET['itemPerPage'];
    }
}
else{
    $_SESSION['itemPerPage']=10;
}

$itemPerPage=$_SESSION['itemPerPage'];
//Utility::d($itemPerPage);
$totalItem=$food_item->count();

$totalPage=ceil($totalItem/$itemPerPage);

$pagination="";
//Utility::d($_GET);

if(array_key_exists('pageNumber',$_GET)){
    $pageNumber=$_GET['pageNumber'];
}else{
    $pageNumber=1;
}
for($i=1;$i<=$totalPage;$i++){
    $class=($pageNumber==$i)?"active":"";
    $pagination.="<li class='$class'><a href='totalMenue.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNumber-1);
$prevPage=$pageNumber-1;
$nextPage=$pageNumber+1;

$allFood=$food_item->paginator($pageStartFrom,$itemPerPage);

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
    <link rel="stylesheet" href="../../../resource/font-awesome-4.6.3/css/font-awesome.css"/>

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
<?php include("topNavigation.php"); ?>

<!-- Page Content -->
<div class="container">

    <?php include("messageBox.php"); ?>

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



        <div>
            <center><ul class="pagination">
                    <?php if($pageNumber>1){?>
                        <li><a href="totalMenue.php?pageNumber=<?php echo $prevPage?>">Prev</a></li>
                    <?php }?>
                    <?php echo $pagination?>
                    <?php if($pageNumber<$totalPage){?>
                        <li><a href="totalMenue.php?pageNumber=<?php echo $nextPage?>">Next</a></li>
                    <?php }?>
                </ul></center>
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
