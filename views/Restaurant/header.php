<?php
include_once ('../../vendor/autoload.php');
use App\User\Auth;
use App\User\User;
use App\GlobalClasses\Message;

$auth = new Auth();
$loggedIn = $auth->logged_in();

if($loggedIn){
$user = new User();
$singleUser= $user->view();

}

if(!isset($_SESSION)){
    session_start();
}
// To make active current nav bar link
function getActiveCurrent($data = ""){

    $end = basename($_SERVER['SCRIPT_FILENAME']);
    if($end  == $data  ) {
        echo "current";
    }
}
// To make active current nav bar link

//Get total items in cart start
$total = 0;
if(isset($_SESSION["cart_list"])){
    foreach($_SESSION["cart_list"] as $k => $v) {
        $total = $total+ $_SESSION["cart_list"][$k]["quantity"];
    }
}

//Get total items end


?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="../../resource/images/favicon.ico">
    <link rel="shortcut icon" href="../../resource/images/favicon.ico" />
    <link rel="stylesheet" href="../../resource/css/form.css">
    <link rel="stylesheet" href="../../resource/css/stuck.css">
    <link rel="stylesheet" href="../../resource/css/style.css">
    <link rel="stylesheet" href="booking/css/booking.css">
    <script src="../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../resource/js/jquery.js"></script>
    <script src="../../resource/js/jquery-migrate-1.1.1.js"></script>
    <script src="../../resource/js/script.js"></script>
    <script src="../../resource/js/superfish.js"></script>
    <script src="../../resource/js/jquery.equalheights.js"></script>
    <script src="../../resource/js/jquery.mobilemenu.js"></script>
    <script src="../../resource/js/jquery.easing.1.3.js"></script>
    <script src="../../resource/js/tmStickUp.js"></script>
    <script src="../../resource/js/jquery.ui.totop.js"></script>
    <script src="../../resource/js/TMForm.js"></script>
    <script src="../../resource/js/modal.js"></script>
    <script src="../../resource/js/touchTouch.jquery.js"></script>
    
    <link rel="stylesheet" href="../../resource/Custom/style.css">
    <script src="booking/js/booking.js"></script>


    <script>
        $(document).ready(function(){

            $().UItoTop({ easingType: 'easeOutQuart' });
            $('#stuck_container').tmStickUp({});

        });
    </script>
    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
    <script src="../../resource/js/html5shiv.js"></script>
    <link rel="stylesheet" media="screen" href="../../resource/css/ie.css">


    <![endif]-->
</head>

<body>
<!--==============================
              header
              =================================-->
<header>
    <!--==============================
                Stuck menu
    =================================-->
    <section id="stuck_container">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <h1>
                        <a href="index.php">
                            <img src="../../resource/images/logo.png" alt="Logo alt" >
                        </a>
                    </h1>




<table>
    <tr>


         <td width='500' height="25">


                                <?php  if(isset($_SESSION['message']) )  if($_SESSION['message']!=""){ ?>

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

<?php


         if($loggedIn)  {
               //grettings and logout option

 ?>


             <td height="">Welcome <?php echo $singleUser->first_name." ". $singleUser->last_name?>!</td><td width='50'><a href='User/Authentication/logout.php'><input type='button' value='Logout'></a></td><td width='50'><a href='User/Profile/edit.php'><input type='button' value='Edit Profile'></a></td></tr></table>


<?php
         }
         else {

?>


                <!-- LOGIN FORM  START  -->
                    <form action="User/Authentication/login.php" method="post">

                   <table cellspacing="0" role="presentation">   <tbody>     <tr>








                                <td width="100"></td>  <td width="100"></td><td width="100"></td><td width="100"></td>
                                <td width="100">
                                    <label for="email">Email</label>
                                </td>
                                <td >
                                    <label for="pass">Password</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="100"></td><td width="100"></td><td width="100"></td><td width="100"></td>

                                <td width="">
                                    <input type="email" class="inputtext" name="email" id="email" value="" tabindex="1">
                                </td>
                                <td>
                                    <input type="password" class="inputtext" name="password" id="password" tabindex="2"></td>
                                <td>
                                        <input value="Log In" tabindex="4" type="submit" id="u_0_m">
                                </td>
                                <td width="50"> </td>
                                <td >
                                    <a href='User/Profile/signup.php'><input type='button' value='Signup'></a>

                                </td>
                            </tr>

                            <tr>
                                <td width="100"></td><td width="100"></td><td width="100"></td><td width="100"></td>


                                <td class="login_form_label_field">
                                    <a href="forgotten.php">Forgotten account?</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>

                    <!--   Login Form End  -->
<?php } ?>



                    <div class="navigation ">
                        <nav>
                            <ul class="sf-menu">
                                <li class= "<?php getActiveCurrent("index.php") ?>"><a href="index.php">home</a></li>
                                <li class="<?php getActiveCurrent("menu.php") ?>"><a href="menu.php">menu</a></li>
                                <li class="<?php getActiveCurrent("reservation.php") ?>"><a href="reservation.php">reservation</a></li>
                                <li class="<?php getActiveCurrent("blog.php") ?>"><a href="blog.php">blog</a></li>
                                <li class="<?php getActiveCurrent("contact.php") ?>"><a href="contact.php">contacts</a></li>

                                <li id="refreshCart" class="<?php getActiveCurrent("cart.php") ?>"><a href="cart.php" type="button" class="badge1" data-badge=" <?php echo $total?>">Cart</a></li>
                                <?php if($loggedIn) {?>
                                <li class="<?php getActiveCurrent("profile.php") ?>"><a href="profile.php">Profile</a></li>
                                <?php } else { ?>
                                <li class="<?php getActiveCurrent("Profile/signup.php") ?>"><a href="User/Profile/signup.php">Login/Signup</a></li>
                                <?php } ?>

                            </ul>
                        </nav>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
