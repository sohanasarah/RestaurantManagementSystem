<?php

include_once('../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

if(!isset($_SESSION)){
    session_start();
}
Utility::d($_SESSION['user_email']);
Utility::d($_SESSION['cart_list']);


