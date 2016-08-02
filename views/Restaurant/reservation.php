<?php
include_once('../../vendor/autoload.php');
use App\Reservation\Reservation;



include ('header.php');
if(!isset($_SESSION)){
    session_start();
}




if(isset($_REQUEST['reservationTable']))
{

    $reservation = new Reservation();

    $reservation->prepare($_REQUEST);

    $reservation->store();

}


?>
<!--=====================
          Content
======================-->
<section class="content"><div class="ic"></div>
  <div class="container">
    <div class="row">
      <div class="grid_8">

          <p><img src="../../resource/table-chair/restaurant-map.PNG" width="900" height="550" alt="table-chair mapping" /></p>



      </div>
      <div class="grid_4">
          <h2>Reserve Your Table</h2>
        <div class="form_title color1">
        We are open 7 days a week - 10:00 AM to 11:59 PM <br>+880 1700 000 000</div>



        <form   action="reservation.php" method="get" id="bookingForm">


            <div class="clear"></div>
            <strong class="dt">
                Reservation Date
            </strong>
            <label >
                <input  <?php if(isset($_GET['reservationDate'])&& isset($_GET['reservationTimeSlot']) && ($_GET['reservationDate']!="") ) echo "value=\"".$_GET['reservationDate']. "\" disabled=\"disabled\"" ?> id="datepicker" type="date" name="reservationDate" >
            </label>
            <div class="clear"></div>





            <div class="clear"></div>
            <div class="fl1 ">
                <em style="width:159px">Reservation Time Slot</em>
                <select   <?php if(isset($_GET['reservationDate'])&& isset($_GET['reservationTimeSlot']) && ($_GET['reservationDate']!="") ) echo "disabled=\"disabled\"" ?> name="reservationTimeSlot" style="width: auto" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">

                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="10:00am-10:59am") )echo "selected" ?> >10:00am-10:59am</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="11:00am-11:59am") )echo "selected" ?> >11:00am-11:59am</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="12:00pm-12:59pm") )echo "selected" ?> >12:00pm-12:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="1:00pm-1:59pm") )echo "selected" ?> >1:00pm-1:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="2:00pm-2:59pm") )echo "selected" ?> >2:00pm-2:59pm</option>
                    <option> <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="3:00pm-3:59pm") )echo "selected" ?>3:00pm-3:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="4:00pm-4:59pm") )echo "selected" ?>>4:00pm-4:59pm</option>
                    <option  <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="5:00pm-5:59pm") )echo "selected" ?>>5:00pm-5:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="6:00pm-6:59pm") )echo "selected" ?>>6:00pm-6:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="7:00pm-7:59pm") )echo "selected" ?>>7:00pm-7:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="8:00pm-8:59pm") )echo "selected" ?>>8:00pm-8:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="9:00pm-9:59pm") )echo "selected" ?>>9:00pm-9:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="10:00pm-10:59pm") )echo "selected" ?>>10:00pm-10:59pm</option>
                    <option <?php if( isset($_GET['reservationTimeSlot']) && ($_GET['reservationTimeSlot']=="11:00pm-11:59pm") )echo "selected" ?>>11:00pm-11:59pm</option>

                </select>

                </div>

            <input  <?php if(isset($_GET['reservationDate'])&& isset($_GET['reservationTimeSlot']) && ($_GET['reservationDate']!="") ) echo "hidden" ?> type="submit" value="Search For Available Tables">

            <div class="clear"></div>



</form>


<?php

if(isset($_GET['reservationDate'])&& isset($_GET['reservationTimeSlot']) && ($_GET['reservationDate']!="") ) {

    ?>

    <form action="" method="post" id="bookingForm">

        <input type="hidden" name="reservationDate" value="<?php echo $_REQUEST['reservationDate'] ?>">
        <input type="hidden" name="reservationTimeSlot" value="<?php echo $_REQUEST['reservationTimeSlot'] ?>">

        <div class="fl1 ">
            <em style="width:159px">Please choose your table</em>
            <select name="reservationTable" style="width: auto" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">

                <?php

                $reservation = new Reservation();

                if (!$reservation->isBooked("Table#1 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#1 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#2 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#2 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#3 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#3 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#4 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#4 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#5 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#5 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#6 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#6 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#7 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#7 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#8 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#8 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#9 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#9 - 4 Seated</option> ";
                if (!$reservation->isBooked("Table#10 - 4 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#10 - 4 Seated</option> ";

                if (!$reservation->isBooked("Table#11 - 13 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#11 - 13 Seated</option> ";

                if (!$reservation->isBooked("Table#12 - 10 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#12 - 10 Seated</option> ";
                if (!$reservation->isBooked("Table#13 - 10 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#13 - 10 Seated</option> ";
                if (!$reservation->isBooked("Table#14 - 10 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#14 - 10 Seated</option> ";

                if (!$reservation->isBooked("Table#15 - 6 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#15 - 6 Seated</option> ";
                if (!$reservation->isBooked("Table#16 - 6 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#16 - 6 Seated</option> ";
                if (!$reservation->isBooked("Table#17 - 6 Seated", $_REQUEST['reservationDate'], $_REQUEST['reservationTimeSlot'])) echo " <option>Table#17 - 6 Seated</option> ";


                ?>


            </select>
        </div>

        <div class="ta__left">
            <input type="submit" value="Book Now!">
            <div class="clear"></div>
            <a href="../Restaurant/reservation.php" class="btn" data-type="reset">clear</a>



        </div>

    </form>

<?php } ?>


      </div>
    </div>
  </div>
</section>
<!--==============================
              footer
=================================-->
<?php include ('footer.php');?>
  <script>
  $(function (){
        $('#bookingForm').bookingForm({
            ownerEmail: '#'
        });
    });
    $(function() {
   $('#bookingForm input, #bookingForm textarea').placeholder();
  });
    
  </script>


<script>
    $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'dd-MM-yy', changeMonth: true,
            changeYear: true, yearRange: "1930:2016"  }).val();
    });
</script>


</body>
</html>


