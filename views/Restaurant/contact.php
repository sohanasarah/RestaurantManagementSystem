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
        <form id="form" >
        <div class="form_spinner">
        <img src="../../resource/images/Preloader_4.gif" alt="">
        </div>
        <div class="modal fade response-message">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
        asfasfasf
        </div>      
        </div>
        </div>
        </div>
        <div class="response-error-message"></div>
        <label class="name">
        <input type="text" name="name" placeholder="Name:" value="" data-constraints="@Required @JustLetters" />
        <span class="empty-message">*This field is required.</span>
        <span class="error-message">*This is not a valid name.</span>
        </label>         
        <label class="email">
        <input type="text" name="email" placeholder="E-mail:" value="" data-constraints="@Required @Email" />
        <span class="empty-message">*This field is required.</span>
        <span class="error-message">*This is not a valid email.</span>
        </label>
        <label class="phone">
        <input type="text" name="phone" placeholder="Phone:" value="" data-constraints="@Required @JustNumbers"/>
        <span class="empty-message">*This field is required.</span>
        <span class="error-message">*This is not a valid phone.</span>
        </label>
        <label class="message">
        <textarea name="message" placeholder="Message:" data-constraints='@Required @Length(min=20,max=999999)'></textarea>
        <span class="empty-message">*This field is required.</span>
        <span class="error-message">*The message is too short.</span>
        </label>
        <div class="clear"></div>
        <div class="btns">
        <a href="#" data-type="reset" class="btn">clear</a>
        <a href="#" data-type="submit" class="btn">send</a>
        </div>
        </form>   
      </div>
    </div>
  </div>
</div>
<!--==============================
              footer
=================================-->
<?php include ('footer.php');?>
