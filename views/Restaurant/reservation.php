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
        <img src="../../resource/images/page3_img1.jpg" alt="" class="img_inner fleft inn__1">
        <div class="extra_wrapper">
          <div class="text1 tx__1"><a href="#">Vivamus at magna non nunc </a></div>
          <p>Rehoncus. Aliquam nibh antegestas id ictum ado. Praesenterto faucibus maleada faucibusnec laeetert metus id laoreet </p>
          <p>Nullam consectetur orci sed nulla facilisisequaterto. Curabitur vel lorem sit amet nulla perermentum. Aliquam nibh ante, egestas id dictum a, commodo luctus libero.</p>
          Praesent faucibus malesuada faucibus. Donecertolin laoreet metus id laoreet malesuada.  orem ipsum dolor sit amet, consectetur adipiscing elit. 
        </div>
        <div class="clear"></div>
        <h2>Useful Information</h2>
        <div class="text1 tx__1"><a href="#">Hivamus at magna non nuncerto limonit nelowert sedrolino. Integer convallis orci vel miеter laoreet, at ornare lorem consequat. Phasellus erat nisl, auctor vel velit sed.</a></div>
        <p>Nehoncus. Aliquam nibh antegestas id ictum ado. Praesenterto faucibus maleada faucibusnec laeet metus id laoreet rolito monert dertolimon.</p>
        <p>Nullam consectetur orci sed nulla facilisisequat. Curabitur vel lorem sit amet nulla perermentum. Aliquam nibh ante, egestas id dictum a, commodo luctus libero. </p>
        Praesent faucibus malesuada faucibus. Donec laoreet metus id laoreet malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consectetur orci sed nulla facilisis consequat. Curabitur vel lorem sit amet nulla ullamcorper fermentum. In vitae varius augue, eu consectetur ligula. <br>
        <a href="#" class="btn">more</a>
      </div>
      <div class="grid_4">
        <h2>Our Hours</h2>
        <div class="form_title color1">
        We are open 7 days a week - 8 AM to 12 PM <br>+1 101 889 9898</div>
        <form id="bookingForm">
          <div class="tmInput">
              <input name="Name" placeHolder="Name:" type="text" data-constraints='@NotEmpty @Required @AlphaSpecial'>
          </div>
        <div class="tmInput">
          <input name="Email" placeHolder="Email:" type="text" data-constraints="@NotEmpty @Required @Email">
        </div>     
         <div class="clear f_sep1"></div>
          <strong class="dt">Check-in</strong>
         <label class="tmDatepicker">
          <input type="text" name="Date"  placeHolder='10/05/2014' data-constraints="@NotEmpty @Required @Date">
        </label>
        <div class="clear"></div>
          <strong class="dt">Check-out</strong>
        <label class="tmDatepicker">
          <input type="text" name="Date"  placeHolder='20/05/2014' data-constraints="@NotEmpty @Required @Date">
        </label>
        <div class="clear"></div>
        <div class="fl1 ">
        <em>Adults</em>
        <select name="Adults" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
            <option>1</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <div class="clear height1"></div>
       
        
        </div>
        <div class="fl1">
        <em>Children</em>
        <select name="Children" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
            <option>0</option>
            <option>0</option>
            <option>1</option>
            <option>2</option>
        </select>
        
        </div>
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
    })
    $(function() {
   $('#bookingForm input, #bookingForm textarea').placeholder();
  });
    
  </script>
</body>
</html>

