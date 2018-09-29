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
    <section>
        <div class="image-container">
            <div class="slider-main">
                <img src="images/hero1.jpg" alt="naslovna">
                <div class="caption-m">
                    <h1>Lorem, ipsum dolor.</h1>
                    <p>Lorem, ipsum.</p>
                    <p>Lorem.</p>
                </div>
            </div>
            <div class="slider-main">
                <img src="images/hero2.jpg" alt="naslovna">
                <div class="caption-m">
                    <h1>Lorem, ipsum dolor.</h1>
                    <p>Lorem, ipsum.</p>
                    <p>Lorem.</p>
                </div>
            </div>
            <div class="slider-main">
                <img src="images/hero4.jpg" alt="naslovna">
                <div class="caption-m">
                    <h1>Lorem, ipsum dolor.</h1>
                    <p>Lorem, ipsum.</p>
                    <p>Lorem.</p>
                </div>
            </div>
        </div>
        <h1>Summer collectons</h1>
        <hr>
        <div class="row padd-60 mg-bt-40">
                <button id="prev" onclick="prevNextSlides(-1)"><i class="fa fa-angle-left" style="font-size:26px"></i></button>
                <?php
                    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
                    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
                    $result = mysqli_query($conn, "SELECT * FROM product WHERE UserDeleted IS NULL AND IsPublished = 1 ");
                    while ($row = mysqli_fetch_array($result)) {
                        $tempId = $row['Id'];
                        $sql = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = ' $tempId' AND IsCover = 1 ");
                        $row1 =  mysqli_fetch_array($sql);
                        echo '<div class = "image image_rw">
                            <a href="addToCart.php?id='.$tempId.'"><img src="'.$row1['ImagePath'].'"></a>
                            </div>'; }
                ?> 
                <button id="next" onclick="prevNextSlides(1)"><i class="fa fa-angle-right" style="font-size:26px"></i></button>
        </div>

</section>
    <footer>
    <?php
            include("includes/footer.inc.php");
        ?>
    </footer>

    <script> // srediti kod
    
        
        var slike = document.getElementsByClassName("image");
        if(slike.length < 4){
                document.getElementById("next").style.display = "none";
                document.getElementById("prev").style.display = "none";
                var a = 0;
                var b = slike.length;
            } else {
                var a = 0;
                var b = 4; 
            }
        for (i=0; i<slike.length; i++){
            slike[i].style.display = "none";}
        for (i=a; i<b; i++){
            slike[i].style.display = "inline-block";}
            var index = 0;

            if(slike.length < 5){
                document.getElementById("next").style.display = "none";
                document.getElementById("prev").style.display = "none";

            }
        function prevNextSlides(n) {
            
            a += n;
            b += n;
            if (a<0){
                a = 0;
                b = 4;
            }
            if (b > slike.length) {
                a = slike.length-4;
                b = slike.length;        
            }
            for (i=0; i<slike.length; i++){
                slike[i].style.display = "none";}
            for (i=a; i<b; i++){
                slike[i].style.display = "inline-block";}
            }
    





    </script>
</body>
</html>