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

if(isset($_POST['submit_competition'])){

   $sem = mysqli_real_escape_string($conn, $_POST['sem']);
   $year = mysqli_real_escape_string($conn, $_POST['year']);
   $competitions = mysqli_real_escape_string($conn, $_POST['competitions']);
   $competition_dates = mysqli_real_escape_string($conn, $_POST['competition_dates']);
   $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

   $docs = $_FILES['docs']['name'];
   $docs_size = $_FILES['docs']['size'];
   $docs_tmp_name = $_FILES['docs']['tmp_name'];
   $docs_folder = 'uploaded_img/'.$image;
    
   $yearPattern = "/^\d{4}\/\d{4}$/";
   $datePattern = "/^\d{2}\/\d{2}\/\d{4}$/";
    
   $check_user_form_query = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
   if(mysqli_num_rows($check_user_form_query) > 0) {
       
       if(!preg_match($yearPattern, $year)) {
           $message[] = 'Invalid year format! Please use YYYY/YYYY';
       }
       
       if(!preg_match($datePattern, $competition_dates)) {
           $message[] = 'Invalid date format! Please use DD/MM/YYYY';
       }

       if($image_size > 2000000) {
             $message[] = 'Document is too large!';
       } 
       
       elseif(empty($message)) {
             $insert_competitions = mysqli_query($conn, "INSERT INTO competitions_form(id, sem, year, competitions, competition_dates, remarks, docs) VALUES('$user_id', '$sem', '$year', '$competitions', '$competition_dates', '$remarks', '$docs')") or die('query failed');
             if($insert_competitions) {
                move_uploaded_file($docs_tmp_name, $docs_folder);
                $message[] = 'Competition inserted successfully!';
                header('location:competitions.php');
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
   <title>Competition Management</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
   <link rel="stylesheet" href="css/tablestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="user-profile">

<h1 class="heading">Competition Management</h1>

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
                                    <th>Name of Competitions</th>
                                    <th>Competition Dates</th>
                                    <th>Remarks</th>
                                    <th>Photos</th>
                                    <th>Action</th>  
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                        $sql = "SELECT * FROM competitions_form";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $numrow=1;
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td data-th='NO'>" . $numrow . "</td>";
                                                echo "<td data-th='SEM & YEAR'>" . $row["sem"] . " " . $row["year"] . "</td>";
                                                echo "<td data-th='NAME OF COMPETITIONS'>" . $row["competitions"] . "</td>";
                                                echo "<td data-th='COMPETITION DATES'>" . $row["competition_dates"] . "</td>";
                                                echo "<td data-th='REMARKS'>" . $row["remarks"] . "</td>";
                                                echo "<td data-th='DOCUMENTS'>" . $row["docs"] . "</td>";
                                                echo '<td data-th="ACTION"><a class="btn" href="updatelists.php?source=competitions&id=' . $row["comp_id"] . '">Edit</a>' . " " . '<a class="btn" href="delete.php?source=competitions&id=' . $row["comp_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                                                echo "</tr>" . "\n\t\t";
                                                $numrow++;
                                            }
                                        } else {
                                            echo '<tr><td colspan="7">0 results</td></tr>';
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
      <h3>Manage Your Competitions</h3>
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
      <p>Competition Name</p>
      <input type="text" name="competitions" required placeholder="Enter your competition name" class="box">
      <p>Competition Date</p>
      <input type="text" name="competition_dates" required placeholder="Enter the competition date (DD/MM/YYYY)" class="box">
      <p>Remarks</p>
      <input type="text" name="remarks" placeholder="Enter your remarks (e.g., Achievements, Awards)" class="box">
      <p>Add Your Competition Document</p>
      <input type="file" name="docs" accept="image/*" class="box">
      <input type="submit" value="Submit" name="submit_competition" class="btn">
   </form>

</section>
    
<footer class="footer">

   &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!

</footer>

<script src="js/script.js"></script>

</body>
</html>