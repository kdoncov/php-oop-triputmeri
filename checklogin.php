<?php
    session_start();
    $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
    $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $query = mysqli_query($conn, "SELECT * FROM customer WHERE Email='$username' OR Name='$username'"); // Query the users table 
    $exists = mysqli_num_rows($query); //Checks if username exists
    
    if($exists > 0) {

        $row = mysqli_fetch_assoc($query);
        $dehashing_pwd = password_verify($password, $row['Password']);

        if($dehashing_pwd == false){
            echo '<script>alert("Incorrect password!");</script>'; // Prompts the user
            echo '<script>window.location.assign("login.php");</script>'; // redirects to login.php
        }
        elseif($dehashing_pwd == true){
            $_SESSION['user'] = $row['Name']; //set the username in a session. This serves as a global variable
            header("location: admin.php"); // redirects the user to the authenticated home page
        }
        

    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
    /* if($exists > 0) {
        while($row = mysqli_fetch_assoc($query)) { //proveriti ovo da li treba while
            $table_email = $row['Email'];
            $table_password = $row['Password'];
            $username = $row['Name'];
        }
        if(($email == $table_email) && ($password == $table_password)) {

            if (($email == "admin") && ($password == "admin")){
                $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
                header("location: admin.php"); // redirects the user to the authenticated home page
                }
            else 
            {
            $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
            header("location: index.php"); // redirects the user to the authenticated home page
                }     
        } 
            else
            {
            Print '<script>alert("Incorrect password!");</script>'; // Prompts the user
            Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
            }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    } */
?>