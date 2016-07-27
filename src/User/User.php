<?php
namespace App\User;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
//include_once('../../vendor/autoload.php');

use App\Model\Database as DB;

class User extends DB{
    public $table="users";
    public $firstName="";
    public $lastName="";
    public $email="";
    public $phone="";
    public $address="";
    public $password="";
    public $id="";

    public function __construct()
    {
        parent::__construct();
    }

    public function prepare($data=array()){
        if(array_key_exists('first_name',$data)){
            $this->firstName=$data['first_name'];
        }
        if(array_key_exists('last_name',$data)){
            $this->lastName=$data['last_name'];
        }
        if(array_key_exists('email',$data)){
            $this->email=$data['email'];
        }
        if(array_key_exists('user_email',$data)){
            $this->email=$data['user_email'];
        }



        if(array_key_exists('phone',$data)){
            $this->phone=$data['phone'];
        }



        if(array_key_exists('address',$data)){
            $this->address=$data['address'];
        }

        if(array_key_exists('password',$data)){
            $this->password=md5($data['password']);
        }
        if(array_key_exists('id',$data)){
            $this->id=$data['id'];
        }

        return $this;


    }

    public function store(){
        $query="INSERT INTO `restaurant`.`users` (`first_name`, `last_name`, `email`, `password`, `phone`, `address`) VALUES ('".$this->firstName."', '".$this->lastName."', '".$this->email."', '".$this->password."', '".$this->phone."', '".$this->address."')";

        $result= mysqli_query($this->conn,$query);
        if ($result) {
            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> Data has been stored successfully.
                </div>");
            return Utility::redirect($_SERVER['HTTP_REFERER']);
        } else {
            Message::message("
                <div class=\"alert alert-danger\">
                            <strong>Fail!</strong> Data has not been stored successfully.
                </div>");
            return Utility::redirect($_SERVER['HTTP_REFERER']);
        }

    }




    public function change_password(){
        $query="UPDATE `restaurant`.`users` SET `password`='".$this->password."'  WHERE `users`.`email` = "."'".$this->email."'";


        //  Utility::dd($query);

        $result=mysqli_query($this->conn,$query);
        if($result){
            Message::message("
             <div class=\"alert alert-info\">
             <strong>Success!</strong> Password has been updated  successfully.
              </div>");
        }
        else {
            echo "Error";
        }


        return Utility::redirect($_SERVER['HTTP_REFERER']);

    }




    public function update(){
        $query="UPDATE `restaurant`.`users` SET `first_name`='".$this->firstName."', `last_name` = '".$this->lastName."' , `email` = '".$this->email."' , `phone` = '".$this->phone."' , `address` = '".$this->address."'   WHERE `users`.`email` = "."'".$this->email."'";


        //  Utility::dd($query);

        $result=mysqli_query($this->conn,$query);
        if($result){
            Message::message("
             <div class=\"alert alert-info\">
             <strong>Success!</strong> Data has been updated  successfully.
              </div>");
        }
        else {
            echo "Error";
        }


        return Utility::redirect($_SERVER['HTTP_REFERER']);

    }



public function view(){
        $query="SELECT * FROM `users` WHERE `email`='".$_SESSION['user_email']."'";



        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);

        return $row;


    }// end of view()



}
