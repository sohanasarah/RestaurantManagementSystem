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
        if(array_key_exists('food_code',$data))
        {
            $this->foodCode=$data['food_code'];
        }
        if(array_key_exists('price',$data))
        {
            $this->price=$data['price'];
        }

        return $this;
    }

    public function storeOrder()
    {
        $query="INSERT INTO `orderfood`(`user_id`, `food_code`) VALUES ('".$this->userID."', '".$this->foodCode."')";
        $result=mysqli_query($this->conn,$query);
        $id = mysqli_insert_id($this->conn);
        $invoiceID=$id."".$this->userID;

        $query="UPDATE `orderfood` SET `invoice-id`=$invoiceID WHERE `user_id`=".$this->userID;
        $result=mysqli_query($this->conn,$query);

        $orderID=100+$id;

        $query = "INSERT INTO `mappingorder`(`order_id`,) VALUE ($orderID)";
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            Utility::redirect('index.php');
        }
    }
}