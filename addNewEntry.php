<?php session_start(); //starts the session
    if($_SESSION['user'] == 'admin'){ //checks if user is logged in
    
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    } 
?>
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
<?php
    $conn = mysqli_connect("localhost", "root", "") or die(mysql_error()); //connect to server
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database"); //Connect to database


?>
    <div class="col-6 padd-60">
        <form id="new_entry_form" class="product_form" action="addData.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Naziv</td>
                    <td><input type="text" name="name" required></td>
                </tr>
                <!-- <tr>
                    <td>Kategorija</td>
                    <td><select name="category">
                        <option value="">---</option>
                        <?php 
                                $result = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId IS null ");
                                while ($row = mysqli_fetch_array($result)){
                                    $val = $row['Type'];
                                    echo '<option value="'.$val.'">'.$val.'</option>'; }
                        ?>
                        </select>
                    </td>
                </tr> -->
                <tr>
                    <td>Vrsta proizvoda</td>
                    <td><select name="subcategory">
                        <option value="">---</option>
                            <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId = 1 OR ParentId = 2 OR ParentId = 3");
                                    while ($row = mysqli_fetch_array($result)){
                                        $val = $row['Type'];
                                        echo '<option id="select_cat" value="'.$val.'">'.$val.'</option>'; }
                            ?>
                        </select>
                    </td>
                </tr>
                <div id="ajax_select">
                <tr>
                    <td>Tip</label></td>
                        <td>
                        <select name="type_id">
                            <option value="">---</option>
                                <!-- <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId = '$temp_id'");
                                    while ($row = mysqli_fetch_array($result)){
                                        $val = $row['Type'];
                                        echo '<option value="'.$val.'">'.$val.'</option>'; }
                                ?> -->
                        </select>
                    </td>
                </tr>
                </div>
                <tr>
                    <td>Materijal</td>
                    <td><select name="material">
                        <option value="">---</option>
                        <!-- <option value="Lan">Lan</option>
                        <option value="Pamuk-lan">Pamuk-lan</option> -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Broj delova</td>
                    <td id="peacesNumber"><input type="number" name="numb_of_peaces" disabled></td>
                </tr>
                <tr>
                    <td>Cena</td>
                    <td><input type="number" name="price" value="0"></td>
                </tr>
                <tr>
                    <td>Opis</td>
                    <td><textarea rows="3"  name ="description"></textarea></td>
                </tr>
                <tr>
                    <td>Sniženo od</td>
                    <td><input type="date" name="on_sale_from"></td>
                </tr>
                <tr>
                    <td>Sniženo do</td>
                    <td><input type="date" name="on_sale_to"></td>
                </tr>
                <tr>
                    <td>Objavljeno</td>
                    <td><input type="checkbox" name="published" value="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Sačuvaj"></td>
                </tr>
            </table>      
        </form>
    </div>
    <span id="close_btn"><a href="admin.php"><u>Povratak na stranu sa proizvodima</u></a></span>;

</section>
<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>


<script>  
$(document).ready(function(){  
    $('#new_entry_form').on('change', function(e){  
           e.preventDefault();  
           var myForm = document.getElementById('new_entry_form');
           $.ajax({  
                url:"ajaxSelect.php",  
                type:"POST",  
                data:new FormData(myForm),  
                contentType:false,  
                processData:false,  
                success:function(data) {  
                    $('select[name="type_id"]').html($(data).filter('#response1').html());
                    $('select[name="material"]').html($(data).filter('#response2').html());
                    $('#peacesNumber').html($(data).filter('#response3').html());

                }  
            }); 
    });

    
});  
</script>


</body>
</html>