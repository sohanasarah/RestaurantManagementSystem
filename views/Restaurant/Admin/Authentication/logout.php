<?php
session_start();
include_once('../../../../vendor/autoload.php');
use App\Admin\Admin;
use App\Admin\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;


$auth= new Auth();
$status= $auth->log_out();
if($status){
    Message::message("You are successfully logged-out");
}
session_destroy();

session_start();
$_SESSION['message']="You are successfully logged out!";
return Utility::redirect('../Profile/admin-login.php');