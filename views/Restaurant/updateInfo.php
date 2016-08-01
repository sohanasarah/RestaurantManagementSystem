<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Admin\Admin;


if(!isset($_SESSION)){
    session_start();
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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

if(isset($_REQUEST['category']) && !empty($_REQUEST['category'])){
    $newMenu = new Admin();
    $menuItems = $newMenu->getMenueByCategory($_REQUEST["category"]);
}

include ('header.php');

?>
<style>
    #wrapper .text {
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


<?php if(isset($menuItems) && !empty($menuItems)) { ?>
    <section class="content gallery pad1" >
        <div class="ic"></div>
        <div class="container">
            <div class="row" id="menuItemRow"
            <?php
            $sl = 0;

            foreach ($menuItems as $item) {
                $sl++;

                ?>
                <form action="<?php echo  $actual_link ?>" method="post">
                    <div class="grid_4" id="menuItems" hidden>
                        <div class="gall_block">
                            <div class="maxheight">
                                <a href="../../resource/FoodImage/<?php echo $item['food_image'] ?>"
                                   class="gall_item"><img
                                        src="../../resource/FoodImage/<?php echo $item['food_image'] ?>" alt=""
                                        height="300" width="150"></a>
                                <div class="gall_bot">
                                    <input hidden type="text" name="action" value="add">
                                    <input hidden type="text" name="id" value="<?php echo $item['id'] ?>">
                                    <input hidden type="number" name="quantity" value="1"/>
                                    <input hidden type="text" name="category"
                                           value="<?php echo $item['category'] ?>"/>
                                    <label><?php echo "৳" . $item['price'] ?></label>
                                    <button class="btn" id="addToCart" type="submit"
                                            style="margin-left: 120px; margin-bottom: 20px ">Add To Cart
                                    </button>
                                    <div class="text1"><a href="#"><?php echo $item['food_name'] ?></a></div>
                                    <?php echo $item['category'] ?>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (($sl % 3) == 0) {
                    echo '<div class="clear sep__1"></div>';
                }


            }?>
        </div>

    </section>
<?php } ?>




<section class="content gallery pad1" >
    <div class="ic"></div>
    <div class="container" >
        <div class="row" id="allmenu">
            <div id="wrapper">
                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">
                            <a class="thumbnail" href="menu.php?category=Appetizer" type="submit" id="menu1">
                                <img class="img-responsive img-thumbnail" src="../../resource/FoodImage/appetizer.jpg" alt="" height="220">
                                <center><h3 id="color">Appetizer</h3></center>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">
                            <a class="thumbnail" href="menu.php?category=Main Course" id="menu">
                                <img class="img-responsive img-thumbnail" src="../../resource/FoodImage/main_course%20(2).jpg" alt="" height="220">
                                <center><h3 id="color">Main Course</h3></center>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">
                            <a class="thumbnail" href="menu.php?category=DESSERTS or DRINKS" id="menu">
                                <img class="img-responsive img-thumbnail" src="../../resource/FoodImage/dessertDrink.jpg" alt="" height="220">
                                <center><h3 id="color">Drinks & Desserts</h3></center>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php  ?>

<script>

    function parseURLParams(url) {
        var queryStart = url.indexOf("?") + 1,
            queryEnd   = url.indexOf("#") + 1 || url.length + 1,
            query = url.slice(queryStart, queryEnd - 1),
            pairs = query.replace(/\+/g, " ").split("&"),
            parms = {}, i, n, v, nv;

        if (query === url || query === "") {
            return;
        }

        for (i = 0; i < pairs.length; i++) {
            nv = pairs[i].split("=");
            n = decodeURIComponent(nv[0]);
            v = decodeURIComponent(nv[1]);

            if (!parms.hasOwnProperty(n)) {
                parms[n] = [];
            }

            parms[n].push(nv.length === 2 ? v : null);
        }
        return parms;
    }
    var urlString = window.location.search;
    var urlParams = parseURLParams(urlString);

    var key = Object.keys(urlParams)[0];
    var value = urlParams.category;



    if(value){
        $('div#allmenu').hide();

        $(document).ready(function(){

            $('div#menuItems').show();




        });
    }
    else {
        $(document).ready(function(){


            $("a#menu1").click(function() {
                $('div#allmenu').hide();

            });
        });

    }




</script>


<?php include ('footer.php');?>
