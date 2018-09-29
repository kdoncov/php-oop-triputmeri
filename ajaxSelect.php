<?php

    session_start(); //starts the session
    if($_SESSION['user'] == 'admin'){ //checks if user is logged in
    }
    else {
       header("location:index.php"); //redirects if user is not logged in.
    }


    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subcat = $_POST['subcategory'];
        $type = $_POST['type_id'];
        $material = $_POST['material'];
        $numb = $_POST['numb_of_peaces'];
        

        $sql = mysqli_query($conn, "SELECT * FROM product_type WHERE Type = '$subcat'");
        $row = mysqli_fetch_array($sql);
        $temp_id = $row['Id'];
?>
        <div id="response1">
                <option value="">---</option>
                    <?php 
                        $result = mysqli_query($conn, "SELECT * FROM product_type WHERE ParentId = '$temp_id'");
                        while ($row = mysqli_fetch_array($result)){
                            $val = $row['Type'];
                            if($val == $type){
                                $select = 'selected'; 
                            } else {
                                $select = ''; 
                            }
                            echo '<option value="'.$val.'" '.$select.'>'.$val.'</option>'; }
                    ?>

        </div>
        <div id="response2">
                <option value="">---</option>
                <?php 
                if($subcat != 'Kutija za recepte'){
                
                $materials = array('Lan', 'Pamuk-lan'); 
                                    foreach ($materials as $value) {
                                        if ($value == $material){
                                                $select = "selected";} 
                                            else {
                                                $select = "";
                                            }
                                    echo '<option value="'.$value.'" '.$select.'>'.$value.'</option>'; }
                                        } 
                ?>    
        </div>

        <div id="response3">
            <?php
                $allowed_products = array("Set za rucavanje", "Podmetaci za rucavanje", "Podmetaci za case");  

                if(in_array($subcat, $allowed_products)){
                    echo '<input type="number" name="numb_of_peaces" placeholder="od 1 do 8" min="1" max="8" value='.$numb.'>';
                    } else {
                        echo '<input type="number" name="numb_of_peaces" disabled>';
                    }
            ?>
        </div>
            
                    
<?php } ?>



