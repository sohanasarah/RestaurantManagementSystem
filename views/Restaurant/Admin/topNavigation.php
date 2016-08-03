<?php


include_once ('../../../vendor/autoload.php');
use App\Admin\Auth;
use App\Admin\Admin;
use App\GlobalClasses\Message;

$auth = new Auth();
$loggedIn = $auth->logged_in();


$admin = new Admin();
$singleAdmin= $admin->viewAdmin();

$total = $admin->orderCount();


    //grettings and logout option

?>

<link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.css">
<link rel="stylesheet" href="../../../resource/Custom/style.css">
<link rel="stylesheet" href="../../../resource/font-awesome-4.6.3/css/font-awesome.css"/>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
    li a, .dropbtn {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover, .dropdown:hover .dropbtn {
        background-color: red;
    }

    li.dropdown {
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .show {display:block;}

    #notification
    {
        background-color: red;
        color: white;
    }
</style>
<meta http-equiv="refresh" content="300" >

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
                    <a  href="../index.php">View Website</a>
                </li>
                <li>
                    <a href="insertMenu.php">Insert Menu</a>
                </li>
                <li>
                    <a href="orderList.php" type="button">Order List<span class="badge" id="notification"><?php echo $total?></span> </a>
                </li>
                <li>
                    <a href="totalMenu.php">View All Item</a>
                </li>

                <li>
                    <a href="reservedTables.php?reservationDate=<?php echo date("Y-m-d");?>">Reserved Tables</a>
                </li>



            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php if($loggedIn){ ?>

                    <li>
                    <a class=""  href="#">Welcome <?php echo $singleAdmin->first_name." ". $singleAdmin->last_name?>!</a>
                </li>


                    <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn" onclick="myFunction()"><i class="fa fa-cog" style="font-size:24px"></i></a>
                    <div class="dropdown-content" id="myDropdown">
                        <a href='../Admin/Profile/edit.php'>Edit</a>
                        <a href='../Admin/Profile/signup.php'>Add Admin</a>
                        <a href='../Admin/Authentication/logout.php'>Logout</a>
                    </div>
          </li>




                <?php }?>


            </ul>



        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<script>
    /* When the user clicks on the button,
     toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(e) {
        if (!e.target.matches('.dropbtn')) {

            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var d = 0; d < dropdowns.length; d++) {
                var openDropdown = dropdowns[d];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>