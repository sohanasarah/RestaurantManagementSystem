<?php
namespace App\Reservation;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;

use App\Model\Database as DB;

class Reservation extends DB{

    public $id="";
    public $date="";
    public $time_slot="";
    public $invoice_id="";
    public $table_info="";

    public function __construct()
    {
        parent::__construct();
    }

    public function prepare($data=array()){

        if(array_key_exists('id',$data)){
            $this->id=$data['id'];
        }


        if(array_key_exists('reservationDate',$data)){
            $this->date=$data['reservationDate'];
        }
        if(array_key_exists('reservationTimeSlot',$data)){
            $this->time_slot=$data['reservationTimeSlot'];
        }
        if(array_key_exists('test',$data)){
            $this->invoice_id=$data['test'];
        }
        if(array_key_exists('reservationTable',$data)){
            $this->table_info=$data['reservationTable'];
        }



        return $this;


    }

    public function store(){
        $query="INSERT INTO `restaurant`.`reservation` (`date`, `time_slot`, `invoice_id`, `table_info`) VALUES ('".$this->date."', '".$this->time_slot."', '".$this->invoice_id."', '".$this->table_info."')";

        $result= mysqli_query($this->conn,$query);
        if ($result) {
            Message::message("
                <div class=\"alert alert-success\">
                            <strong>Success!</strong> $this->table_info has been reserved successfully.
                </div>");
           return Utility::redirect('');
        } else {
            Message::message("
                <div class=\"alert alert-danger\">
                            <strong>Fail!</strong> Data has not been stored successfully.
                </div>");
            
            return Utility::redirect('');
        }

    }



    public function getInvoiceID($table_info, $date, $time_slot){


        $query="SELECT * FROM `restaurant`.`reservation` WHERE `table_info`='".$table_info."'". " AND `date`='".$date."'". " AND `time_slot`='".$time_slot."'";

        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);

        $countRows= mysqli_num_rows($result);

        if($countRows>0)
            return $row->invoice_id;
        else
            return "";

    }// end of view()



    public function isBooked($table_info,$date,$time_slot){
        $query="SELECT * FROM `restaurant`.`reservation` WHERE `table_info`='".$table_info."'". " AND `date`='".$date."'". " AND `time_slot`='".$time_slot."'";

        $result= mysqli_query($this->conn,$query);
        $countRows= mysqli_num_rows($result);

        if($countRows>0)
          return True;
        else
          return False;




    }// end of isBooked




}
