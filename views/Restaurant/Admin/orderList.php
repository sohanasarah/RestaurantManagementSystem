<?php
session_start();
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//Utility::dd($_GET);

$order=new Admin();

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
$totalItem=$order->orderCount();

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
    $pagination.="<li class='$class'><a href='orderList.php?pageNumber=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNumber-1);
$prev=$pageNumber-1;
$next=$pageNumber+1;
$previous="<li><a href='orderList.php?pageNumber=$prev'>Prev</a></li>";
$next="<li><a href='orderList.php?pageNumber=$next'>Next</a></li>";

$allOrder=$order->orderPaginator($pageStartFrom,$itemPerPage);



?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Order List</title>
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

<div class="container">
    <h2 align="center">Order List</h2>
    <form role="form">
        <div class="form-group">
            <label for="sel1">Select items per page:</label>
            <select class="form-control" id="sel1" name="itemPerPage">
                <option <?php if($itemPerPage==5){?> selected="selected" <?php } ?> >5</option>
                <option <?php if($itemPerPage==10){?> selected="selected" <?php } ?>>10</option>
                <option <?php if($itemPerPage==15){?> selected="selected" <?php } ?>>15</option>
                <option <?php if($itemPerPage==20){?> selected="selected" <?php } ?>>20</option>
                <option <?php if($itemPerPage==25){?> selected="selected" <?php } ?>>25</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Go</button>

        </div>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Order ID</th>
                <th>Food Code</th>
                <th>Food Item</th>
                <th>Quantity</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Delivery Status</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $sl=0;
                foreach($allOrder as $order){
                $sl++; ?>
                <td><?php echo $sl+$pageStartFrom?></td>
                <td><?php echo $order['id'] ?></td>
                <td><?php echo $order['order_id']?></td>
                <td><?php echo $order['food_code']?></td>
                <td><?php echo $order['food_name']?></td>
                <td><?php echo $order['quantity']?></td>
                <td><?php echo $order['user_id']?></td>
                <td><?php echo $order['current_date']?></td>
                <td><input type="checkbox"  name="status" id="status" value="checked"></td>

            </tr>
            <?php }?>


            </tbody>
        </table>
    </div>

    <div class="text-center">

        <ul class="pagination">
            <?php if($pageNumber>1) echo $previous?>
            <?php echo $pagination?>
            <?php if($pageNumber!=$totalPage) echo $next?>
        </ul>

    </div>


</div>


</body>
</html>
