<?php
error_reporting(0);
include_once ("../../../vendor/autoload.php");
use App\Bitm\SEIP133704\Profile\Picture;
use App\Bitm\SEIP133704\Profile\Uses;
use App\Bitm\SEIP133704\GlobalClasses\Utility;
use App\Bitm\SEIP133704\GlobalClasses\Message;

if (isset($_POST['receiverName'])) {
    $name = $_POST['receiverName'];
    $email = $_POST['receiverEmail'];
}

$newMail = new Picture();
if(!empty($_POST['id'])) {
    $newMail->prepare($_POST);
    $singleItem = $newMail->view();

    $id = $singleItem->id;
    $itemName = $singleItem->name;
    $itemData = $singleItem->email_address;


    $tableColumn = array("SL","ID","User Name","Thumbnail","","");
    $title =  Uses::siteName();
    $keyword =  Uses::siteKeyword();


    $tableDynamicData = "";
    $sl = 1;
        $tableDynamicData .= "<tr>";
        $tableDynamicData .= "<td>$sl</td>";
        $tableDynamicData .= "<td>$id</td>";
        $tableDynamicData .= "<td>$itemName</td>";
    $tableDynamicData .= "<td><img src=\"../../../resource/images/$singleItem->images\" height=\"50px\" width=\"50px\"></td>";
        $tableDynamicData .= "</tr>";
$html = <<<ATOMIC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/CustomDesign/css/style.css">
    <script src="../../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../../resource/bootstrap-3.3.6/js/bootstrap.min.js"></script>

    <title>$title</title>

</head>
<body>
<center><h1>$title</h1></center>
<div>
<h2>$keyword List</h2>
<table class="table table-bordered table-responsive table-hover" >

        <thead>
        <tr>
<!--            table heads are taken from array-->
            <th>$tableColumn[0]</th>
            <th>$tableColumn[1]</th>
            <th>$tableColumn[2]</th>
            <th>$tableColumn[3]</th>
            
        </tr>
        </thead>
        <tbody>
         $tableDynamicData

        </tbody>
    </table>
   
    <footer class="text-center">
            <p>&copy; Copyright Ashfak Md. Shibli & Atomic Projects 2016</p>
    </footer>
    </div>

</body>

</html>


ATOMIC;


}
else {
    include ('pdf.php');
    $allItems = $newMail->index();



    $tableColumn = array("SL","ID","User Name","Thumbnail","","");
$title =  Uses::siteName();
$keyword =  Uses::siteKeyword();


$tableDynamicData = "";
$sl = 0;


foreach ($allItems as $item ):
    $sl++;

    $tableDynamicData .= "<tr>";
    $tableDynamicData .= "<td>$sl</td>";
    $tableDynamicData .= "<td>$item->ID</td>";
    $tableDynamicData .= "<td>$item->name</td>";
    $tableDynamicData .= "<td><img src=\"../../../resource/images/$item->images\" height=\"50px\" width=\"50px\"></td>";
    $tableDynamicData .= "</tr>";

endforeach;




$html = <<<ATOMIC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../resource/bootstrap-3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/CustomDesign/css/style.css">
    <script src="../../../resource/jquery/1.12.0/jquery.min.js"></script>
    <script src="../../../resource/bootstrap-3.3.6/js/bootstrap.min.js"></script>

    <title>$title</title>

</head>
<body>
<center><h1>$title</h1></center>
<div>
<h2>$keyword List</h2>
<table class="table table-bordered table-responsive table-hover" >

        <thead>
        <tr>
<!--            table heads are taken from array-->
            <th>$tableColumn[0]</th>
            <th>$tableColumn[1]</th>
            <th>$tableColumn[2]</th>
            <th>$tableColumn[3]</th>
            
        </tr>
        </thead>
        <tbody>
         $tableDynamicData

        </tbody>
    </table>
   
    <footer class="text-center">
            <p>&copy; Copyright Ashfak Md. Shibli & Atomic Projects 2016</p>
    </footer>
    </div>

</body>

</html>


ATOMIC;
}
include_once ('../../../vendor/phpmailer/phpmailer/class.phpmailer.php');

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
$mail->Subject = $title;
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
if(isset($_SESSION['attach'])){
    $mail->addAttachment($_SESSION['attach']);
    unset($_SESSION['attach']);
}
else {
    $mail->addAttachment('../../../resource/images/'.$singleItem->images);
}
//send the message, check for errors
if (!$mail->send()) {
    echo Message::message("Mailer Error: " . $mail->ErrorInfo);
    Utility::redirect('index.php');
} else {
    echo Message::message("
                        <div id=\"message\" class=\"alert alert-info\">
                                <strong>Successfully Sent email!</strong> 
                        </div>
                        <script>
                            $('#message').show().delay(2000).fadeOut();
                        </script>");
    Utility::redirect('index.php');
}
?>