<?php
    $myCount = $_POST['newCount'];
    $myTable = $_POST['newTable'];
    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
    $result = mysqli_query($conn, "SELECT * FROM $myTable LIMIT $myCount");
    while ($row = mysqli_fetch_array($result))
    {
        print '<div class = "image">';
        print '<a href="addToCart.php?id='.$row['Id'].'"><img src="'.$row["ImgPath"].'" alt="primer4"></a>';
        print '<span class="caption">'.$row["Name"].'</span>';
        print '</div>';
    }
?>