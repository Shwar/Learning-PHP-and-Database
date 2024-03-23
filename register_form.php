<?php

@include 'config.php';

if (isset($_POST['submit'])) {


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $hashed_pass = md5($pass);
    $cpass = $_POST['cpass'];
    $hashed_cpass = md5($cpass);
    $user_type = $_POST['user-type'];

  $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

  $result = mysqli_query($conn,$select);

  if (mysqli_num_rows($result) > 0) {
    $error []= 'User already exist';


}else {
 if ($pass != $cpass) {
    $error []= 'Password does not match';

    # code...
 }else{
    $insert = "INSERT INTO user_form (name,email,password,user_type) VALUES ('$name', '$email','$pass','$user_type')";

    mysqli_query($conn, $insert);
    header('location:login_form.php');
 }
}

    
    # code...
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>
    <div class="form-container">

    <form action="" method="POST">
        <h3>Register now</h3>

        <input type="text" name="name" required placeholder="Enter your name">
        <input type="email" name="email" id="email" required placeholder="Enter your email address">
        <input type="password" name="password" id="" placeholder="Enter password" required>
        <input type="password" name="cpass" id="" required placeholder="Confirm password">
        <select name="user-type" id="">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" name="submit"  class="form-btn" value="Register now">
        <p>Already have an account? <a href="login_form.php">Login Now</a></p>
    </form>
    </div>
    
</body>
</html>