

<?php
// Core Initialization
require_once 'core/init.php';

//var_dump(Token::check(Input::get('token')));

  if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
      //echo "Submitted!";
      //echo Input::get('username');
      //echo Input::get('password');
      //echo Input::get('password_again');
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'name' => array(
          'required' => true,
          'min' => 2,
          'max' => 20,
          'unique' => 'users'
        ),
        'email' => array(
          'required' => true,
          'min' => 6
        ),
        'password' => array(
          'required' => true,
          'min' => 6
        )
      ));

      if ($validation->passed()) {
          //echo "Passed!";
          //Session::flash('success', 'You registered successfully!');
          //header('Location: index.php');
          $user = new User();
          try {

            //$salt = Hash::salt(32);

            //echo "<meta charset='utf-8'><pre>";
            //print_r($salt);
            //echo "</pre>";

            //die();

            $user->create(array(
              'username' => Input::get('name'),
              'password' => Hash::make(Input::get('password')),
              //'' => '',
            ));

            Session::flash('home', 'You have been registered and can now log in!');
            //header('Location: index.php');
            Redirect::to(404); // 'index.php'

          } catch (Exception $e) {
            die($e->getMessage());
          }

      } else {
        //print_r($validation->errors());
        foreach ($validation->errors() as $error) {
          echo $error, '<br>';
        }
      }

    } // fim segundo if
  } // fim primeiro if
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


<div class="login_form">
        <h1>Customer Registration</h1>
    <div class="group">
        <form action="" method="POST">
            <label for="name">Username</label><br>
            <input type="text" name="name" required="required" /><br>
            <label for="email">Email address</label><br>
            <input type="email" name="email" required="required" /><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required="required" /><br>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
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


<!-- <?php
        
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
    ?> -->
</body>
</html>