<?php session_start();
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

if(isset($_GET['id'])){

    $temp = $_GET['id']; //product id
    /* }
    else {
        $temp='';
    } //product id  */
    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
    $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp'");
    $sql = mysqli_query($conn, "SELECT * FROM product WHERE Id = '$temp'");
    $row = mysqli_fetch_array($sql);
    $subcat = $row['Subcategory'];
    $val_type = $row['TypeId'];
    $numb = $row['NumberOfPeaces'];
    $modified = date('Y/m/d');
    if($row['IsPublished'] == 1){
        $checked = 'checked';
    } else {
        $checked = '';
    }
    

        echo    '<div class="col-6 padd-60">
                <form id="edit_form" class="product_form" action="update.php?id='.$temp.'" method="POST">
                    <table>
                        <tr>
                            <td>Naziv</td>
                            <td><input type="text" name="name" value="'.$row['Name'].'" required></td>
                        </tr>
                        
                        <tr>
                            <td>Vrsta proizvoda</td>
                            <td><select name="subcategory">
                                <option value="">---</option>';
                                    $sql_sub = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId = 1 OR ParentId = 2 OR ParentId = 3 ");
                                    while ($row_sub = mysqli_fetch_array($sql_sub)){
                                        $val = $row_sub['Type'];
                                        if($val == $row['Subcategory']){
                                            $select = 'selected'; 
                                        } else {
                                            $select = ''; 
                                        }
                                    echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>'; }
                                echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tip</td>
                            <td><select name="type_id">
                                <option value="">---</option>';
                                
                                    $sql_type = mysqli_query($conn, "SELECT * FROM product_type WHERE Type = '$subcat' ");
                                    $row_id = mysqli_fetch_array($sql_type);
                                        $product_type_id = $row_id['Id'];
                                        $sql_type_id = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId = '$product_type_id'");
                                            while ($row_type = mysqli_fetch_array($sql_type_id)){
                                                $val = $row_type['Type'];
                                                if($val == $row['TypeId']){
                                                    $select = 'selected'; 
                                                } else {
                                                    $select = ''; 
                                                }
                                            echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>'; }
                                echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Materijal</td>
                            <td><select name="material">
                                <option value="">---</option>';
                                    $materials = array('Lan', 'Pamuk-lan'); 
                                    foreach ($materials as $val) {
                                        if ($val == $row['Material']){
                                                $select = "selected";} 
                                            else {
                                                $select = "";
                                            }
                                    echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>'; }
                                echo '</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Broj delova</td>
                            <td id="peacesNumber">';
                                    $allowed_products = array("Set za rucavanje", "Podmetaci za rucavanje", "Podmetaci za case");  
                                    if(in_array($subcat, $allowed_products)){
                                        echo '<input type="number" name="numb_of_peaces" placeholder="od 1 do 8" min="1" max="8" value='.$numb.'>';
                                    } else {
                                        echo '<input type="number" name="numb_of_peaces" disabled>';
                                    }
                        echo '</td>          
                        </tr>
                        <tr>
                            <td>Cena</td>
                            <td><input type="number" name="price" value="'.$row['Price'].'"></td>
                        </tr>
                        <tr>
                            <td>Opis</td>
                            <td><textarea rows="3"  name ="description" >'.$row['Description'].'</textarea></td>
                        </tr>
                        <tr>
                            <td>Sniženo od</td>
                            <td><input type="date" name="on_sale_from" value="'.$row['OnSaleFromDate'].'"></td>
                        </tr>
                        <tr>
                            <td>Sniženo do</td>
                            <td><input type="date" name="on_sale_to" value="'.$row['OnSaleToDate'].'"></td>
                        </tr>
                        <tr>
                            <td>Objavljeno</td>
                            <td><input type="checkbox" name="published" '.$checked.'></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Sačuvaj"></td>
                        </tr>
                    </table>      
                </form>
                </div>';

        echo    '<div class="col-6 padd-60">';    
        echo    '<div id="wrapDiv-pill" class="scroll">';  
                                    
        echo    '<form id="submit_form" action="addPhotos.php" method="POST" enctype="multipart/form-data"> 
                    <div class="product_images">
                        <div class="upload-btn-wrapper">
                            <button class="upload_btn">Add photos</button>
                            <input type="file" name="fileToUpload" id="inputfile">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="ok" id="addImg">
                </form>';

                while ($row = mysqli_fetch_array($result)){
                    if($row['IsCover']==1){
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }

                echo    '<div  class="product_images">    
                            <img src="'.$row['ImagePath'].'" alt="primer">   
                            <button type="button" id ="'.$row['Id'].'" class="remove_button" title="Remove image">x</button>
                            <input  type="radio" '.$checked.' name="setCover" id="'.$row['Id'].'" class="set_cover" title="Set cover photo">
                        </div>';
                }
        echo    '</div>'; 
        echo    '</div>'; 
        echo    '<span id="close_btn"><a href="addNewEntry.php"> <u> Dodavanje novog proizvoda</u></a> | <a href="admin.php"><u>Povratak na stranu sa proizvodima</u> </a></span>';
}
else {
    header("location:admin.php");
}

?>

</section>
<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>

<script>  
$(document).ready(function(){  

 $('#edit_form').on('change', function(e){  
           e.preventDefault();  
           var myForm = document.getElementById('edit_form');
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

    $('#submit_form').on('change', function(e){  
           e.preventDefault();  
           var myForm = document.getElementById('submit_form');
           $.ajax({  
                url:"addPhotos.php?id=<?php echo $temp?>",  
                type:"POST",  
                data:new FormData(myForm),  
                contentType:false,  
                //cache:false,  
                processData:false,  
                success:function(ww) {  
                    $('#wrapDiv-pill').html(ww); 
                }  
            }); 
    });

    $('.set_cover').click(function(){  
        var imgId = $(this).attr('id');
           $.ajax({  
                url:"addPhotos.php?id=<?php echo $temp?>&setcover="+imgId,  
                type:"GET",  
                //data:new FormData(myFormCover),  
                contentType:false,  
                //cache:false,  
                processData:false,  
                success:function(e) {  
                    $('#wrapDiv-pill').html(e);  
                }  
            }); 
    });

    $(".remove_button").click(function() {
        var imgId = $(this).attr('id');
            $.ajax({
                url: "addPhotos.php?id=<?php echo $temp?>&remove="+imgId,
                type: "GET",
                //data:{remove:imgId},
                contentType:false,
                processData:false, 
                success:function(data) {  
                    $('#wrapDiv-pill').html(data); 
                } 
            })
    });   
});  
</script>  
</body>
</html>