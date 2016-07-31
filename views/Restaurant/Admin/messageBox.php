
<center><h2>

        <?php

        include_once('../../../vendor/autoload.php');
        use App\GlobalClasses\Message;
        if(!isset($_SESSION)) session_start();


        ?>



        <?php  if(isset($_SESSION['message']) )  if($_SESSION['message']!=""){ ?>

            <div  id="message" class="form button"   style="font-size: smaller  " >
                <center>
                    <?php if((array_key_exists('message',$_SESSION)&& (!empty($_SESSION['message'])))) {
                        echo "<span>".Message::message()."</span>";
                    }
                    Message::message(NULL);

                    ?></center>
            </div>


        <?php } ?>




    </h2></center>
