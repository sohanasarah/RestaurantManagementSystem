<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Admin\Admin;


if(!isset($_SESSION)){
    session_start();
}

$newMenu = new Admin();
$singleItem = $newMenu->prepare($_REQUEST);
$productByCode = $newMenu->view();


if(!empty($_REQUEST["action"])) {
    switch($_REQUEST["action"]) {
        case "add":
            if(!empty($_REQUEST["quantity"])) {

                $itemArray = array($productByCode["food_code"]=>array('name'=>$productByCode["food_name"], 'code'=>$productByCode["food_code"], 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode["price"]));

                if(!empty($_SESSION["cart_list"])) {


                    if(array_key_exists($productByCode["food_code"],$_SESSION["cart_list"])) {
                        foreach($_SESSION["cart_list"] as $k => $v) {
                            if($productByCode["food_code"] == $k)
                                $_SESSION["cart_list"][$k]["quantity"] += $_REQUEST["quantity"];


                        }

                    } else {
                        $_SESSION["cart_list"] = $_SESSION["cart_list"]+$itemArray;

                    }
                } else {
                    $_SESSION["cart_list"] = $itemArray;
                }



                Message::message("<div class=\"alert success\">
                  <span class=\"closebtn\"></span>
                  <strong>Success!</strong> Item added to cart.
                                </div>");

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