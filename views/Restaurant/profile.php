<?php
include_once ('../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;

use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

$auth= new Auth();
$status= $auth->logged_in();

if($status== FALSE) {
    Message::message("You have to log in before enter this page");
    Utility::redirect('index.php');
}


include ('header.php');
use App\Restaurant\Restaurant;








$user= new User();
$user->prepare($_SESSION);
$singleUser=$user->view();
if($singleUser==NULL)   return Utility::redirect('../../index.php');



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
<!--=====================
          Content
          ======================-->
<section class="content"><div class="ic"></div>
    <div class="container">
        <div class="row">
            <div class="grid_7">
                <div class="blog" id="update" hidden>
                    <div class="blog_title"><a href="#">Your Info </a></div>
                    <form id="bookingForm" name="editInfo" method="post" action="User/Profile/update.php">


                        <strong class="dt">First Name</strong>
                        <label class="tmInput">
                            <input name="first_name" value="<?php echo $singleUser->first_name?>" type="text" >
                        </label>

                        <strong class="dt">First Name</strong>
                        <label class="tmInput">
                            <input name="last_name" value="<?php echo $singleUser->last_name?>" type="text" >
                        </label>



                        <div class="clear f_sep1"></div>
                        <strong class="dt">Email</strong>
                        <label class="tmInput">
                            <input name="email" value="<?php echo $singleUser->email?>" type="email" >
                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Phone</strong>
                        <label class="tmInput">
                            <input name="phone" value="<?php echo $singleUser->phone?>" type="text" >
                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Address</strong>
                        <div class="clear"></div>
                        <div class="tmInput">
                            <input type="text" name="address" value="<?php echo $singleUser->address?>" >
                        </div>

                        <div class="tmInput">


                        <input type="submit"  value="Update">

                            </div>
                    </form>


                </div>
                <div class="blog" id="plain" >
                    <div class="blog_title"><a href="#">Your Info </a></div>
                    <a href="#" class="btn" id="clickToUpdate">Update Info</a>
                    <form id="bookingForm" >

                        <strong class="dt">First Name :  <?php  echo $singleUser->first_name  ?>   </strong>
                        <label class="tmInput"> </label>

                        <div class="clear f_sep1"></div>

                        <strong class="dt">Last Name :   <?php  echo $singleUser->last_name  ?> </strong>
                        <label class="tmInput">


                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Email :   <?php  echo $singleUser->email  ?> </strong>
                        <label class="tmInput">

                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Phone :  <?php  echo $singleUser->phone  ?> </strong>
                        <label class="tmInput">

                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Address :   <?php  echo $singleUser->address  ?> </strong>
                        <label class="tmInput">

                        </label>
                        <div class="clear f_sep1"></div>
                        <strong class="dt">Your Orders :</strong>
                        <label class="tmInput">

                        </label>


                    </form>

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
</body>
<script>
    $('div#update').hide();
    $("a#clickToUpdate").click(function() {
        $('div#plain').hide();
        $('div#update').show();
    });
    
</script>
</html>

