<?php

include_once('../../../vendor/autoload.php');

use App\Admin\Admin;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//Utility::d($_GET);
$food_item=new Admin();
$food_item->prepare($_GET);
$singleItem=$food_item->view();
//Utility::dd($singleItem);

unlink($_SERVER['DOCUMENT_ROOT'].'/RestaurantManagementSystem/resource/FoodImage/'.$singleItem['food_image']);

$singleItem=$food_item->delete();