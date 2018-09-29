<?php session_start(); ?>
<html>
<head>
<?php
        include("includes/head.inc.php");  
    ?>
</head>
<body>
<header>
    <?php
        include("includes/header.inc.php");
    ?>
</header>
<aside>
        <ul class="aside-list">
            <li><a href="kitchen.php?category=Kuhinja&subcategory=Rukavice">RUKAVICE</a></li>
            <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja">KECELJE</a></li>
                <ul class="nested-list">
                    <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja&material=Lan">Lan</a></li>
                    <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja&material=Pamuk-lan">Pamuk-lan</a></li>
                    <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja&type=Kratka">Kratke</a></li>
                    <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja&type=Duga">Duge</a></li>
                    <li><a href="kitchen.php?category=Kuhinja&subcategory=Kecelja">Sve</a></li>
                </ul>
            <!-- <li><a href="kitchen.php?category=Kuhinja&subcategory=Kutija">KUTIJE ZA RECEPTE</a></li> -->
            <li><a href="kitchen.php?category=Kuhinja">SVI PROIZVODI</a></li>
        </ul>
</aside>
<article>
    <div class="row">
        <img class = "wrap_100"  src="images/bedding.jpg" alt="kitchen">
        <div class="caption-m">
            <h1>BEDDING</h1><br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p><br>
            <p>Lorem.</p>
        </div>
    </div>

  <div id="wrapDiv-pill" class="row padd-20  mg-bt-40">
        <?php
            include("includes/showProducts.inc.php");
        ?>
    </div>  
</article>
<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>
</body>
</html>