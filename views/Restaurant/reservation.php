<?php
include_once('../../vendor/autoload.php');
include ('header.php');
if(!isset($_SESSION)){
    session_start();
}


?>
<!--=====================
          Content
======================-->
<section class="content"><div class="ic"></div>
  <div class="container">
    <div class="row">
      <div class="grid_8">
        <h2>Reserve Your Table</h2>

          <p><img src="../../resource/table-chair/restaurant-map.PNG" width="600" height="450" alt="table-chair mapping" /></p>



      </div>
      <div class="grid_4">
        <h2>Our Hours</h2>
        <div class="form_title color1">
        We are open 7 days a week - 8 AM to 12 PM <br>+1 101 889 9898</div>
        <form id="bookingForm">


            <div class="clear"></div>
            <strong class="dt">
                Reservation Date
            </strong>
            <label >
                <input id="datepicker" type="date" name="reservationDate" >
            </label>
            <div class="clear"></div>





            <div class="clear"></div>
            <div class="fl1 ">
                <em style="width:159px">Reservation Time Slot</em>
                <select name="reservationTimeSlot" style="width: auto" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                    <option>10:00am-10:59am</option>
                    <option>11:00am-11:59am</option>
                    <option>12:00pm-12:59pm</option>
                    <option>1:00pm-1:59pm</option>
                    <option>2:00pm-2:59pm</option>
                    <option>2:00pm-2:59pm</option>
                    <option>3:00pm-3:59pm</option>
                    <option>4:00pm-4:59pm</option>
                    <option>5:00pm-5:59pm</option>
                    <option>6:00pm-6:59pm</option>
                    <option>7:00pm-7:59pm</option>
                    <option>8:00pm-8:59pm</option>
                    <option>9:00pm-9:59pm</option>
                    <option>10:00pm-10:59pm</option>
                    <option>11:00pm-11:59pm</option>

                </select>

                </div>
                <div class="clear height1"></div>







                <div class="clear"></div>
            <div class="fl1 ">
                <em style="width:159px">Please choose your table</em>
                <select name="Tables" style="width: auto" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                    <option>Table#1 - 4 Seated</option>
                    <option>Table#2 - 4 Seated</option>
                    <option>Table#3 - 4 Seated</option>
                    <option>Table#4 - 4 Seated</option>
                    <option>Table#5 - 4 Seated</option>
                    <option>Table#6 - 4 Seated</option>
                    <option>Table#7 - 4 Seated</option>
                    <option>Table#8 - 4 Seated</option>
                    <option>Table#9 - 4 Seated</option>
                    <option>Table#10 - 4 Seated</option>

                    <option>Table#11 - 13 Seated</option>

                    <option>Table#12 - 10 Seated</option>
                    <option>Table#13 - 10 Seated</option>
                    <option>Table#14 - 10 Seated</option>

                    <option>Table#15 - 6 Seated</option>
                    <option>Table#16 - 6 Seated</option>
                    <option>Table#17 - 6 Seated</option>

                </select>
                </div>
                <div class="clear height1"></div>

        <div class="clear"></div>
        
        <div class="tmTextarea">
            <textarea name="Message" placeHolder="Message:" data-constraints='@NotEmpty @Required @Length(min=20,max=999999)'></textarea>
        </div>
        <div class="ta__right">
        <a href="#" class="btn" data-type="reset">clear</a>
        <a href="#" class="btn" data-type="submit">send</a>
        </div>
    </form>
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


