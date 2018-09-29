
<div id="logo-title">
    <a href="index.php">
        <img src="images/logo1.jpg" alt="logo">
        <span>TRIPUT MERI...</span>
    </a>
</div>
<ul id="lang-list">
    <li><a href="cart.php"><i class="fa fa-shopping-bag" style="font-size:18px"></i>
    <?php
        if(isset($_COOKIE['shopping_cart'])){
            $cookie_data = stripslashes($_COOKIE['shopping_cart']); //uzima vrednost iz cookie-a
            $cart_data = json_decode($cookie_data, true); // prebacuje podatke u niz
            $count=count($cart_data);
            echo '<div class="shoping-bag-items"><span class="numb">'.$count.'</span></div>';} else //broj proizvoda u korpi
            { echo '<div class="shoping-bag-items"><span class="numb">0</span></div>';}
    ?>
    </a></li> 
    <li> 
        <?php 
        if (isset($_SESSION["user"])){
            if ($_SESSION["user"]=="admin") {
                echo '<a href="admin.php">'.$_SESSION["user"].'</a>';
            } else {
                echo '<a href="index.php">'.$_SESSION["user"].'</a>'; 
            }
        }    
        ?>
    </li>
</ul>

<ul id="menu-list">
    <li id ="bed"><a href="kitchen.php?category=Kuhinja">KUHINJA</a></li>
    <li id ="pil"><a href="dining.php?category=Trpezarija">TRPEZARIJA</a></li>
    <li id="bath"><a href="accessories.php?category=Dodaci">DODACI</a></li>
    <li><a class="sale" href="month-sale.php">AKCIJA!</a></li>
    <li><a href="newArrivals.php">NOVO U PONUDI</a></li>
    <li><a href="about.php">O NAMA</a></li>
</ul>

<div class="row">
    <div id="cont-1" class="dropdown-content">
        <?php
            include("dropdown1.inc.php");
        ?>
    </div>
    <div id="cont-2" class="dropdown-content">
        <?php
            include("dropdown2.inc.php");
        ?>
    </div>
    <div id="cont-3" class="dropdown-content">
        <?php
            include("dropdown3.inc.php");
        ?>
    </div>
</div>





