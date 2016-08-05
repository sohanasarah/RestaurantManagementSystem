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
$auth = new Auth();
$loggedIn = $auth->logged_in();


$newMenu = new Admin();
$productByCode = $newMenu->prepare($_REQUEST);
$productByCode = $newMenu->view();


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
//                   var_dump($_SESSION['cart_list']);

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

                    if(array_key_exists($productByCode['food_code'],$_SESSION["cart_list"])) {
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
            if(isset($_SESSION["cart_list"]) && !empty($_SESSION['cart_list'])){
                $item_total = 0; ?>
                <h5 >Your Cart</h5>
            <div class="cart-navigation">
            <a href="menu.php" class="btn" ><< Back to Menu</a>
            <a href="#" class="btn" id="checkoutbutton">Check Out >></a>
            </div>

                <table cellpadding="10" cellspacing="1" class="order">
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

                            <td style="background-color: #c12f46; color: white;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
                            </form>
                        </tr>
                        <?php
                        $item_total += ($item["price"]*$item["quantity"]);
                        $_SESSION['total']=$item_total;
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
              <div class="blog_title"><a href="#">Invoice</a></div>
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
              <?php } else {
                  $_SESSION['fromCart'] = true;
                  ?>
              <div class="blog_title"><a href="#">You must Log in first. If you don't have an account sign up then log in</a></div>
                  <a href="User/Profile/signup.php" class="btn" >Login or SignUp</a>
              <?php }?>
              <?php
              if(isset($_SESSION["cart_list"])){
                  $item_total = 0;
                  ?>
                  <div class="blog_title"><a href="#">Order Details </a></div>
                  <table cellpadding="10" cellspacing="1" style="border: #edeb82 solid; " class="order">
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

                                  <td><strong><?php echo $item["name"]; ?></strong></td>
                                  <td><?php echo $item["code"]; ?></td>
                                  <td class="cart_quantity">
                                      <label name="quantity" ><?php echo $item["quantity"]; ?></label>
                                  </td>
                                  <td align=right id="price"><?php echo "৳".$item["price"]; ?></td>
                                  <td align=right id="price"><?php echo "৳".$item["price"]*$item["quantity"]; ?></td>

                          </tr>
                          <?php
                          $item_total += ($item["price"]*$item["quantity"]);
                      }
                      ?>
                      <tr>
                          <td colspan="5" align=right><strong>Flat Service Charge: </strong> <?php echo "৳".'100'; ?></td>
                      </tr>

                      <tr>
                          <td colspan="5" align=right><strong>Total:</strong> <?php echo "৳".($item_total+100); ?></td>
                      </tr>
                      </tbody>
                  </table>
                  <div class="clear f_sep1"></div><div class="clear f_sep1"></div><div class="clear f_sep1"></div><div class="clear f_sep1"></div>

                  <?php if($loggedIn) { ?>
                  <div class="blog_title"><a href="#">Payment Method</a></div>

                  <!--                  Cash Payment Message Form-->
                    <div id="cashOn" hidden>
                        <form id="bookingForm" class="cash" action="OrderSystem/orderFinal.php">
                  <table cellpadding="10" cellspacing="1" style="margin-top: 50px">
                      <tr>
                          <td><strong>Cash On Delivery</strong>
                          <input name="cashOnDelivery" value="true" hidden>
                          </td>

                      </tr>
                  </table>
                            </form>
                    </div>
                  <!--                  Cash Payment Message-->



<!--                  Card Payment Message-->
                  <div id="card" hidden>
                      <form id="bookingForm" class="card" action="OrderSystem/orderFinal.php">
                          <table cellpadding="10" cellspacing="1" style="margin-top: 50px">
                              <tr>
                                  <td><strong>Thank You for your payment. Now Click Proceed.</strong>
                                      <input name="card" value="true" hidden>
                                  </td>

                              </tr>
                          </table>
                      </form>
                  </div>
                  <!--                  Card Payment Message-->
                  <!--                  Reserve  Message-->
                  <div id="reserve" hidden>
                      <form id="bookingForm" class="reserve" action="OrderSystem/orderFinal.php">
                          <table cellpadding="10" cellspacing="1" style="margin-top: 50px">
                              <tr>
                                  <td><strong>Thank You for your payment. Now Click Proceed.</strong>
                                      <input name="reserve" value="true" hidden>
                                  </td>

                              </tr>
                          </table>
                      </form>
                  </div>
                  <!--                  Reserve  Message-->

                  <table cellpadding="10" cellspacing="1" style="margin-top: 50px" id="payment" class="order">
                      <tbody>
                      <tr>
                          <td  colspan="2" style="text-align: center" >

                              <button  class="btn" id="cash" type="submit"
                                       style="margin-left: 30px; margin-bottom: 20px;  ">Cash On Delivery
                              </button>

                          </td>
                      </tr>
                      <tr>
                          <th>Bkash  or DBBL Mobile</th>
                          <th>Card</th>
                      </tr>
                      <tr>
                          <td style="text-align: center"><strong>Please give your payment to this number first</strong>
                              <img src="../../resource/payment/payment.png ?>" alt=""
                                   height="300" width="600">

                              <button  class="btn" id="mobile" type="submit"
                                      style="margin-left: 30px; margin-bottom: 20px ">Enter Transaction ID
                              </button>
                          </td>
                          <td style="text-align: center"><strong>Please take your card on your hand<br><br></strong>
                              <img src="../../resource/payment/card.jpg ?>" alt=""
                                   height="300" width="600">

                              <button  class="btn" id="card" type="submit"
                                       style="margin-left: 30px; margin-bottom: 20px ">Go to Payment Gateway
                              </button>
                          </td>
                      </tr>


                      </tbody>




                  </table>
<!--                  Mobile Payment Form-->
                  <form id="bookingForm" class="mobileInfos" action="OrderSystem/orderFinal.php">
                  <table id="mobileInfo" hidden class="order">


                      <tbody>
                      <tr>
                          <td colspan="2">
                          <img src="../../resource/payment/payment.png ?>" alt=""
                               height="300" width="900">
                          </td>
                      </tr>
                      <tr>
                          <th><strong>Your Mobile Account Number</strong></th>
                          <th><strong>Transaction ID</strong></th>
                      </tr>
                  <tr>

                      <td align="center">
                          <input type="text" name="number" placeholder="Account Number">
                      </td>
                      <td align="center" style="margin-left: 10px">
                          <input type="text" name="tsid" placeholder="Transaction ID">
                      </td>

                  </tr>
<!--                      <tr>-->
<!--                          <td>-->
<!--                              <button id="" type="submit" >Sumbit</button>-->
<!--                          </td>-->
<!--                      </tr>-->


                  </tbody>




                  </table>


                  </form>
<!--                  Mobile Payment Form-->




<?php } ?>
                  <a type="button" href="#" class="btn" id="checkoutback"><< Checkout</a>
                  <?php if ($loggedIn) { ?>
                      <button class="btn" type="button" id="proceedbutton">Home Delivery >></button>
                      <button class="btn" type="button" id="proceedCash">Proceed >></button>
                      <button class="btn" type="button" id="proceedCard">Home Delivery >></button>

<!--                      for reservation-->

                      <button class="btn" href="OrderSystem/orderFinal.php?reservation=true" type="submit" id="proceedReserve">Reserve Table >></button>
                      
 <!--                      for reservation-->





              <?php }}?>
          </div>



      </div>
      <?php include ('sidebar.php');?>
  </div>
</section>
<!--==============================
              footer
              =================================-->
<?php include ('footer.php');?>
<script>
    $(document).ready(function () {
        $('button#proceedbutton').hide();
        $('button#proceedCash').hide();
        $('button#proceedCard').hide();
        $('button#proceedReserve').hide();
    });
    $('#proceedbutton').on('click',function () {
        document.forms[5].action= "OrderSystem/orderFinal.php";
        $('.mobileInfos').submit();

    });
    $('#proceedReserve').on('click',function () {
        document.forms[4].action= "OrderSystem/orderFinal.php";
        $('.reserve').submit();

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
        $('button#proceedReserve').show(1000);


    });
    $("button#card").click(function() {
        $('table#payment').hide(1000);
        $('div#card').show(1000);
        $('button#proceedCard').show(1000);
        $('button#proceedReserve').show(1000);
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


