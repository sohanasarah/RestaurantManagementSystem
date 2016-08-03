<?php
require_once('twilio-php-master/Services/Twilio.php'); // Loads the library

//$version = "2010-04-01"; // Twilio REST API version

// Set our Account SID and AuthToken
$account_sid = "ACc7f08c9365c9cba3044afa2120b47cbd";
$auth_token= "fc1c92593d5a24186baee48be3b65add";

$client = new Services_Twilio($account_sid, $auth_token);

$msg = "01711666162";
$client->account->messages->create(array(
    'To' => "+88".$msg,
    'From' => "+120",
    'Body' => "Hello",
));
// Display a confirmation message on the screen
