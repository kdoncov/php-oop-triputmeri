<?php  
    session_start(); //starts the session
    if($_SESSION['user'] == 'admin'){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }

    $temp = $_GET['id'];

    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");

    

    //==============upload images ==============
    if(isset($_FILES['fileToUpload'])) {

        $extension = explode(".", $_FILES['fileToUpload']['name']);  
        $extension = end($extension);  
        $allowed_type = array("jpg", "jpeg", "png", "gif");  

        if(in_array($extension, $allowed_type)) {

            $new_name = rand() . "." . $extension;  
            $path = "images/" . $new_name;  
            
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path)){

                mysqli_query($conn,"INSERT INTO images (ProductId, ImagePath) VALUE ('$temp', '$path')" ); //SQL query
                $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp' AND IsCover = 1");
                if(mysqli_num_rows($result) == 0){
                    mysqli_query($conn, "UPDATE images SET IsCover = 1 WHERE ProductId = '$temp'");
                } 
            }  //pitati anu--ok
        } 
        else 
        {  
            echo '<script>alert("Invalid File Formate")</script>';  
        }  

    }  
    /* else 
    {  
        echo '<script>alert("Please Select File")</script>';  
        header("location: editProduct.php?id='.$temp.'");
    }   */

//=====================remove photo==============================
    if(isset($_GET['remove'])){

        $conn = mysqli_connect("localhost", "root", "") or die(mysql_error()); //connect to server
        $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database"); //Connect to database
        $id = $_GET['remove'];
        
        $sql = mysqli_query($conn, "SELECT * FROM images WHERE Id='$id'");
        $row = mysqli_fetch_array($sql);
        $file = $row['ImagePath'];
        unlink($file);
        mysqli_query($conn, "DELETE FROM images WHERE Id='$id'");
//ovo ispod sam dodao - pitati (ako obrisem cover photo da se postavi prva slika za cover)
        $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp' AND IsCover = 1");
                if(mysqli_num_rows($result) == 0){
                    $resultId = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp'");
                    if($rowCover = mysqli_fetch_array($resultId)){
                        $cover = $rowCover['Id'];
                        mysqli_query($conn, "UPDATE images SET IsCover = 1 WHERE Id = '$cover'");
                    } 
                }
    }

//====================set cover==================================

    if(isset($_GET['setcover'])){

        $conn = mysqli_connect("localhost", "root", "") or die(mysql_error()); //connect to server
        $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database"); //Connect to database
        $id = $_GET['setcover'];

        mysqli_query($conn, "UPDATE images SET IsCover = null WHERE ProductId = '$temp'"); //=== da li moze drugacije
        mysqli_query($conn, "UPDATE images SET IsCover = 1 WHERE Id = '$id'");

        /* $sql = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp' AND IsCover = 1 ") ;
                $row = mysqli_fetch_array($sql);
                $imgpath = $row['ImagePath'];
                mysqli_query($conn, "UPDATE product SET ImgPath = '$imgpath' WHERE Id = '$temp' " ); */
    }

    //================rezultat==========================================

    $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$temp'");
    
    echo    '<form id="submit_form" action="addPhotos.php" method="POST" enctype="multipart/form-data"> 
                <div  class="product_images">
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
    
 ?>







 <script>  
 $(document).ready(function(){ 

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
                success:function(ww)  
                {  
                     $('#wrapDiv-pill').html(ww);  
                     //$('#inputfile').val('');  
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
                success:function(data)  
                {  
                     $('#wrapDiv-pill').html(data); 
                }  


          })
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
                success:function(e)  
                {  
                     
                     //$('#'+imgId).attr(checked,'checked');
                     $('#wrapDiv-pill').html(e); 
                }  
           }); 
    });  
    
      
 });  



 </script>
 