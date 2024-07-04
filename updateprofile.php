<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:home.php');
}

if(isset($_POST['update_profile'])){
   $fetch_image_query = mysqli_query($conn, "SELECT image FROM user_form WHERE id = '$user_id'");
   $fetch = mysqli_fetch_assoc($fetch_image_query);
   $old_image = $fetch['image'];
    
   $update_first_name = mysqli_real_escape_string($conn, $_POST['update_first_name']);
   $update_last_name = mysqli_real_escape_string($conn, $_POST['update_last_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_matric_no = mysqli_real_escape_string($conn, $_POST['update_matric_no']);

   mysqli_query($conn, "UPDATE `user_form` SET f_name = '$update_first_name', l_name = '$update_last_name', matric_no = '$update_matric_no', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'Old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'Password updated successfully!';
         header('location:userhomepage.php'); 
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image is too large!';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
          
         if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
                unlink('uploaded_img/' . $old_image);
         }
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
          
         $message[] = 'Image updated successfully!';
         header('location:userhomepage.php'); 
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile Update</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Update Profile</h3>
      <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                };
            };
      ?> 
      <p>First Name</p>
      <input type="text" name="update_first_name" placeholder="Enter your first name" value="<?php echo $fetch['f_name']; ?>" class="box">
      <p>Last Name</p>
      <input type="text" name="update_last_name" placeholder="Enter your last name" value="<?php echo $fetch['l_name']; ?>" class="box"> 
      <p>Email</p>
      <input type="email" name="update_email" placeholder="Enter your new email" value="<?php echo $fetch['email']; ?>" class="box">
      <p>Matric Number</p>
      <input type="text" name="update_matric_no" placeholder="Enter your new matric number" value="<?php echo $fetch['matric_no']; ?>" class="box">
      <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>"> 
      <p>Previous Password</p>
      <input type="password" name="update_pass" placeholder="Enter your previous password" class="box">
      <p>New Password</p>
      <input type="password" name="new_pass" placeholder="Enter your new password" class="box">
      <p>Confirm password</p>
      <input type="password" name="confirm_pass" placeholder="Confirm your new password" class="box">
      <p>Update Picture</p>
      <input type="file" name="update_image" accept="image/*" class="box">
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
   </form>

</section>

<footer class="footer">

   &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!

</footer>

<script src="js/script.js"></script>

</body>
</html>