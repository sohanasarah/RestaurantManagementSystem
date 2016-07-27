<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;

if(!isset($_SESSION)){
    session_start();
}

$newMenu = new Restaurant();
$singleItem = $newMenu->prepare($_REQUEST);
$productByCode = $newMenu->getItem();

if(!empty($_REQUEST["action"])) {
    switch($_REQUEST["action"]) {
        case "add":
            if(!empty($_REQUEST["quantity"])) {

                //var_dump($productByCode);
                $itemArray = array($productByCode->code=>array('name'=>$productByCode->name, 'code'=>$productByCode->code,'id'=>$productByCode->id, 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode->price));

                if(!empty($_SESSION["cart_list"])) {
                    //var_dump($_SESSION['cart_list']);

                    if(array_key_exists($productByCode->code,$_SESSION["cart_list"])) {
                        foreach($_SESSION["cart_list"] as $k => $v) {
                            if($productByCode->code == $k)
                                $_SESSION["cart_list"][$k]["quantity"] += $_REQUEST["quantity"];


                        }
                    } else {
                        $_SESSION["cart_list"] = array_merge($_SESSION["cart_list"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_list"] = $itemArray;
                }

            }
            break;
        case "minus":
            if(!empty($_REQUEST["quantity"])) {

                //var_dump($productByCode);
                $itemArray = array($productByCode->code=>array('name'=>$productByCode->name, 'code'=>$productByCode->code,'id'=>$productByCode->id, 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode->price));

                if(!empty($_SESSION["cart_list"])) {
                    //var_dump($_SESSION['cart_list']);

                    if(array_key_exists($productByCode->code,$_SESSION["cart_list"])) {
                        foreach($_SESSION["cart_list"] as $k => $v) {
                            if($productByCode->code == $k)
                                $_SESSION["cart_list"][$k]["quantity"] -= $_REQUEST["quantity"];


                        }
                    } else {
                        $_SESSION["cart_list"] = array_merge($_SESSION["cart_list"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_list"] = $itemArray;
                }

            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_list"])) {
                foreach($_SESSION["cart_list"] as $k => $v) {
                    if($_REQUEST["code"] == $k)
                        unset($_SESSION["cart_list"][$k]);
                    if(empty($_SESSION["cart_list"]))
                        unset($_SESSION["cart_list"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_list"]);
            break;
    }
}

?>