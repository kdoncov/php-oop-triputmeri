<?php session_start(); ?>
<!DOCTYPE html>
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
<div class="row">

    <div class="col-6 padd-60 prod_info_rw">
        <div id="big_img" >
            <button id="prev" onclick ="startSlide(-1)"><i class="fa fa-angle-left" style="font-size:26px"></i></button>
            <button id="next" onclick ="startSlide(1)"><i class="fa fa-angle-right" style="font-size:26px"></i></button>
        </div>
        <div id="small_img" >
            <?php
                if(isset($_GET['id'])){
                $imgid = $_GET['id'];}
                else {
                    echo '<script>window.location.assign("index.php");</script>';
                }
                $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
                $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
                $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId ='$imgid'");
                //$row = mysqli_fetch_array($result);
                $niz = array();
                while ($row = mysqli_fetch_array($result)) {
                    $imgPaths[]=$row['ImagePath'];
                }
            ?>
        </div>
        </div>
        
    </div>
   <?php
        $sql = mysqli_query($conn, "SELECT * FROM product WHERE Id ='$imgid'");
        $sql1 = mysqli_query($conn, "SELECT * FROM images WHERE ProductId ='$imgid' AND IsCover = 1");
        $row = mysqli_fetch_array($sql);
        $row1 = mysqli_fetch_array($sql1);
   ?>
   <div class="col-6 padd-60 prod_info_rw">


        <div class="prod_info">
            <span class="prod_info_label"><i>Naziv:</i></span>
            <p><?php echo $row['Name'];?></p> 
        </div>

        <div class="prod_desc">
            <span class="prod_info_label"><i>Opis:</i></span>
            <p ><?php echo $row['Description'];?></p>
        </div>
       
        <div class="prod_info">
            <span class="prod_info_label"><i>Cena:</i></span>
            <p><?php echo $row['Price'];?> <span class="prod_info_label">RSD</span></p>
        </div>
       
       
       <form id ="submit_form" method="POST" action="cart.php">

            
            
            <div class="prod_add_to_cart">
                <button type="button" onclick="changeQuantity(-1)" class="prod_quantity" >-</button><input class="prod_quantity" type="text"  name="quantity" value="1"><button type="button" onclick="changeQuantity(1)" class="prod_quantity">+</button>
                <input class="prod_add" type="submit"  id="sub" name="add_to_cart" value="DODAJ U KORPU">

                <input type="hidden" name="hidden_item_id" value="<?php echo $row['Id']; ?>"><br>
                <input type="hidden" name="hidden_image_path" value="<?php echo $row1['ImagePath']; ?>"><br>
                <input type="hidden" name="hidden_name" value="<?php echo $row['Name']; ?>"><br>
                <input type="hidden" name="hidden_price" value="<?php echo $row['Price'];?>"><br>    
            </div>

       </form>
   </div>
</div>
   <div id="popupAlert">
       <!-- <h3>Proizvod <?php echo $row['Name']; ?> je dodat u korpu</h3> -->
   </div>

</section>
<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>


    <!-- <?php
        if(isset($_GET['alert'])){
        $alert = $_GET['alert'];}
    ?> -->
    
        
<script>
//***************slideshow***************
var jArray = <?php echo json_encode($imgPaths); ?>;
//document.getElementById('niz').innerHTML = jArray;

var n = 0;

var parent_a = document.getElementById('big_img');
var parent_b = document.getElementById('small_img');




    var node_a = document.createElement("img");
    node_a.setAttribute("src", jArray[n]); //dodati alt atribut
    node_a.setAttribute("id", "big")
    parent_a.appendChild(node_a);
    var max = 5;
    if (jArray.length>1){
        for(i=n; i<jArray.length; i++){
            var node_b = document.createElement("img");
            node_b.setAttribute("src", jArray[i]);
            node_b.setAttribute("class", "small");
            node_b.setAttribute("onclick", 'mySlideshow('+i+')');
            parent_b.appendChild(node_b);
        }
    }
        

// slide on click next/prev
if(jArray.length<2){
    document.getElementById('prev').style.display = "none";
    document.getElementById('next').style.display = "none";
}
function startSlide(controlId){
    n+=controlId;
    if (n<0){
        n=jArray.length-1;
    } if (n>jArray.length-1){
        n=0;
    }
    mySlideshow(n);
}

// change main image
function mySlideshow(e){
    var d = document.getElementById('big');
    d.setAttribute("src", jArray[e]);
    n = e;
}


//********* promena broja odabranih proizvoda 

function changeQuantity(n) {
    var x = parseInt(document.getElementsByName("quantity")[0].value);
	x += n;
	if(x<1 || isNaN(x)){
	    x=1;
	}
    document.getElementsByName("quantity")[0].value = x;
}
$(document).ready(function(){

    $('#submit_form').on('submit', function(e){  
        e.preventDefault();
        var myForm = document.getElementById('submit_form');
        var quantity = $("input[name='quantity']" ).val();
        if(!isNaN(quantity)){
            $.ajax({  
                url: 'cart.php', 
                type: "POST",
                data: new FormData(myForm),
                contentType:false,  
                cache:false,  
                processData:false,
                success: function(data) {  
                    $("#popupAlert").fadeIn().delay(1000).fadeOut(800);
                    $('#popupAlert').html($(data).find('#showAlert').html());
                    $('.numb').html($(data).find('#numbOfProducts').html());
                }  
            }); 
        } 
        else {
            $(function() {
                $("input[name='quantity']" ).val(1);
            });
        }
    });
});
        

        /* $(document).ready(function(){
                    if("<?php echo $alert;?>" == "success"){
                        $("#popupAlert").fadeIn().delay(1000).fadeOut(800);
                    }
           
        }); */


        </script>
   
    

    
    
</body>
</html>