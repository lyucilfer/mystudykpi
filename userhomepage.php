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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
   <link rel="stylesheet" href="css/tablestyle.css">

</head>
    
<body>

<?php include 'header_sidebar.php';?>

<section class="user-profile">
    
<h1 class="heading">MyKPI Indicator</h1>

   <div class="info">

      <div class="box-container">
   
         <div class="box">
            <div class="flex">
                  <section class="table-section">
                      <div class="container">
                        <div class="table-wrapper">
                          <table class="table">
                              <tr>
                                <th>No</th>
                                <th>Indicator</th>
                                <th>Faculty KPI</th>
                                <th>My KPI</th>
                                <th>1 2021/2022</th>
                                <th>2 2021/2022</th>
                                <th>Remarks</th>
                              </tr>
                              <tr>
                                <td align="center">1</td>
                                <td>CGPA</td>
                                <td align="center">>=3.0</td>
                                <td align="center">3.61</td>
                                <td align="center">3.69</td>
                                <td align="center">3.52</td>
                                <td align="center">Must be better</td>
                              </tr>
                              <tr>
                                <td align="center" rowspan="5">2</td>
                                <td align="center" colspan="6">Student Activity</td>
                              </tr>
                              <tr>
                                <td>Faculty</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>University</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>National</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>International</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                                                            <tr>
                                <td align="center" rowspan="5">3</td>
                                <td align="center" colspan="6">Student Competition</td>
                              </tr>
                              <tr>
                                <td>Faculty</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>University</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>National</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>International</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                                                            <tr>
                                <td align="center" rowspan="5">4</td>
                                <td align="center" colspan="6">Student Certification</td>
                              </tr>
                              <tr>
                                <td>Faculty</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>University</td>
                                <td align="center">4</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>National</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>International</td>
                                <td align="center">1</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
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