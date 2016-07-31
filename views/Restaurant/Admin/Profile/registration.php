<?php
session_start();
include_once('../../../../vendor/autoload.php');
use App\Admin\Admin;
use App\Admin\Auth;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

$auth= new Auth();

$status= $auth->prepare($_POST)->is_exist();
if($status){
    Message::setMessage("<div class='alert alert-danger'>
                            <strong>Taken!</strong> Email has already been taken .
                </div>");
    return Utility::redirect($_SERVER['HTTP_REFERER']);
}else{
    $obj= new Admin();
    $obj->prepare($_POST)->addAdmin();
    return Utility::redirect('admin-login.php');
}
