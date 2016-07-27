<?php
include_once('../../../../vendor/autoload.php');
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

//print_r($_REQUEST); die();

use App\User\User;
use App\User\Auth;
$auth= new Auth();
$status= $auth->logged_in();

if($status== FALSE) {
    Message::message("You have to log in before enter this page");
    return Utility::redirect('../../index.php');
}




$user= new User();
$user->prepare($_REQUEST);
$user->update();
