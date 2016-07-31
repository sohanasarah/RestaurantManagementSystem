<?php
session_start();
include_once('../../../../vendor/autoload.php');
use App\Admin\Admin;
use App\Admin\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;





$auth= new Auth();
$status= $auth->prepare($_POST)->is_registered();
if($status){
    $_SESSION['admin_email']=$_POST['email'];
    Message::message("Welcome Admin!");

    return Utility::redirect('../index.php');

}else{
    Message::message("Wrong username or password");
    return Utility::redirect('../Profile/admin-login.php');

}


