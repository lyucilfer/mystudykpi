<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
   $identifier = mysqli_real_escape_string($conn, $_POST['identifier']);
   $pass = md5($_POST['password']);

   $select = mysqli_query($conn, " SELECT * FROM user_form WHERE (email = '$identifier' OR matric_no = '$identifier') && password = '$pass' ") or die('query failed');

   if(mysqli_num_rows($select) > 0){
       
       $row = mysqli_fetch_assoc($select);
       $_SESSION['user_id'] = $row['id'];
       header('location:userhomepage.php');
     
   } else {
       
       $message[] = 'Incorrect email/matric number or password OR User does not exist!';
       
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login_register_style.css">
</head>
    
<body>
<section class = "main">
    <nav>
        <a href = "home.php" class = "logo">
                    <img src = "img/logo.png"
                         width = auto
                         height = "105" />
        </a>
    </nav>
    <div class="form-container">
        
       <form action="" method="post" enctype="multipart/form-data">
          <h3>LOGIN</h3>
          <?php
          if(isset($message)){
             foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
             };
          };
          ?>
          <input type="text" name="identifier" required placeholder="Enter your email/matric number">
          <input type="password" name="password" required placeholder="Enter your password">
          <input type="submit" name="submit" value="login now" class="form-btn">
          <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
       </form>

    </div>
</section>
</body>
</html>