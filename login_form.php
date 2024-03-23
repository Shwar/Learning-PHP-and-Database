<?php

@include 'config.php';
@include 'login_form.php';

session_start();

if (isset($_POST['submit'])) {


    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

  $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

  $result = mysqli_query($conn,$select);

  if (mysqli_num_rows($result) > 0) {

   $row = mysqli_fetch_array($result);

   if ($row['user_type'] == 'admin') {
    $_SESSION['admin_name'] = $row['name'];
    header('location:admin_page.php');
    # code...
   }
else if ($row['user_type'] == 'user'){
    $_SESSION['admin_name'] = $row['name'];
    header('location:user_page.php');

}

}else {
    $error[] ='Incorrect Email or Password';
}
};


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <div class="form-container">

    <form action="" method="POST">
        <h3>Login Now</h3>
        <?php
   if (isset($error)) {
    foreach ($error as $error){
        echo ('<span class="error-msg">'.$error.'</span>');
    };
   };
?>
        <input type="email" name="email" id="email" required placeholder="Enter your email address">
        <input type="password" name="password" id="" placeholder="Enter password" required>
        <input type="submit" name="submit"  class="form-btn" value="Login now">
        <p>Don"t have an account? <a href="register_form.php">Register Now</a></p>
    </form>
    </div>
    
</body>
</html>