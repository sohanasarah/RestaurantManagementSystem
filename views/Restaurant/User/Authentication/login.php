<?php
session_start();
include_once('../../../../vendor/autoload.php');
use App\User\User;
use App\User\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;





$auth= new Auth();
$status= $auth->prepare($_POST)->is_registered();
if($status){
    $_SESSION['user_email']=$_POST['email'];
    Message::message("Login Successfull!");

    return Utility::redirect('../../index.php');

}else{
    Message::message("Wrong username or password");
    return Utility::redirect($_SERVER['HTTP_REFERER']);

}


