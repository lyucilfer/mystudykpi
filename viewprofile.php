<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login_form.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile View</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
   <link rel="stylesheet" href="css/usertablestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="user-profile">

<h1 class="heading">Portfolio</h1>

   <div class="info">

      <div class="user">
         <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="img/default-avatar.png" class="image" alt="">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'" class="image" alt="">';
         }
         ?>
         <h3 class="name"><?php echo $fetch['f_name']; echo " "; echo $fetch['l_name']; ?></h3>
         <a href="updateprofile.php" class="inline-btn">Update Profile</a>
      </div>       
       
      <div class="box-container">
   
         <div class="box">
            <div class="flex">
                  <section class="table-section">
                      <div class="container">
                        <div class="table-wrapper">
                          <table class="table">
                              <tr>
                                <td>Name</td>
                                <td><?php echo $fetch['f_name']; echo " "; echo $fetch['l_name']; ?> </td>
                              </tr>
                              <tr>
                                <td>Matric No.</td>
                                <td><?php echo $fetch['matric_no']; ?></td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td><?php echo $fetch['email']; ?></td>
                              </tr>
                              <tr>
                                <td>Mentor Name</td>
                                <td>-</td>
                              </tr>
                          </table>
                        </div>
                      </div>
                  </section>
               </div>
            </div>
          
       </div>
       
   </div>

</section>
    
<footer class="footer">

   &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!

</footer>

<script src="js/script.js"></script>

</body>
</html>