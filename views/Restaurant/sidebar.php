<?php
include_once ('../../vendor/autoload.php');

use App\User\User;
use App\User\Auth;

use App\GlobalClasses\Message;
use App\GlobalClasses\Utility;
use App\Restaurant\Restaurant;




$newFood = new Restaurant();
$allfood = $newFood->getAllItems();
shuffle($allfood);

$sl = 0;
?>


<div class="grid_4 preffix_1">
    <h2>Categories</h2>
    <ul class="list">
        <li><a href="menu.php?category=Appetizer">Appetizer</a></li>
        <li><a href="menu.php?category=Main%20Course">Main Course</a></li>
        <li><a href="menu.php?category=DESSERTS%20or%20DRINKS">Dessert & Drinks</a></li>
    </ul>
    <h2>You May Also Like</h2>
    <?php foreach ($allfood as $food) {
        $sl++;
        if ($sl>8) break;?>
    <div class="block3">
        <img src="../../resource/FoodImage/<?php echo $food->food_image?>" alt="" height="100px" width="100px" class="img_inner noresize fleft">
        <div class="extra_wrapper">
            <div class="text1 color1">
                <time datetime=""><?php echo $food->food_name?></time>
                <a href="menu.php?category=<?php echo $food->category?>"><?php echo $food->category?></a>
            </div> <a href="#" class="color1">[...]</a>
        </div>
    </div>
    <?php
    } ?>
    
</div>
</div>