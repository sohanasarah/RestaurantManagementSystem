<?php

include_once('../../../../vendor/autoload.php');
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

use App\User\User;
use App\User\Auth;
$auth= new Auth();
$status= $auth->logged_in();

if($status== FALSE) {
    Message::message("You have to log in before enter this page");
   Utility::redirect($_SERVER['HTTP_REFERER']);
}





$user= new User();
$user->prepare($_SESSION);
$singleItem=$user->view();
if($singleItem==NULL)   return Utility::redirect('../../index.php');

?>








<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signing up as customer!</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="../../../../resource/login-signup-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../resource/login-signup-assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../../resource/login-signup-assets/css/form-elements.css">
    <link rel="stylesheet" href="../../../../resource/login-signup-assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="../../../../resource/login-signup-assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../../../resource/login-signup-assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../../../resource/login-signup-assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../../../resource/login-signup-assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../../../resource/login-signup-assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>







<!-- Top content -->
<div class="top-content">

    <div class="container">



        <div class="grid_12">
            <h1>
                <a href="index.php">
                    <img src="../../../../resource/images/logo.png" alt="Logo alt" >
                </a>
            </h1>
        </div>






        <table>
            <tr>
                <td width='230' >

                <td width='600' >


                    <?php if($_SESSION['message']!=""){ ?>

                        <div  id="message" class="form button"   style="font-size: smaller  " >
                            <center>
                                <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                                    echo "&nbsp;".Message::message();
                                }
                                Message::message(NULL);

                                ?></center>
                        </div>


                    <?php } ?>


                </td>
           </tr>
   </table>


            <div class="col-sm-1 middle-border"></div>
            <div class="col-sm-1"></div>

            <div class="col-sm-7">

                <div class="form-box">

                    <div class="form-top">
                        <div class="form-top-left">

                            <h3>Edit User Account Information</h3>
                            <a href='../../index.php'><input type='button' value='Home'></a>
                            <a href='change_password.php'><input type='button' value='Change Password'></a>

                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="update.php" method="post" class="update-form">
                            <div class="form-group">
                                <label class="btn-sm" for="form-first_name">First name</label>
                                <input type="text" name="first_name" value="<?php echo $singleItem->first_name?>" class="form-first_name form-control" id="form-first_name">
                            </div>
                            <div class="form-group">
                                <label class="btn-sm" for="form-last-name">Last name</label>
                                <input type="text" name="last_name" value="<?php echo $singleItem->last_name?>" class="form-last_name form-control" id="form-last_name">
                            </div>
                            <div class="form-group">
                                <label class="btn-sm" for="form-email">Email</label>
                                <input type="text" name="email" value="<?php echo $singleItem->email?>" class="form-email form-control" id="form-email">
                            </div>


                            <div class="form-group">
                                <label class="btn-sm" for="form-email">Phone</label>
                                <input type="text" name="phone" value="<?php echo $singleItem->phone?>" class="form-phone form-control" id="form-phone">
                            </div>
                            <div class="form-group">
                                <label class="btn-sm" for="address">Address</label>
                                <input type="text" name="address" value="<?php echo $singleItem->address?>" class="form-address form-control" id="form-address">
                            </div>
                            <button type="submit" class="btn">Update!</button>
                        </form>
                    </div>
                </div>

            </div>


    </div>
</div>



<!-- Javascript -->
<script src="../../../../resource/login-signup-assets/js/jquery-1.11.1.min.js"></script>
<script src="../../../../resource/login-signup-assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../../../resource/login-signup-assets/js/jquery.backstretch.min.js"></script>
<script src="../../../../resource/login-signup-assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="../../../../resource/login-signup-assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>


<?php include ('../../footer.php'); ?>
