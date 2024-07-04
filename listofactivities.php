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
   <title>List of Activities</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
   <link rel="stylesheet" href="css/tablestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="user-profile">

<h1 class="heading">List of Activities</h1>

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
                                    <th>List of Activities</th>
                                    <th>Category</th>
                                    <th>Remarks</th>
                                    <th>Photos</th>
                                  </tr>
                              </thead>
                              <tbody>
                                    <?php
                                    $tableNames = array("activities_form", "certifications_form", "competitions_form");
                                    $numrow = 1;
                                    $allTablesEmpty = true;
                                    foreach ($tableNames as $tableName) {
                                        $sql = "SELECT * FROM $tableName";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td data-th='NO'>" . $numrow . "</td>";

                                                if ($tableName == "activities_form") {
                                                    echo "<td data-th='SEM & YEAR'>" . $row["sem"] . " " . $row["year"] . "</td>";
                                                    echo "<td data-th='LIST OF ACTIVITIES'>" . $row["activities"] . "</td>";
                                                    echo "<td data-th='CATEGORY'>Activity</td>";
                                                    echo "<td data-th='REMARKS'>" . $row["remarks"] . "</td>";
                                                    echo "<td data-th='PHOTOS'>" . $row["image"] . "</td>";
                                                } elseif ($tableName == "competitions_form") {
                                                    echo "<td data-th='SEM & YEAR'>" . $row["sem"] . " " . $row["year"] . "</td>";
                                                    echo "<td data-th='LIST OF ACTIVITIES'>" . $row["competitions"] . "</td>";
                                                    echo "<td data-th='CATEGORY'>Competition</td>";
                                                    echo "<td data-th='REMARKS'>" . $row["remarks"] . "</td>";
                                                    echo "<td data-th='PHOTOS'>" . $row["docs"] . "</td>";
                                                } elseif ($tableName == "certifications_form") {
                                                    echo "<td data-th='SEM & YEAR'>" . $row["sem"] . " " . $row["year"] . "</td>";
                                                    echo "<td data-th='LIST OF ACTIVITIES'>" . $row["certifications"] . "</td>";
                                                    echo "<td data-th='CATEGORY'>Certification</td>";
                                                    echo "<td data-th='REMARKS'>" . $row["remarks"] . "</td>";
                                                    echo "<td data-th='PHOTOS'>" . $row["docs"] . "</td>";
                                                }
                                                
                                                echo "</tr>" . "\n\t\t";
                                                $numrow++;
                                                $allTablesEmpty = false;
                                            }
                                        }
                                        
                                    } 
                                  
                                    if($allTablesEmpty) {
                                            echo "<tr><td colspan='6'>0 results</td></tr>";
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
    
<footer class="footer">

   &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!

</footer>

<script src="js/script.js"></script>

</body>
</html>