<?php
    session_start(); //starts the session
    if($_SESSION['user']){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }

    if(isset($_GET['remove']))
        {
        $conn = mysqli_connect("localhost", "root", "") or die(mysql_error()); //connect to server
        $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database"); //Connect to database
        $id = $_GET['remove']; //product Id
    
        mysqli_query($conn, "UPDATE product SET UserDeleted = 1 WHERE Id='$id'");
        /* $result = mysqli_query($conn, "SELECT * FROM images WHERE ProductId = '$id'");
        while($row = mysqli_fetch_array($result)){
                $file = $row['ImagePath'];
                unlink($file);
        }
                mysqli_query($conn, "DELETE FROM images WHERE ProductId='$id'"); */
       
        header("location:admin.php");
        }
       
?>