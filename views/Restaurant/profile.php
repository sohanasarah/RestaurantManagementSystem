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



$user = new Restaurant();
$userOrders = $user->userOrders($_SESSION['user_email']);

foreach ($userOrders as $orders){
    $invoices[] = $orders["invoice_id"];
    $dates[]  = $orders["current_date"];


}
$invoices = array_unique($invoices);
$dates = array_unique($dates);
//var_dump($invoices);
//var_dump($dates);
$invoiceInfo = array_combine($invoices,$dates);
//var_dump($invoiceInfo);





$user= new User();
$user->prepare($_SESSION);
$singleUser=$user->view();
if($singleUser==NULL)   return Utility::redirect('../../index.php');

$sl = 1;
$item_total = 0;
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
                        <label class="tmInput">

                        </label>


                    </form>
                    <div class="blog_title"><a href="#">Your Orders </a></div>
                    <?php foreach ($invoiceInfo as $invoice => $date ){

                        echo "<div class=\"blog_title\">SL: ".$sl++."</div>";

                    ?>
                    <table cellpadding="10" cellspacing="1">
                        <tbody>
                        <tr>
                            <th colspan="2" align=center ><strong>Invoice Id: <?php echo $invoice; ?> </strong></th>
                            <th colspan="2" align=center ><strong>Date: <?php
                                    $date = explode(" ",$date);

                                    echo $date[0]; ?> </strong></th>
                            <th colspan="2" align=center ><strong>Time: <?php echo $date[1]; ?> </strong></th>
                        </tr>
                        <tr>
                            <th colspan="2"><strong>Food Name</strong></th>
                            <th><strong>Quantity</strong></th>
                            <th align=center><strong>Unit Price</strong></th>
                            <th align=center><strong>Subtotal</strong></th>

                        </tr>
                        <?php
                        foreach ($userOrders as $item ){

                            if($item['invoice_id'] == $invoice){

                            ?>

                            <tr>

                                    <td colspan="2"><?php echo $item["food_name"]; ?></td>
                                    <td align=center id="price">
                                        <label name="quantity" ><?php echo $item["quantity"]; ?></label>
                                    </td>
                                    <td align=center id="price"><?php echo "৳".$item["price"]; ?></td>
                                    <td align=center id="price"><?php echo "৳".$item["price"]*$item["quantity"]; ?></td>
                            </tr>
                            <?php

                            $item_total += ($item["price"]*$item["quantity"]);
                        }
                        ?>


                        <?php } ?>
                        <tr>
                            <td colspan="6" align=right><strong>Total:</strong> <?php echo "৳".$item_total;
                                $item_total = 0;?></td>
                        </tr>
                        </tbody>
                    </table>
                        <div class="clear f_sep1"></div>
                        <div class="clear f_sep1"></div>
                        <div class="clear f_sep1"></div>
                        <div class="clear f_sep1"></div>
                        <div class="clear f_sep1"></div>


                    <?php } ?>


                </div>


            </div>
        <?php include ('sidebar.php'); ?>
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

