<?php
include_once ('../../vendor/autoload.php');

use App\Restaurant\Restaurant;
use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Admin\Admin;


if(!isset($_SESSION)){
    session_start();
}
$newMenu = new Admin();
$menuItems = $newMenu->getTotalMenue();
include ('header.php');
?>
<style>
    #wrapper .text {
        position:relative;
        bottom:30px;
        left:0px;
        visibility:hidden;
    }
    #color
    {
        color: gray;
        font-family: "Baskerville Old Face", Times, serif;
    }
    </style>
<section class="content gallery pad1"><div class="ic"></div>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">

                    <a class="thumbnail" href="menu_appetizer.php">
                        <img class="img-responsive img-thumbnai" src="../../resource/FoodImage/appetizer.jpg" alt="" height="220">
                        <center><h3 id="color">Appetizer</h3></center>
                    </a>

                </div>
            </div>
                    </div>
                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">
                <a class="thumbnail" href="menu_maincourse.php">
                    <img class="img-responsive img-thumbnai" src="../../resource/FoodImage/main_course.jpg" alt="" height="220">
                    <center><h3 id="color">Main Course</h3></center>
                </a>
            </div>
                        </div>
                    </div>

                <div class="grid_4">
                    <div class="gall_block">
                        <div class="maxheight">
                <a class="thumbnail" href="menu_desserts_drinks.php">
                    <img class="img-responsive img-thumbnai" src="../../resource/FoodImage/drinks.jpg" alt="" height="220">
                    <center><h3 id="color">Drinks & Desserts</h3></center>
                </a>
            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include ('footer.php');?>
