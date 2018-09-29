<?php session_start(); ?>
<html>
<head>
<?php
        include("includes/head.inc.php");  
    ?>
</head>
<body onload="loadImagesBath()">
<header>
    <?php
        include ("includes/header.inc.php");
    ?>
</header>
<aside>
        <ul class="aside-list">
            <li><a href="accessories.php?category=Dodaci&subcategory=Kutija za recepte">KUTIJA ZA RECEPTE</a></li>
        </ul>
</aside>
<article>

<div class="row">
        <img class = "wrap_100"  src="images/bath2.jpg" alt="bedding">
        <div class="caption-m">
            <h1>BATH</h1><br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p><br>
            <p>Lorem.</p>
        </div>
</div>

<div id="wrapDiv-pill" class="row padd-20 mg-bt-40">
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
<script>
$(document).ready(function(){
    var count = 4;
    $(window).scroll(function(){
        var wrap = document.getElementById('wrapDiv-bath');
        var contentHeight = wrapBath.offsetHeight;
        var yOffset = window.pageYOffset;
        var y = yOffset + window.innerHeight;
        if (y >= contentHeight){
            count = count + 8;
            $("#wrapDiv-bath").load("includes/insertImage.inc.php", {
                newCount:  count,
                newTable: "bath_img"
            });
        }
    });
});

</script>
</body>
</html>