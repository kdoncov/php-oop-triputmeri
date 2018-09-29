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
    <div class="row ajax-hide">
        <div id="newArrival">
            <h1>NOVO U PONUDI!</h1>
        </div>
    </div>
    <div class="row padd-60  mg-bt-40 ajax-hide ">
    <?php
        $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
        $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
        $result = mysqli_query($conn, "SELECT * FROM product WHERE UserDeleted IS NULL AND IsPublished = 1 ORDER BY PublishedOn DESC ");
        $monht_ago = strtotime(date('Y/m/d H:i:s')) - 97200; // dva sata 
        $bool = true;
        while ($row = mysqli_fetch_array($result)) {
            $x = strtotime($row['PublishedOn']);
            if($x > $monht_ago ){
                $bool = false;
                $tempId = $row['Id'];
                $sql = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = ' $tempId' AND IsCover = 1 ");
                $row1 =  mysqli_fetch_array($sql);
                echo '<div class = "image">
                    <a href="addToCart.php?id='.$tempId.'"><img src="'.$row1['ImagePath'].'"></a>
                    </div>'; }   
            
            }
        if($bool == true){
            echo    '<div id="new_arrival_info">
                        <p>-Trenutno nema novih proizvoda-</p>
                    </div>';
        }
    ?> 
    </div>
        
    </section>
    <footer>
        <?php
                include("includes/footer.inc.php");
            ?>
    </footer>
    <!-- <script>
        $(document).ready(function(){  

        if(<?php echo $bool; ?>){
            $('.ajax-hide').css("display", "none");
            $('section').load("includes/info.php")
        }



        });

        
    </script> -->
</body>
</html>