<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Admin\Admin;


if(!isset($_SESSION)){
    session_start();
}


//Utility::dd($_SESSION);
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
$newMenu = new Admin();
$menuItems = $newMenu->getMenueByCategory('DESSERTS or DRINKS');
include ('header.php');

?>

<!--=====================
          Content
======================-->
<section class="content gallery pad1"><div class="ic"></div>
    <div class="container">
        <div class="row">
            <?php
            $sl = 0;
            foreach ($menuItems as $item){
                $sl++;

                ?>
                <form action="menu_desserts_drinks.php" method="post">
                    <div class="grid_4">
                        <div class="gall_block">
                            <div class="maxheight">
                                <a href="../../resource/FoodImage/<?php echo $item['food_image']?>" class="gall_item"><img src="../../resource/FoodImage/<?php echo $item['food_image']?>" alt="" height="300" width="150"></a>
                                <div class="gall_bot">
                                    <input hidden type="text" name="action" value="add">
                                    <input hidden type="text" name="id" value="<?php echo $item['id'] ?>">
                                    <input hidden type="number" name="quantity" value="1"  />
                                    <label><?php echo "৳".$item['price'] ?></label><button class="btn" id="addToCart" type="submit" style="margin-left: 120px; margin-bottom: 20px ">Add To Cart</button>
                                    <div class="text1"><a href="#"><?php echo $item['food_name'] ?></a></div>
                                    <?php echo $item['category'] ?>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if(($sl%3) == 0){
                    echo '<div class="clear sep__1"></div>';
                }

            }?>
        </div>
    </div>
</section>
<!--==============================
              footer
=================================-->
<?php include ('footer.php');?>
<script>
    $("button#addToCart").click(function(){
        $.ajax({
            type: "POST",
            url: "updateCart.php",
            data: $('form.formCart').serialize(),
            success: function(){
                $('#refreshCart').load(document.URL + ' #refreshCart');
            }
        });

    });
</script>

