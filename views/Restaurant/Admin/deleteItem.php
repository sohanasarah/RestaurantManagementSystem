<?php

include_once('../../../vendor/autoload.php');

use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;



if(!isset($_SESSION) )session_start();

use App\Admin\Auth;
use App\Admin\Admin;


$auth = new Auth();
$loggedIn = $auth->logged_in();

if(!$loggedIn) {
    return Utility::redirect('Profile/admin-login.php');
}





//Utility::d($_GET);
$food_item=new Admin();
$food_item->prepare($_GET);
$singleItem=$food_item->view();
//Utility::dd($singleItem);

unlink($_SERVER['DOCUMENT_ROOT'].'/RestaurantManagementSystem/resource/FoodImage/'.$singleItem['food_image']);

$singleItem=$food_item->delete();