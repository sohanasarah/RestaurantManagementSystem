<?php
include_once ('../../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;
use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;


$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$html = <<<ATOMIC
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    
   <title>Message From User</title>

</head>
<body>
<center><h1>Message</h1></center>
<div>
<h2>From $name</h2>
        <strong><label for="name">Name :</label></strong>
          <input id="Name" class="tmInput" value="$name" type="text" name="name" >

          <div class="clear f_sep1"></div>
          <strong>Email :</strong>
          <input class="tmInput" value="$email" type="email" name="email">

          <div class="clear f_sep1"></div>
          <strong class="dt">Phone :</strong>
          <input class="tmInput" value="$phone" type="text" name="phone">
          <div class="clear f_sep1"></div>
          <strong class="dt">Message :</strong>
          <div class="clear f_sep1"></div>
          <textarea name="message" rows="4" cols="50">$message</textarea>
   
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
$mail->Username = "the.entree.restaurant@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "abcd#1234";
//Set who the message is to be sent from
$mail->setFrom($email , $name);
//Set an alternative reply-to address
$mail->addReplyTo('the.entree.restaurant@gmail.com', 'The Entree');
//Set who the message is to be sent to
$mail->addAddress('the.entree.restaurant@gmail.com',  'The Entree Contact Form');
//Set the subject line
$mail->Subject = "The Entree Contact";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$file = fopen("contactMailBody.html","w");
fwrite($file,$html);
fclose($file);
$mail->msgHTML(file_get_contents('contactMailBody.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//$mail->Body= $html;
//Attach an image file

//send the message, check for errors
if (!$mail->send()) {
    echo Message::message("Mailer Error: " . $mail->ErrorInfo);
    Utility::redirect('../contact.php');
} else {
    echo Message::message("Successfully Sent Message");
    Utility::redirect('../contact.php');
}
?>