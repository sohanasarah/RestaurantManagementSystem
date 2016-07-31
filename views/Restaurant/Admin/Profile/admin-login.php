<?php
include_once('../../../../vendor/autoload.php');

if(!isset($_SESSION) )session_start();
use App\GlobalClasses\Message;

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login as an Admin!</title>

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

        <div class="container" >





            <table>
                <tr>
                    <td width='230' >

                    <td width='600' height="50" >


                        <?php  if(isset($_SESSION['message']) )if($_SESSION['message']!=""){ ?>

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









            <div class="row" >
                <div class="col-sm-13">

                    <div class="grid_12">
                        <h1>
                            <a href="index.php">
                                <img src="../../../../resource/images/logo.png" alt="Logo alt" >
                            </a>
                        </h1>
                    </div>
                    <div class="form-box" style="margin-top: 0%">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login as an Admin</h3>
                                <p>Enter email and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="../Authentication/login.php" method="post" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                </div>
                                <button type="submit" class="btn">Sign in!</button>
                            </form>
                        </div>
                    </div>

                    <div class="social-login">
                        <h3>...or login with:</h3>
                        <div class="social-login-buttons">
                            <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                <i class="fa fa-facebook"></i> Facebook
                            </a>
                            <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>
                            <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                <i class="fa fa-google-plus"></i> Google Plus
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-sm-1 middle-border"></div>
                <div class="col-sm-1"></div>

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

<?php  include('../../footer.php')?>