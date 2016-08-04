<?php
include_once ('../../vendor/autoload.php');
include ('header.php');


?>
<!--=====================
          Content
======================-->
<section class="content ctn__1"><div class="ic"></div>
  <div class="container">
    <div class="row">
      <div class="grid_12">
        <h2>Find Us</h2>
        <div class="map">
          <div class="row">
            <div class="grid_9">
              <figure class="">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.8303319013057!2d91.82574481490147!3d22.360034446374467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd883461bf913%3A0x59b6e2e5c729313b!2sGolpahar+More%2C+Chittagong!5e0!3m2!1sen!2sbd!4v1470063182334" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>              </figure>
            </div>
            <div class="grid_3">
              <div class="map_block">
                <div class="map_title">Address:</div>
                Golpahar More, <br> Chittagong, Bangladesh.
              </div>
              <div class="map_block">
                <div class="map_title">Phones:</div>
                +88 018000000 <br>+88 017000000
              </div>
              <div class="map_block">
                <div class="map_title">Email:</div>
                <a href="#">abc@something.org</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="grid_8">
        <p>24/7 support is on for all <span class="color1 fw"></div>
    </div>
  </div>
</section>
<div class="form_block">
  <div class="container">
    <div class="row">
      <div class="grid_11">
        <h2>Contact Form</h2>
        <form id="bookingForm" method="post" action="mail/contactmail.php">
          <strong><label for="first_name">Name :</label></strong>
          <input id="Name" class="tmInput" value="" type="text" name="name" >

          <div class="clear f_sep1"></div>
          <strong>Email :</strong>
          <input class="tmInput" value="" type="email" name="email">

          <div class="clear f_sep1"></div>
          <strong class="dt">Phone :</strong>
          <input class="tmInput" value="" type="text" name="phone">
          <div class="clear f_sep1"></div>
          <strong class="dt">Message :</strong>
          <div class="clear f_sep1"></div>
          <textarea name="message" ></textarea>
          <button class="btn" href="#" type="reset">cancel</button>
          <button class="btn" type="submit" id="contact">send</button>

        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $('#contact').on('click',function () {
    document.form[0].action= "mail/contactmail.php";
    $('#form').submit();

  });
</script>
<!--==============================
              footer
=================================-->
<?php include ('footer.php');?>
