

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
        'username' => array(
          'required' => true,
          'min' => 2,
          'max' => 20,
          'unique' => 'users'
        ),
        'password' => array(
          'required' => true,
          'min' => 6
        ),
        'password_again' => array(
          'required' => true,
          'matches' => 'password'
        ),
        'name' => array(
          'required' => true,
          'min' => 2,
          'max' => 50
        )
      ));

      if ($validation->passed()) {
          //echo "Passed!";
          //Session::flash('success', 'You registered successfully!');
          //header('Location: index.php');
          $user = new User();
          try {

            $salt = Hash::salt(32);

            //echo "<meta charset='utf-8'><pre>";
            //print_r($salt);
            //echo "</pre>";

            //die();

            $user->create(array(
              'username' => Input::get('username'),
              'password' => Hash::make(Input::get('password'), $salt),
              'salt' => $salt,
              'name' => Input::get('name'),
              'joined' => date('Y-m-d H:i:s'),
              'group' => 1
              //'' => '',
            ));

            Session::flash('home', 'You have been registered and can now log in!');
            //header('Location: index.php');
          

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
        <!-- <form action="" method="POST"> *******moja forma izbačena************
            <label for="name">Username</label><br>
            <input type="text" name="name" required="required" /><br>
            <label for="email">Email address</label><br>
            <input type="email" name="email" required="required" /><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required="required" /><br>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" value="REGISTER"/><span>or</span><a href="index.php">Return to Store</a><br>
            <span>Already have an account?</span> <a href="login.php">Login</a>
        </form> -->
        <form class="" action="" method="post">
  <div class="field form-group">
    <label for="name">Your Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name" autocomplete="off">
  </div>

  <div class="field form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo escape(Input::get('username')); ?>" id="username" autocomplete="off">
  </div>

  <div class="field form-group">
    <label for="password">Choose a password</label>
    <input type="password" class="form-control" name="password" value="" id="password" autocomplete="off">
  </div>

  <div class="field form-group">
    <label for="password_again">Enter your password again</label>
    <input type="password" class="form-control" name="password_again" value="" id="password_again" autocomplete="off">
  </div>
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" value="REGISTER"/><span>or</span><a href="index.php">Return to Store</a><br>
    <span>Already have an account?</span> <a href="login.php">Login</a>

</form>
    </div>
</div>

<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>

</body>
</html>