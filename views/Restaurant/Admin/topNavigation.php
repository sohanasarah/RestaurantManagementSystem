<?php


include_once ('../../../vendor/autoload.php');
use App\Admin\Auth;
use App\Admin\Admin;
use App\GlobalClasses\Message;

$auth = new Auth();
$loggedIn = $auth->logged_in();


$admin = new Admin();
$singleAdmin= $admin->viewAdmin();


    //grettings and logout option

?>

<link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.css">
<link rel="stylesheet" href="../../../resource/Custom/style.css">
<link rel="stylesheet" href="../../../resource/font-awesome-4.6.3/css/font-awesome.css"/>


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
                    <a href="insertMenue.php">Insert Menue</a>
                </li>
                <li>
                    <a href="orderList.php">Order List</a>
                </li>

                <li>
                    <a href="totalMenue.php">View All Item</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php if($loggedIn){ ?>

                    <li>
                    <a class=""  href="#">Welcome Admin, <?php echo $singleAdmin->first_name." ". $singleAdmin->last_name?>!</a>
                </li>

                <li>
                    <a class="btn btn-info" href='../Admin/Profile/edit.php'>Edit</a>
                </li>
                <li>
                    <a class="btn btn-info" href='../Admin/Profile/signup.php'>Add Admin</a>
                </li>
                <li>
                    <a class="btn btn-danger" href='../Admin/Authentication/logout.php'>Logout</a>
                </li>

                <li>

                </li>


                <?php }?>


            </ul>



        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>