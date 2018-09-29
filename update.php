<?php
session_start();
$temp = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");

    $sql = mysqli_query($conn, "SELECT * FROM product WHERE Id = '$temp'");
    $row = mysqli_fetch_array($sql);
    $published_on=$row['PublishedOn'];
    
    $current_date = date('Y/m/d');
    $add_name = mysqli_real_escape_string($conn, $_POST['name']);
    $add_tipeid = mysqli_real_escape_string($conn, $_POST['type_id']);
    $add_price = mysqli_real_escape_string($conn, $_POST['price']);
    $add_desc = mysqli_real_escape_string($conn, $_POST['description']);
    $add_on_sale_from = mysqli_real_escape_string($conn, $_POST['on_sale_from']);
    $add_on_sale_to = mysqli_real_escape_string($conn, $_POST['on_sale_to']);
    $add_material = mysqli_real_escape_string($conn, $_POST['material']);
    //$add_category = mysqli_real_escape_string($conn, $_POST['category']);
    $add_subcat = mysqli_real_escape_string($conn, $_POST['subcategory']);
    if(isset($_POST['numb_of_peaces'])){
        $add_numb_of_peaces = $_POST['numb_of_peaces'];
    } else {$add_numb_of_peaces = 0;}

    if(isset($_POST['published'])){
        $publish = 1;
        if ($published_on == 0){
            $published_on = date('Y/m/d H:i:s');
        }
    } else {
        $publish = null;
    }
    

            $sql1 = mysqli_query($conn, "SELECT * FROM product_type WHERE Type = '$add_subcat'");
                    $row1 = mysqli_fetch_array($sql1);
                    $result = $row1['ParentId'];
            $sql2 = mysqli_query($conn, "SELECT * FROM product_type WHERE Id = '$result'");
                    $row2 = mysqli_fetch_array($sql2);
                    $add_category = $row2['Type'];

    mysqli_query($conn, "UPDATE product 
    SET Name ='$add_name',  
        TypeId = '$add_tipeid',
        Price ='$add_price',
        Description ='$add_desc',
        OnSaleFromDate ='$add_on_sale_from',
        OnSaleToDate ='$add_on_sale_to',
        Material ='$add_material',
        Category = '$add_category',
        Subcategory ='$add_subcat',
        NumberOfPeaces ='$add_numb_of_peaces',
        ModifiedOn = '$current_date',
        PublishedOn = '$published_on',
        IsPublished = '$publish'
    WHERE Id=$temp");
    Print '<script>location.assign("editProduct.php?id='.$temp.'");</script>';

    }
?>