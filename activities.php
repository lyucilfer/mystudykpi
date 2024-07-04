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

if(isset($_POST['submit_activity'])){

   $sem = mysqli_real_escape_string($conn, $_POST['sem']);
   $year = mysqli_real_escape_string($conn, $_POST['year']);
   $activity = mysqli_real_escape_string($conn, $_POST['activities']);
   $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
    
   $yearPattern = "/^\d{4}\/\d{4}$/";
    
   $check_user_form_query = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
   if(mysqli_num_rows($check_user_form_query) > 0) {
       
       if(!preg_match($yearPattern, $year)) {
           $message[] = 'Invalid year format! Please use YYYY/YYYY';
       }

       if($image_size > 2000000) {
             $message[] = 'Image is too large!';
       } 
       
       elseif(empty($message)) {
             $insert_activities = mysqli_query($conn, "INSERT INTO activities_form(id, sem, year, remarks, activities, image) VALUES('$user_id', '$sem', '$year', '$remarks', '$activity', '$image')") or die('query failed');
             if($insert_activities) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Activity inserted successfully!';
                header('location:activities.php');
             }
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
   <title>Activities Management</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
   <link rel="stylesheet" href="css/tablestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="user-profile">

<h1 class="heading">Activities Management</h1>

   <div class="info">

      <div class="box-container">
   
         <div class="box">
            <div class="flex">
                  <section class="table-section">
                      <div class="container">
                        <div class="table-wrapper">
                          <table class="table">
                              <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Sem & Year</th>
                                    <th>Name of Activities</th>
                                    <th>Remarks</th>
                                    <th>Photos</th>
                                    <th>Action</th>  
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                        $sql = "SELECT * FROM activities_form";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $numrow=1;
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td data-th='NO'>" . $numrow . "</td>";
                                                echo "<td data-th='SEM & YEAR'>" . $row["sem"] . " " . $row["year"] . "</td>";
                                                echo "<td data-th='NAME OF ACTIVITIES'>" . $row["activities"] . "</td>";
                                                echo "<td data-th='REMARKS'>" . $row["remarks"] . "</td>";
                                                echo "<td data-th='PHOTOS'>" . $row["image"] . "</td>";
                                                echo '<td data-th="ACTION"><a class="btn" href="updatelists.php?source=activities&id=' . $row["act_id"] . '">Edit</a>' . " " . '<a class="btn" href="delete.php?source=activities&id=' . $row["act_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                                                echo "</tr>" . "\n\t\t";
                                                $numrow++;
                                            }
                                        } else {
                                            echo '<tr><td colspan="6">0 results</td></tr>';
                                        } 
                                        mysqli_close($conn); 
                                  ?>
                              </tbody>
                          </table>
                        </div>
                      </div>
                  </section>
               </div>
            </div>
          
       </div>
       
   </div>

</section>
    
<section class="table-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Manage Your Activities</h3>
      <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                };
            };
      ?> 
      <p>Semester</p>
      <select size="1" name="sem" required class="box">
          <option style="color: gray;" hidden>Select your semester</option>;
          <option value="1">1</option>;
          <option value="2">2</option>;
      </select>
      <p>Year</p>
      <input type="text" name="year" required placeholder="Enter your year (YYYY/YYYY)" class="box"> 
      <p>Activity Name</p>
      <input type="text" name="activities" required placeholder="Enter your activity name" class="box">
      <p>Remarks</p>
      <input type="text" name="remarks" placeholder="Enter your remarks" class="box">
      <p>Add Your Activity Photo</p>
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="Submit" name="submit_activity" class="btn">
   </form>

</section>
    
<footer class="footer">

   &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!

</footer>

<script src="js/script.js"></script>

</body>
</html>