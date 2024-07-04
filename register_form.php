<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
   $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $matricNo = mysqli_real_escape_string($conn, $_POST['matric_no']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = " SELECT * FROM user_form WHERE email = '$email' OR matric_no = '$matricNo' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $message[] = 'User already exist!';

   } else {
       
      $namePattern = "/^[a-zA-Z ]+$/";
       
      $message = array();

      if (!preg_match($namePattern, $fname)) {
         $message[] = 'Invalid first name!';
      }

      if (!preg_match($namePattern, $lname)) {
         $message[] = 'Invalid last name!';
      }
       
      if($pass != $cpass){
          
         $message[] = 'Password not matched!';
          
      } elseif($image_size > 2000000) {
          
         $message[] = 'Image size is too large!';
          
      } elseif (empty($message)) {
          
         $insert = "INSERT INTO user_form(f_name, l_name, email, matric_no, password, image) VALUES('$fname', '$lname', '$email', '$matricNo', '$pass', '$image')";
         mysqli_query($conn, $insert);
          if($insert) {
              
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location:login_form.php');
              
          } else {
              
            $message[] = 'Registeration failed!';
              
          }
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Register Form</title>
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
                  <h3>REGISTER</h3>
                  <?php
                  if(isset($message)){
                     foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                     };
                  };
                  ?>
                  <input type="text" name="f_name" required placeholder="Enter your first name">
                  <input type="text" name="l_name" required placeholder="Enter your last name">
                  <input type="email" name="email" required placeholder="Enter your email">
                  <input type="text" name="matric_no" required placeholder="Enter your matric number">
                  <input type="password" name="password" required placeholder="Enter your password">
                  <input type="password" name="cpassword" required placeholder="Confirm your password">     
                  <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                  <input type="submit" name="submit" value="Register now" class="form-btn">
                  <p>Already have an account? <a href="login_form.php">Login Now</a></p>
               </form>

            </div>
        </section>
    </body>
</html>