<?php

include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//Utility::d($_POST);
//Utility::d($_FILES);
$food_item=new Admin();
$food_item->prepare($_POST);
$singleItem=$food_item->view();

if(isset($_FILES['food_image']) && !empty($_FILES['food_image']['name']))
{
    $image_name=$_POST['food_name']."_".$_FILES['food_image']['name'];
    $temporary_location=$_FILES['food_image']['tmp_name'];

    unlink($_SERVER['DOCUMENT_ROOT'].'/RestaurantManagementSystem/resource/FoodImage/'.$singleItem['food_image']);
    move_uploaded_file($temporary_location,'../../../resource/FoodImage/'.$image_name);
    $_POST['food_image']=$image_name;
}

//Utility::dd($_POST);
$food_item->prepare($_POST);
$food_item->update();