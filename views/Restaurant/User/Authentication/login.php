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
    if(isset($_SESSION['fromCart']) && $_SESSION['fromCart']== true ){
        unset($_SESSION['fromCart']);
        return Utility::redirect('../../cart.php');

    }
    else{
        return Utility::redirect('../../index.php');
    }


}else{
    Message::message("Wrong username or password");
    return Utility::redirect('../Profile/signup.php');

}


