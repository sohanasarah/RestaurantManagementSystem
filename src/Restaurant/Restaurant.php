<?php
namespace App\Restaurant;


class Restaurant
{

// For cart start Block-1
    public $productIdCart="";
    public $productNameCart = "";
    public $productCodeCart = "";
    public $productImageCart = "";
    public $productPriceCart = "";
    // For cart end Block-1

    public $conn;
    public $deleted_at;

    public $refferarFilename;



    public function prepare($data=""){


        if(array_key_exists("id",$data)){
            $this->productIdCart=$data['id'];
        }
        if(array_key_exists("code",$data)){
            $this->productCodeCart=$data['code'];
        }


        return $this;




    }
    public function getAllItems()
    {
        $_allData = array();
         $query = "SELECT * FROM `product`";
        $result = mysqli_query($this->conn,$query);
        if($result){
            while($row = mysqli_fetch_object($result)){
                $_allData[] = $row;
            }
        }
        return $_allData;

    }

    public function getItem()
    {
        $row = '';
        $query = "1 = 1";

        if(!empty($this->productIdCart))
        $query="SELECT * FROM `product` WHERE `id`=".$this->productIdCart;
        if(!empty($this->productCodeCart))
        $query="SELECT * FROM `product` WHERE `code` = "."'$this->productCodeCart'";

        $result= mysqli_query($this->conn,$query);
        if($result) {
            $row = mysqli_fetch_object($result);
        }
        return $row;

    }



    public  function __construct($restaurant=false)
    {
        if (isset($_SERVER['HTTP_REFERER']) ) {
            $this->refferarFilename = basename((string)$_SERVER['HTTP_REFERER']);
            if (strpos($this->refferarFilename, ".php") == false) $this->refferarFilename = "index.php";
        } else $this->refferarFilename = "index.php";

        $this->conn=mysqli_connect("localhost","root","","restaurant") or die("Database connection failed");
    }
    public function userOrders($data = "")
    {
        $_data = array();
        $query = "SELECT users.first_name, orderfood.invoice_id,orderfood.current_date,orderfood.total, orderfood.delivery_status, mappingorder.quantity ,fooditem.food_name,fooditem.price, fooditem.category FROM users JOIN orderfood ON orderfood.user_id = users.id JOIN mappingorder ON mappingorder.order_id = orderfood.id Left JOIN fooditem ON mappingorder.food_code = fooditem.food_code WHERE users.email ="."'$data'";
        $result = mysqli_query($this->conn,$query);
        if($result){
            while ($row = mysqli_fetch_assoc($result)){
                $_data[] = $row;
            }
        }
        var_dump($_data);

        return $_data;

    }





}