<?php
include_once ('../../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

$auth= new Auth();
$status= $auth->logged_in();

if($status== FALSE) {
    Message::message("You have to log in before enter this page");
    Utility::redirect('index.php');
}

$email = $_SESSION['user_email'];
$name = "";

$user = new Restaurant();
$userOrders = $user->userOrders($_SESSION['user_email']);
$invoices=array();
$dates= array();
foreach ($userOrders as $orders){
    $invoices[] = $orders["invoice_id"];
    $dates[]  = $orders["current_date"];


}
$invoices = array_unique($invoices);
$dates = array_unique($dates);

$invoiceInfo = array_combine($invoices,$dates);

$user= new User();
$user->prepare($_SESSION);
$singleUser=$user->view();
if($singleUser==NULL)   return Utility::redirect('../../index.php');

$sl = 1;
$item_total = 0;
$tableDynamicData = "";

foreach ($invoiceInfo as $invoice => $date ):
    if(!($sl == 1) ) break;

    $date = explode(" ",$date);
    $tableDynamicData .="<div class=\"blog_title\">SL: ".$sl++."</div>";

    $tableDynamicData .="<table cellpadding=\"10\" cellspacing=\"1\" class=\"order\">
    <tbody>
    <tr>
        <th colspan=\"2\" align=center ><strong>Invoice Id: ".$invoice."</strong></th>
        <th colspan=\"2\" align=center ><strong>";

    $tableDynamicData .=$date[0]."</strong></th>
        <th colspan=\"2\" align=center ><strong>Time:".$date[1]."</strong></th>
    </tr>
    <tr>
        <th colspan=\"2\"><strong>Food Name</strong></th>
        <th><strong>Quantity</strong></th>
        <th align=center><strong>Unit Price</strong></th>
        <th align=center><strong>Subtotal</strong></th>

    </tr>";
    
    foreach ($userOrders as $item ):
        if($item['invoice_id'] == $invoice):

                $tableDynamicData .="<tr>

                <td colspan=\"2\">".$item["food_name"]."</td>
                <td align=center id=\"price\">
                    <label >".$item["quantity"]."</label>
                </td>
                <td align=center>৳".$item["price"]."</td>
                <td align=center >৳".$item["price"]*$item["quantity"]."</td>
            </tr>";
            

            $item_total += $item['price'] * $item['quantity'];
        endif;
     endforeach;
    $item_total = $item_total + 100;
    $tableDynamicData .= "<tr>
                          <td colspan=\"5\" align=right><strong>Flat Service Charge: </strong>৳100</td>
                      </tr>";


     $tableDynamicData .= "<tr><td colspan=\"6\" align=right><strong>Total:</strong>৳".$item_total."</td></tr></tbody></table>";
            $item_total = 0;

$sl++;
endforeach;




$html = <<<ATOMIC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="../../resource/images/favicon.ico">
    <link rel="shortcut icon" href="../../resource/images/favicon.ico" />
    <link rel="stylesheet" href="../../resource/css/form.css">
    <link rel="stylesheet" href="../../resource/css/stuck.css">
    <link rel="stylesheet" href="../../resource/css/style.css">
    <link rel="stylesheet" href="../../resource/formResource/css/booking.css">
    <script src="../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../resource/js/jquery.js"></script>
    <script src="../../resource/js/jquery-migrate-1.1.1.js"></script>
    <script src="../../resource/js/script.js"></script>
    <script src="../../resource/js/superfish.js"></script>
    <script src="../../resource/js/jquery.equalheights.js"></script>
    <script src="../../resource/js/jquery.mobilemenu.js"></script>
    <script src="../../resource/js/jquery.easing.1.3.js"></script>
    <script src="../../resource/js/tmStickUp.js"></script>
    <script src="../../resource/js/jquery.ui.totop.js"></script>
    <script src="../../resource/js/TMForm.js"></script>
    <script src="../../resource/js/modal.js"></script>
    <script src="../../resource/js/touchTouch.jquery.js"></script>
    
    <link rel="stylesheet" href="../../resource/Custom/style.css">
    <script src="../../resource/formResource/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="../../resource/formResource/js/booking.js"></script>
   <title>Invoice</title>

</head>
<body>
<center><h1>Invoice</h1></center>
<div>
<h2>Order List</h2>
<table cellpadding="10" cellspacing="1" style="border: #edeb82 solid; " class="order">
                      <tbody>
                      
                      $tableDynamicData
                      
                      </tbody>
                  </table>
   
    <footer class="text-center">
            <p>&copy; Copyright The Entree Restaurant 2016</p>
    </footer>
    </div>

</body>

</html>


ATOMIC;

include_once ('../../../vendor/phpmailer/phpmailer/class.phpmailer.php');
include_once ('../../../vendor/phpmailer/phpmailer/class.smtp.php');

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug =0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "sblief.sb@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "emON#744254";
//Set who the message is to be sent from
$mail->setFrom('atomicproject@shibliemon.com', 'Ashfak Md. Shibli');
//Set an alternative reply-to address
$mail->addReplyTo('shibli.emon@gmail.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email, $name);
//Set the subject line
$mail->Subject = "The Entree Invoice Info";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$file = fopen("mailBody.html","w");
fwrite($file,$html);
fclose($file);
$mail->msgHTML(file_get_contents('mailBody.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//$mail->Body= $html;
//Attach an image file

//send the message, check for errors
if (!$mail->send()) {
    echo Message::message("Mailer Error: " . $mail->ErrorInfo);
    Utility::redirect('../profile.php');
} else {
    echo Message::message("Please Check your email for Invoice");
    Utility::redirect('../profile.php');
}
?>