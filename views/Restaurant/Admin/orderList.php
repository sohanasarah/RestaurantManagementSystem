<?php
session_start();
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;



if(!isset($_SESSION) )session_start();

use App\Admin\Auth;


$auth = new Auth();
$loggedIn = $auth->logged_in();

if(!$loggedIn) {
    return Utility::redirect('Profile/admin-login.php');
}









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
//Utility::dd($totalItem);

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
//Utility::dd($allOrder);
foreach ($allOrder as $order){
    $singleOrder[] = $order["order_id"];
    $date[] = $order["current_date"];
}
$singleOrder = array_unique($singleOrder);
$date = array_unique($date);
$combinedOrderSingle=array_combine($singleOrder,$date);
//Utility::d($combinedOrderSingle);


if(count($_POST) > 0) {
    //Utility::dd($_POST['status']);
    $status = $_POST['status'];
    $order2=new Admin();
    $allOrder=$order2->orderDelete($status);
}

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

    <?php include("messageBox.php"); ?>

    <center><h2>Order List</h2></center>


    <a href="pdf.php" class="btn btn-primary" role="button">Download Order List as PDF</a>
    <a href="xl.php" class="btn btn-primary" role="button">Download Order List as XL</a>
    <br><br>
    <form role="form">
        <div class="form-group">
            <label for="sel1">Select Orders per page:</label>
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
    <br>


    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input  type="submit" name="submit" value="Update Status" class="btn btn-warning">
        <br> <br>
    <div class="table-responsive table-hover">
        <table class="table">
            <thead>
            <tr>
                <th>Order ID</th>

                <th>Order Date</th>
<!--                <th>View/Hide</th>-->
                <th>Delivery Status</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                <?php

                foreach($combinedOrderSingle as $order_id=>$date){
                 ?>

                <td><?php echo $order_id ?></td>
                <td><?php echo $date?></td>
<!--                <td><button type="submit" id="expand" class="btn btn-success">Expand</button></td>-->
                <td align="center"><input type="checkbox" name="status[]" value="<?php echo $order_id ?>" </td>
                <td>
                <div class="table-responsive" >
                    <table class="table"  id="detail">
                        <thead>
                        <tr>

                            <th>Food Code</th>
                            <th>Food Item</th>
                            <th>Quantity</th>
                            <th>User Name</th>
                            <th>Payment System</th>
                            <th>Transaction ID</th>
                            <th>Address</th>

                        </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 0;
                            foreach($allOrder as $order){

                                if($order['order_id']==$order_id){ ?>
                            <tr>

                                    <td><?php echo $order['food_code']?></td>
                                    <td><?php echo $order['food_name']?></td>
                                    <td align="center"><?php echo $order['quantity']?></td>
                                <?php if($count == 0) {?>
                                    <td align="center"><?php echo $order['first_name']?></td>
                                    <td><?php echo $order['payment']?></td>
                                    <td><?php echo $order['transaction_id']?></td>
                                    <td><?php echo $order['address']?></td>


                                        <?php }
                                $count++?>

                            </tr>
                            <?php } }?>


                        </tbody>
                    </table>
                    </div></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

    </form>

    <div class="text-center">

        <ul class="pagination">
            <?php if($pageNumber>1) echo $previous?>
            <?php echo $pagination?>
            <?php if($pageNumber!=$totalPage) echo $next?>
        </ul>

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

<script>
    $("button#expand").click(function() {
        $('td#expansion').show();
    });
</script>
</body>
</html>
