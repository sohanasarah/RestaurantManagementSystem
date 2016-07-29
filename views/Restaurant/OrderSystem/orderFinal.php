<?php

include_once('../../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Admin\Admin;
use App\OrderSystem\OrderSystem;

if(!isset($_SESSION)){
    session_start();
}

$order=new OrderSystem();

$id=$order->prepare($_SESSION)->getUserID();

$_SESSION['user_id']=$id['id'];



$orderedItem=count($_SESSION['cart_list']);
//Utility::d($_SESSION['cart_list']);
$itemCodeArray=array_keys($_SESSION['cart_list']);

$_SESSION['food_code']=implode(',',$itemCodeArray);


    $OrderList=$order->prepare($_SESSION)->storeOrder();

//
//for($i=1;$i<=$orderedItem;$i++)
//{
//    $_POST[$i]=$_SESSION['cart_list'][$i];
//}
//
//Utility::dd($_POST);
//for($i=1;$i<=$orderedItem;$i++)
//{
//    $order->prepare($_POST[$i]);
//    $OrderList=$order->storeOrder();
//}
