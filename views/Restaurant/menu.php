<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;


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

                $itemArray = array($productByCode->code=>array('name'=>$productByCode->name, 'code'=>$productByCode->code, 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode->price));

                if(!empty($_SESSION["cart_list"])) {


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
$newMenu = new Restaurant();
$menuItems = $newMenu->getAllItems();
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
        <form action="menu.php" method="post">
      <div class="grid_4">
        <div class="gall_block">
          <div class="maxheight">
            <a href="../../resource/images/<?php echo $item->image?>" class="gall_item"><img src="../../resource/images/<?php echo $item->image?>" alt=""></a>
            <div class="gall_bot">
                <input hidden type="text" name="action" value="add">
                <input hidden type="text" name="id" value="<?php echo $item->id ?>">
                <input hidden type="number" name="quantity" value="1"  />
                <label><?php echo "৳".$item->price ?></label><button class="btn" id="addToCart" type="submit" style="margin-left: 100px">Add To Cart</button>
            <div class="text1"><a href="#"><?php echo $item->name ?></a></div>
                <?php echo $item->description ?>
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

