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
        <h1>Customer Login</h1>
    <div class="group">
        <form action="checklogin.php" method="POST">
            <label for="username">Username or email address</label><br>
            <input type="text" name="username" required="required" autofocus/><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required="required" /><br>
            <input type="submit" value="LOGIN"/><span>or</span><a href="index.php">Return to Store</a><br>
            <span>Don't have an account yet?</span> <a href="register.php">Sign up</a>.
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