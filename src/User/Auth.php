<?php
namespace App\User;
if(!isset( $_SESSION) )  session_start();
//include_once('../../vendor/autoload.php');

use App\Model\Database as DB;
use App\GlobalClasses\Utility;

class Auth extends DB
{
    public $email = "";
    public $password = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function prepare($data = Array())
    {
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data)) {
            $this->password = md5($data['password']);
        }
        return $this;

    }

    public function is_exist()
    {
        $query = "SELECT * FROM `users` WHERE `email`='" . $this->email . "'";

        $result = mysqli_query($this->conn, $query);
        //$row= mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function is_registered()
    {
        $query = "SELECT * FROM `users` WHERE `email`='" . $this->email . "' AND `password`='" . $this->password . "'";
        $result = mysqli_query($this->conn, $query);
        //$row= mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logged_in()
    {
        if ((array_key_exists('user_email', $_SESSION)) && (!empty($_SESSION['user_email']))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function log_out(){
        $_SESSION['user_email']="";
        return TRUE;
    }







}

