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
            <li><a href="dining.php?category=Trpezarija&subcategory=Stolnjak">STOLNJACI</a></li>
            <li><a href="dining.php?category=Trpezarija&subcategory=Set za rucavanje">SETOVI ZA RUČAVANJE</a></li>
                <ul class="nested-list">
                    <li><a href="dining.php?category=Trpezarija&subcategory=Set za rucavanje&numb=6">6-delni</a></li>
                    <li><a href="dining.php?category=Trpezarija&subcategory=Set za rucavanje&numb=4">4-delni</a></li>
                    <li><a href="dining.php?category=Trpezarija&subcategory=Set za rucavanje">Sve</a></li>
                </ul>
            <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za rucavanje">PODMETAČI ZA RUČAVANJE</a></li>
                <ul class="nested-list">
                <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za rucavanje&numb=6">6-delni</a></li>
                    <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za rucavanje&numb=4">4-delni</a></li>
                    <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za rucavanje&numb=2">2-delni</a></li>
                    <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za rucavanje">Sve</a></li>
                </ul>
            <li><a href="dining.php?category=Trpezarija&subcategory=Podmetaci za case">PODMETAČI ZA ČAŠE</a></li>
            <li><a href="dining.php?category=Trpezarija">SVI PROIZVODI</a></li>
        </ul>
</aside>
<article>
<div class="row">
        <img class = "wrap_100"  src="images/pillow.jpg" alt="bedding">
        <div class="caption-m">
            <h1>PILLOWS & DUVETS</h1><br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p></br>
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
<!-- <script>
$(document).ready(function(){
    var countPill = 4;
    $(window).scroll(function(){
        var wrap = document.getElementById('wrapDiv-pill');
        var contentHeight = wrap.offsetHeight + 350;
        var yOffset = window.pageYOffset;
        var y = yOffset + window.innerHeight;
        if (y >= contentHeight){
            countPill = countPill + 4;
            $("#wrapDiv-pill").load("includes/insertImage.inc.php", {
                newCount:  countPill,
                newTable: "product"
            });
        }
    });
});

</script> -->
</body>
</html>