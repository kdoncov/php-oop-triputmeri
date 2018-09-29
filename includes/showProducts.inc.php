<?php
    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");

    if(isset($_GET['category'])){
        $category = $_GET['category'];
        $selectID = mysqli_query($conn, "SELECT * FROM product WHERE Category = '$category' AND UserDeleted IS NULL AND IsPublished = 1");
        if(isset($_GET['subcategory'])){
            $subcat = $_GET['subcategory'];
            $selectID = mysqli_query($conn, "SELECT * FROM product WHERE Category = '$category' AND Subcategory = '$subcat' AND UserDeleted IS NULL AND IsPublished = 1");
            if(isset($_GET['numb'])){
                $numb = $_GET['numb'];
                $selectID = mysqli_query($conn, "SELECT * FROM product WHERE Category = '$category' AND Subcategory = '$subcat' AND NumberOfPeaces = $numb AND UserDeleted IS NULL AND IsPublished = 1");
            }   
            elseif(isset($_GET['material'])){
                    $mat = $_GET['material'];
                    $selectID = mysqli_query($conn, "SELECT * FROM product WHERE Category = '$category' AND Subcategory = '$subcat' AND Material = '$mat' AND UserDeleted IS NULL AND IsPublished = 1");
                }
            elseif(isset($_GET['type'])){
                $length = $_GET['type'];
                $selectID = mysqli_query($conn, "SELECT * FROM product WHERE Category = '$category' AND Subcategory = '$subcat' AND TypeId = '$length' AND UserDeleted IS NULL AND IsPublished = 1");
            }
            
        }
    }
    
    
    
            while ($row = mysqli_fetch_array($selectID)) {

                $tempId = $row['Id'];
                $sql = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$tempId' AND IsCover = 1");
                $rowImg = mysqli_fetch_array($sql);
                    echo '<div class = "image">';
                    echo '<a href="addToCart.php?id='.$tempId.'"><img src="'.$rowImg['ImagePath'].'" alt="primer4"></a>';
                    echo '<span class="caption">'.$row['Name'].'</span>';
                    echo '</div>';
            }
?>