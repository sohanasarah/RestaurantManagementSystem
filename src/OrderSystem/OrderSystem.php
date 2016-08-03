<?php

namespace App\OrderSystem;

use App\Model\Database as DB;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

class OrderSystem extends DB
{

    public $id;
    public $foodCode;
    public $userID;
    public $quantity;
    public $orderID;
    public $userEmail;
    public $total;
    public $paymentNumber="";
    public $transactionId = "-";


    public function __construct()
    {
        parent::__construct();
    }

    public function prepare($data=array())
    {
        if(array_key_exists('id',$data))
        {
            $this->id=$data['id'];
        }
        if(array_key_exists('user_id',$data))
        {
            $this->userID=$data['user_id'];
        }
        if(array_key_exists('user_email',$data))
        {
            $this->userEmail=$data['user_email'];
        }

        if(array_key_exists('code',$data['cart_list']))
        {
            $this->foodCode=$data['cart_list']['code'];
        }
        if(array_key_exists('food_code',$data))
        {
            $this->foodCode=$data['food_code'];
        }
        if(array_key_exists('price',$data))
        {
            $this->price=$data['price'];
        }
        if(array_key_exists('total',$data))
        {
            $this->total=$data['total'];
        }
        if(array_key_exists('paymentNumber',$data))
        {
            $this->paymentNumber=$data['paymentNumber'];
        }
        if(array_key_exists('transactionId',$data))
        {
            $this->transactionId=$data['transactionId'];
        }

        return $this;
    }


    public function getUserID()
    {
        $query="SELECT `id` FROM `users` WHERE `email`='".$this->userEmail."'";
        $result=mysqli_query($this->conn,$query);
        $id=mysqli_fetch_assoc($result);
        return $id;
    }

    public function storeOrder()
    {
        $query="INSERT INTO `orderfood`(`user_id`, `food_code`, `total`,`payment`,`transaction_id`) VALUES ('$this->userID' , '$this->foodCode', '$this->total', '$this->paymentNumber', '$this->transactionId')";
        $result=mysqli_query($this->conn,$query);
        $id = mysqli_insert_id($this->conn);
        $invoiceID="inv".$id."_".$this->userID;

        $query="UPDATE `orderfood` SET `invoice_id`='$invoiceID' WHERE `id`=$id";
        $result=mysqli_query($this->conn,$query);

        $query = "SELECT `food_code` FROM `orderfood` WHERE `id`=$id";
        $result=mysqli_query($this->conn,$query);
        $foodCodeString=mysqli_fetch_assoc($result);
        $foodCodeArray=explode(',',$foodCodeString['food_code']);
        $field=count($foodCodeArray);

        for($i=0;$i<$field;$i++)
        {
            $quantity=($_SESSION['cart_list'][$foodCodeArray[$i]]['quantity']);
            $query = "INSERT INTO `mappingorder`(`order_id`, `food_code`,`quantity`) VALUE ($id,$foodCodeArray[$i],$quantity)";
            $result=mysqli_query($this->conn,$query);

        }

        if($result)
        {
           $_SESSION['cart_list']="";
            Message::message("Your Order Has been Placed Successfully check your email plz");
            Utility::redirect('../mail/sendmail.php');

        }
    }
}