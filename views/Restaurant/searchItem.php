<?php
include_once ('../../vendor/autoload.php');

use App\User\Auth;
use App\Restaurant\Restaurant;
use App\User\User;
use App\Admin\Admin;
use App\GlobalClasses\Utility;
use App\GlobalClasses\Message;

if(!isset($_SESSION)){
    session_start();
}
//Utility::dd($_GET);
$auth = new Auth();
$loggedIn = $auth->logged_in();


$newMenu = new Admin();
$menuItems = $newMenu->prepare($_GET);
$menuItems = $newMenu->getMenuBySearch();

$singleItem = $newMenu->prepare($_REQUEST);
$productByCode = $newMenu->view();

//Utility::dd($foodItemBySearch);


if($loggedIn){

    $user= new User();
    $user->prepare($_SESSION);
    $userInfo=$user->view();
    if($userInfo==NULL)   return Utility::redirect('../../index.php');

}




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

if(isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
    $newMenu = new Admin();
    $menuItems = $newMenu->getMenueByCategory($_REQUEST["category"]);
}

include ('header.php');

?>
<style>
    #wrapper .text {
        position: absolute;
        bottom:30px;
        left:0px;
        visibility:hidden;
    }
    #color
    {
        color: gray;
        font-family: "Baskerville Old Face", Times, serif;
    }
</style>

<!--=====================
          Content
          ======================-->
<?php if(isset($menuItems) && !empty($menuItems)) { ?>
    <section class="content gallery pad1" >
        <div class="ic"></div>
        <div class="container">
            <div class="row" style="margin-left: 350px; margin-bottom: 50px;">
                <div class="btn-group">
                    <a href="menu.php?category=Appetizer" class="btn <?php if($_REQUEST['category'] == 'Appetizer')  echo 'current';?>" >
                        Appetizer
                    </a>
                    <a href="menu.php?category=Main%20Course" class="btn <?php if($_REQUEST['category'] == 'Main Course')  echo 'current';?>" >
                        Main Course
                    </a>
                    <a href="menu.php?category=DESSERTS%20or%20DRINKS" class="btn <?php if($_REQUEST['category'] == 'DESSERTS or DRINKS')  echo 'current';?>" >
                        Desserts & Drinks
                    </a>

                </div>
            </div>
            <div class="row" id="menuItemRow">
                <?php
                $sl = 0;

                foreach ($menuItems as $item) {
                    $sl++;

                    ?>

                    <div class="grid_4" id="menuItems" >
                        <div class="gall_block">
                            <div class="maxheight">
                                <a href="../../resource/FoodImage/<?php echo $item['food_image'] ?>"
                                   class="gall_item"><img
                                        src="../../resource/FoodImage/<?php echo $item['food_image'] ?>" alt=""
                                        height="300" width="150"></a>
                                <div class="gall_bot">
                                    <form action="<?php echo  $actual_link ?>" method="post">
                                        <input hidden type="text" name="action" value="add">
                                        <input hidden type="text" name="id" value="<?php echo $item['id'] ?>">
                                        <input hidden type="number" name="quantity" value="1"/>
                                        <input hidden type="text" name="category"
                                               value="<?php echo $item['category'] ?>"/>
                                        <label><?php echo "৳" . $item['price'] ?></label>
                                        <button class="btn" id="addToCart" type="submit"
                                                style="margin-left: 120px; margin-bottom: 20px ">Add To Cart
                                        </button>
                                    </form>
                                    <div class="text1"><a href="#"><?php echo $item['food_name'] ?></a></div>
                                    <?php echo $item['category'] ?>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (($sl % 3) == 0) {
                        echo '<div class="clear sep__1"></div>';
                    }


                }?>
            </div>
        </div>

    </section>
<?php } ?>
<!--==============================
              footer
              =================================-->
<?php include ('footer.php');?>
<script>
    $(document).ready(function () {
        $('button#proceedbutton').hide();
        $('button#proceedCash').hide();
        $('button#proceedCard').hide();
    });
    $('#proceedbutton').on('click',function () {
        document.forms[4].action= "OrderSystem/orderFinal.php";
        $('.mobileInfos').submit();

    });
    $('#proceedCash').on('click',function () {
        document.forms[2].action= "OrderSystem/orderFinal.php";
        $('.cash').submit();
    });
    $('#proceedCard').on('click',function () {
        document.forms[3].action= "OrderSystem/orderFinal.php";
        $('.card').submit();
    });

    $("button#cash").click(function() {
        $('table#payment').hide(1000);
        $('div#cashOn').show(1000);
        $('button#proceedCash').show(1000);



    });

    $("button#mobile").click(function() {
        $('table#payment').hide();
        $('table#mobileInfo').show(1000);
        $('button#proceedbutton').show(1000);


    });
    $("button#card").click(function() {
        $('table#payment').hide(1000);
        $('div#card').show(1000);
        $('button#proceedCard').show(1000);
    });



    $("a#checkoutback").click(function() {
        $('div#proceed').hide(1000);
        $('div#checkout').show(2000);
    });
    $("a#checkoutbutton").click(function() {
        $('div#checkout').hide(1000);
        $('div#proceed').delay(1000).slideDown(1000);
    });

    $(document).ready(function () {
        $("button#quantity").click(function(){
            $.ajax({
                type: "POST",
                url: "updateCart.php",
                data: $('form.formCart').serialize()
            });

        });
    });

</script>


