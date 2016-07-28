<?php
include_once ('../../vendor/autoload.php');

use App\User\Auth;
use App\Restaurant\Restaurant;
use App\User\User;
use App\Admin\Admin;

if(!isset($_SESSION)){
    session_start();
}
$auth = new Auth();
$loggedIn = $auth->logged_in();


$newMenu = new Admin();
$singleItem = $newMenu->prepare($_REQUEST);
$productByCode = $newMenu->getTotalMenue();


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

                //var_dump($productByCode);
                $itemArray = array($productByCode['food_code']=>array('name'=>$productByCode['food_name'], 'code'=>$productByCode['food_code'],'id'=>$productByCode['id'], 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode['price']));

                if(!empty($_SESSION["cart_list"])) {
                    //var_dump($_SESSION['cart_list']);

                    if(array_key_exists($productByCode['food_code'],$_SESSION["cart_list"])) {
                        foreach($_SESSION["cart_list"] as $k => $v) {
                            if($productByCode['food_code'] == $k)
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
                $itemArray = array($productByCode['food_code']=>array('name'=>$productByCode['food_name'], 'code'=>$productByCode['food_code'],'id'=>$productByCode['id'], 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode['price']));

                if(!empty($_SESSION["cart_list"])) {
                    //var_dump($_SESSION['cart_list']);

                    if(array_key_exists($productByCode->code,$_SESSION["cart_list"])) {
                        foreach($_SESSION["cart_list"] as $k => $v) {
                            if($productByCode['food_code'] == $k)
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
include ('header.php');
?>

<!--=====================
          Content
          ======================-->
<section class="content"><div class="ic"></div>
  <div class="container">
    <div class="row">
      <div class="grid_7">
        <div class="blog" id="checkout">


            <?php
            if(isset($_SESSION["cart_list"])){
                $item_total = 0; ?>
                <h5 >Your Cart</h5>
            <div class="cart-navigation">
            <a href="menu.php" class="btn" ><< Back to Menu</a>
            <a href="#" class="btn" id="checkoutbutton">Check Out >></a>
            </div>

                <table cellpadding="10" cellspacing="1">
                    <tbody>
                    <tr>
                        <th><strong>Name</strong></th>
                        <th><strong>Code</strong></th>
                        <th><strong>Quantity</strong></th>
                        <th><strong>Unit Price</strong></th>
                        <th><strong>Sub Total</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                    <?php
                    foreach ($_SESSION["cart_list"] as $item){
                        ?>
                        <tr>
                            <form class="formCart" action="cart.php" method="post">
                            <td><strong><?php echo $item["name"]; ?></strong></td>
                            <td><?php echo $item["code"]; ?></td>
                            <td class="cart_quantity">
                                <input hidden name="code" value="<?php echo $item["code"]; ?>">
                                <?php if(!($item["quantity"]<2)) { ?>
                                <button id="quantity" name="action" type='submit' value='minus'>-</button>
                                <?php } ?>
                                <input hidden name="quantity" value="1">
                                <label><?php echo $item["quantity"]; ?></label>
                                <button id="quantity" name="action" type='submit' value='add'>+</button>
                            </td>
                            <td align=right id="price"><?php echo "৳".$item["price"]; ?>*<?php echo $item["quantity"]; ?></td>
                                <td align=right id="price"><?php echo "৳".$item["price"]*$item["quantity"]; ?></td>

                            <td><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
                            </form>
                        </tr>
                        <?php
                        $item_total += ($item["price"]*$item["quantity"]);
                    }
                    ?>

                    <tr>
                        <td colspan="5" align=right><strong>Total:</strong> <?php echo "৳".$item_total; ?></td>
                    </tr>
                    </tbody>
                </table>
                <?php
            } else {
                echo '<h5 >Your Cart is Empty</h5>';
            }
            ?>





        </div>
          <div class="blog" id="proceed" hidden>
              <?php if($loggedIn) {?>
              <div class="blog_title"><a href="#">Invoice # XXX-XXX-XXX</a></div>
                  <form id="bookingForm">
                      <strong><label for="first_name">First Name :</label></strong>
                      <input id="first_name" class="tmInput" value="<?php echo $userInfo->first_name?>" disabled>

                      <strong><label for="last_name">Last Name :</label></strong>
                      <input id="last_name" class="tmInput" value="<?php echo $userInfo->last_name?>" disabled>

                      <div class="clear f_sep1"></div>
                      <strong>Email :</strong>
                      <input class="tmInput" value="<?php echo $userInfo->email?>" disabled>



                      <div class="clear f_sep1"></div>
                      <strong class="dt">Phone :</strong>
                      <input class="tmInput" value="<?php echo $userInfo->phone?>" disabled>
                      <div class="clear f_sep1"></div>
                      <strong class="dt">Address :</strong>
                      <input class="tmInput" value="<?php echo $userInfo->address?>" disabled>
                      <div class="clear f_sep1"></div>


                      </h4>


                  </form>
              <?php } else {?>
              <div class="blog_title"><a href="#">You must Log in first. If you don't have an account sign up then log in</a></div>
                  <a href="User/Profile/signup.php" class="btn" >Login or SignUp</a>
              <?php }?>
              <?php
              if(isset($_SESSION["cart_list"])){
                  $item_total = 0;
                  ?>
                  <div class="blog_title"><a href="#">Order Details </a></div>
                  <table cellpadding="10" cellspacing="1">
                      <tbody>
                      <tr>
                          <th><strong>Name</strong></th>
                          <th><strong>Code</strong></th>
                          <th><strong>Quantity</strong></th>
                          <th><strong>Unit Price</strong></th>
                          <th><strong>Sub Total</strong></th>

                      </tr>
                      <?php
                      foreach ($_SESSION["cart_list"] as $item){
                          ?>
                          <tr>
                              <form id="formCart" action="#" method="post">
                                  <td><strong><?php echo $item["name"]; ?></strong></td>
                                  <td><?php echo $item["code"]; ?></td>
                                  <td class="cart_quantity">
                                      <label name="quantity" ><?php echo $item["quantity"]; ?></label>
                                  </td>
                                  <td align=right id="price"><?php echo "৳".$item["price"]; ?>*<?php echo $item["quantity"]; ?></td>
                                  <td align=right id="price"><?php echo "৳".$item["price"]*$item["quantity"]; ?></td>
                              </form>
                          </tr>
                          <?php
                          $item_total += ($item["price"]*$item["quantity"]);
                      }
                      ?>

                      <tr>
                          <td colspan="5" align=right><strong>Total:</strong> <?php echo "৳".$item_total; ?></td>
                      </tr>
                      </tbody>
                  </table>

              <a href="#" class="btn" id="checkoutback"><< Checkout</a>
              <?php if ($loggedIn) { ?>
              <a href="invoice.php" class="btn" id="proceedbutton">Proceed >></a>
              <?php }}?>
          </div>


        
      </div>
      <div class="grid_4 preffix_1">
        <h2>Categories</h2>
        <ul class="list">
          <li><a href="#">Herem ipsum dolor </a></li>
          <li><a href="#">sit Komet,tetur </a></li>
          <li><a href="#">Odipiscingt</a></li>
          <li><a href="#">In mollis eratttis </a></li>
          <li><a href="#">Neque Loacilisis, sit </a></li>
          <li><a href="#">Amet ultret</a></li>
          <li><a href="#">Icies erat rutrums </a></li>
        </ul>
        <h2>Recent Posts</h2>
        <div class="block3">
          <img src="../../resource/images/page4_img4.jpg" alt="" class="img_inner noresize fleft">
          <div class="extra_wrapper">
            <div class="text1 color1">
              <time datetime="2014-01-01">20-05-2014</time>
              <a href="#">Hivamus at magnate </a>
            </div>Rehoncus. Aliquam nibh tegestas id ictum ado. Praesentertoaucibus maleada faucibusnec <a href="#" class="color1">[...]</a>
          </div>
        </div>
        <div class="block3">
          <img src="../../resource/images/page4_img5.jpg" alt="" class="img_inner noresize fleft">
          <div class="extra_wrapper">
            <div class="text1 color1">
              <time datetime="2014-01-01">25-05-2014</time>
              <a href="#">Livamus aot magte </a>
            </div>Tehoncus. Aliquam nibh tegestas id ictum ado. Praesentertoaucibus maleada faucibusnece <a href="#" class="color1">[...]</a>
          </div>
        </div>
        <div class="block3">
          <img src="../../resource/images/page4_img6.jpg" alt="" class="img_inner noresize fleft">
          <div class="extra_wrapper">
            <div class="text1 color1">
              <time datetime="2014-01-01">28-05-2014</time>
              <a href="#">Kivamus aagnateme </a>
            </div>
Mehoncusiquam nibh tegestas id ictum ado. Praesentertoaucibus maleada faucibusnec dert <a href="#" class="color1">[...]</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--==============================
              footer
              =================================-->
<?php include ('footer.php');?>
<script>
    $('div#proceed').hide();
    $("a#checkoutbutton").click(function() {
        $('div#checkout').hide();
        $('div#proceed').show();
    });
    $("a#checkoutback").click(function() {
        $('div#checkout').show();
        $('div#proceed').hide();
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


