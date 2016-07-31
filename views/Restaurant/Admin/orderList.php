<?php
include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//Utility::dd($_GET);



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
//Utility::d($allOrder);

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
            color: black;
            font-family:bold,"Baskerville Old Face", Times, serif;
            font-size: medium;
        }
    </style>
</head>
<body>


<?php include("topNavigation.php"); ?>

<div class="container">

    <?php include("messageBox.php"); ?>


    <h2 align="center">Order List</h2>
    
    
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
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Serial No</th>
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
                <td><?php echo $order['order_id']?></td>
                <td><?php echo $order['food_code']?></td>
                <td><?php echo $order['food_name']?></td>
                <td><?php echo $order['quantity']?></td>
                <td><?php echo $order['user_id']?></td>
                <td><?php echo $order['current_date']?></td>
                <td align="center"><input type="checkbox" name="status[]" value="<?php echo $order['id'] ?>" </td>

            </tr>
            <?php }?>


            </tbody>
        </table>
    </div>
        <center><input  type="submit" name="submit" value="Update Status" class="btn btn-primary"></center>
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


</body>
</html>
