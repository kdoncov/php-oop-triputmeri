<?php session_start(); ?>
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

<div class="login_form">
        <h1>Customer Registration</h1>
    <div class="group">
        <form action="register.php" method="POST">
            <label for="name">Username</label><br>
            <input type="text" name="name" required="required" /><br>
            <label for="email">Email address</label><br>
            <input type="email" name="email" required="required" /><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required="required" /><br>
            <input type="submit" value="REGISTER"/><span>or</span><a href="index.php">Return to Store</a><br>
            <span>Already have an account?</span> <a href="login.php">Login</a>.
        </form>
    </div>
</div>

<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>


<?php
        
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
        $conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
        $db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $bool = true; 
        $query = mysqli_query($conn, "SELECT * FROM customer WHERE Name = '$name' OR Email = '$email' ");
        $exists = mysqli_num_rows($query); //Checks if username exists
        if($exists > 0){

            while ($row = mysqli_fetch_array($query)) {
                $table_name = $row['Name'];
                $table_email = $row['Email'];
                    if($name == $table_name){
                        Print '<script>alert("username has been taken!");</script>';
                    }
                    elseif($email == $table_email) {
                        Print '<script>alert("email has been taken!");</script>';
                        /* Print '<script>location.assign("register.php");</script>'; */
                    } 
            } 


            
        }
        
    
        else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO customer (Name, Email, Password) VALUES ('$name', '$email', '$hashedPwd')");
            Print '<script>alert("Succesfully Registered!");</script>';
            Print '<script>location.assign("login.php");</script>';
        }
    }
    ?>
</body>
</html>