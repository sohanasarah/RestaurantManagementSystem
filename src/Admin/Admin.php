<?php

namespace App\Admin;

use App\Model\Database as DB;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

class Admin extends DB
{
    public $id;
    public $category;
    public $foodName;
    public $foodImage;
    public $foodCode;
    public $price;
    public $deleted_at;


    public  function __construct()
    {
        parent::__construct();
    }

    public function prepare($data=array())
    {
        if(array_key_exists('id',$data))
        {
            $this->id=$data['id'];
        }
        if(array_key_exists('code',$data))
        {
            $this->foodCode=$data['code'];
        }
        if(array_key_exists('category',$data))
        {
            $this->category=$data['category'];
        }
        if(array_key_exists('food_name',$data))
        {
            $this->foodName=$data['food_name'];
        }
        if(array_key_exists('food_image',$data))
        {
            $this->foodImage=$data['food_image'];
        }
        if(array_key_exists('price',$data))
        {
            $this->price=$data['price'];
        }

        return $this;
    }

    public function store()
    {
        $query="INSERT INTO `fooditem` (`category`, `food_name`, `food_image`, `price`) VALUES ('".$this->category."', '".$this->foodName."', '".$this->foodImage."', '".$this->price."')";
        $result=mysqli_query($this->conn,$query);

        $id=mysqli_insert_id($this->conn);
        $_foodCode=1000+$id;
        $query="UPDATE `fooditem` SET `food_code`=$_foodCode WHERE `food_name`='".$this->foodName."'";

        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            Message::message("
        <div class=\"alert alert-success\">
        <strong>Success!</strong> Item has been inserted successfully.
        </div>");
            Utility::redirect("index.php");
        }
        else{
            echo "Error!!!";
        }

    }

    public function getMenueByCategory($category)
    {
        $_allMenue=array();
        $query="SELECT * FROM `fooditem` WHERE `category`='".$category."'";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result))
        {
            $_allMenue[]=$row;
        }
        return $_allMenue;
    }

    public function getTotalMenue()
    {
        $_allMenue=array();
        $query="SELECT * FROM `fooditem`";
        $result=mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result))
        {
            $_allMenue[]=$row;
        }
        return $_allMenue;
    }

    public function count()
    {
        $query="SELECT COUNT(*) AS totalItem FROM `fooditem` WHERE `deleted_at` IS NULL";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=10){
        $_allInfo=array();
        $query = "SELECT * FROM `fooditem` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result = mysqli_query($this->conn, $query);
        while($row=mysqli_fetch_assoc($result))
        {
            $_allInfo[]=$row;
        }
        return $_allInfo;

    }

    public function delete()
    {
        $query="DELETE FROM `restaurant`.`fooditem` WHERE `id`=".$this->id;
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            Message::message("
        <div class=\"alert alert-success\">
        <strong>Success!</strong> Item has been deleted successfully.
        </div>");
            Utility::redirect("index.php");
        }
        else{
            echo "Error!!!";
        }

    }

    public function view()
    {
        $row = array();
        $query = "1 = 1";

        if(!empty($this->id)){
            $query="SELECT * FROM `fooditem` WHERE `id`=".$this->id;
        }
        if(!empty($this->foodCode)){
            $query="SELECT * FROM `fooditem` WHERE `food_code`=".$this->foodCode;
        }

        

        $result=mysqli_query($this->conn,$query);
        if($result) $row=mysqli_fetch_assoc($result);
        return $row;
    }

    public function update()
    {
        if(!empty($this->foodImage))
        {
            $query="UPDATE `fooditem` SET
            `category`='".$this->category."',
            `food_name`='".$this->foodName."',
            `price`='".$this->price."',
            `food_image`= '".$this->foodImage."'
            WHERE `id` =".$this->id;

        }
        else{
            $query="UPDATE `fooditem` SET
            `category`='".$this->category."',
            `food_name`='".$this->foodName."',
            `price`='".$this->price."'
            WHERE `id` =".$this->id;
        }
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            Message::message("
        <div class=\"alert alert-info\">
        <strong>Success!</strong> Food Item has been Updated successfully.
        </div>");
            Utility::redirect("index.php");
        }
        else{
            echo "Error!!!";
        }
    }

    public function orderCount()
    {
        $query="SELECT COUNT(*) AS totalItem FROM `mappingorder`";
        $result=mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function orderPaginator($pageStartFrom=0,$Limit=10)
    {
        $_allInfo = array();
        $query = "SELECT `mappingorder`.`id`,`mappingorder`.`order_id`,`mappingorder`.`food_code`,`mappingorder`.`quantity`,`fooditem`.`food_name`,`orderfood`.`user_id`, `orderfood`.`current_date`
                  FROM `mappingorder` INNER JOIN `fooditem` ON `mappingorder`.`food_code`=`fooditem`.`food_code`
                  INNER JOIN `orderfood` ON `mappingorder`.`order_id`=`orderfood`.`id`
                  ORDER BY `orderfood`.`current_date` DESC
                  LIMIT " . $pageStartFrom . "," . $Limit;
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $_allInfo[] = $row;
        }
        return $_allInfo;
    }


    public function orderDelete($status=array())
    {
        if(is_array($status)){
            $sts= implode(",",$status);
            $query="SELECT `order_id` FROM `mappingorder` WHERE `mappingorder`.`id` IN(".$sts.")";
            $result= mysqli_query($this->conn,$query);
            while($row=mysqli_fetch_assoc($result))
            {
                $_OrderID[]=$row['order_id'];
            }
            //Utility::d($_OrderID);

            $query="DELETE FROM `mappingorder`  WHERE `mappingorder`.`id` IN(".$sts.")";
            echo $query;

            $result= mysqli_query($this->conn,$query);

            if(is_array($_OrderID)) {
                $sts = implode(",", $_OrderID);
                $STATUS="DELIVERED";

                $query = "UPDATE `orderfood` SET `orderfood`.`delivery_status`='".$STATUS."'
                     WHERE `orderfood`.`id` IN(" . $sts . ")";
                $result = mysqli_query($this->conn, $query);
            }

            if($result){
                Utility::redirect("../../../views/Restaurant/Admin/orderList.php");
            }
            else{
                echo "error";
            }
        }

    }



}