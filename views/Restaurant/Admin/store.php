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




if(isset($_FILES['food_image']) && !empty($_FILES['food_image']['name']))
{
    $image_name=$_POST['food_name']."_".$_FILES['food_image']['name'];
    $temporary_location=$_FILES['food_image']['tmp_name'];

    move_uploaded_file($temporary_location,'../../../resource/FoodImage/'.$image_name);
    $_POST['food_image']=$image_name;
}

//Utility::dd($_POST);

$food_item=new Admin();
$food_item->prepare($_POST);
$food_item->store();