<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login_form.php');
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:home.php');
}

$sourcePage = isset($_GET['source']) ? $_GET['source'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$sourceTable = '';

switch ($sourcePage) {
    case 'activities':
        $sourceTable = 'activities_form';
        $fetch_activity_query = mysqli_query($conn, "SELECT * FROM activities_form WHERE act_id = '$id' AND id = '$user_id'");
        $existing_activity = mysqli_fetch_assoc($fetch_activity_query);
        if (!$existing_activity) {
            header('location: activities.php');
        }
        break;
    case 'certifications':
        $sourceTable = 'certifications_form';
        $fetch_certification_query = mysqli_query($conn, "SELECT * FROM certifications_form WHERE cer_id = '$id' AND id = '$user_id'");
        $existing_certification = mysqli_fetch_assoc($fetch_certification_query);
        if (!$existing_certification) {
            header('location: activities.php');
        }
        break;
    case 'competitions':
        $sourceTable = 'competitions_form';
        $fetch_competition_query = mysqli_query($conn, "SELECT * FROM competitions_form WHERE comp_id = '$id' AND id = '$user_id'");
        $existing_competition = mysqli_fetch_assoc($fetch_competition_query);
        if (!$existing_competition) {
            header('location: activities.php');
        }
        break;
    case 'challenges':
        $sourceTable = 'challenges_form';
        $fetch_challenge_query = mysqli_query($conn, "SELECT * FROM challenges_form WHERE cha_id = '$id' AND id = '$user_id'");
        $existing_challenge = mysqli_fetch_assoc($fetch_challenge_query);
        if (!$existing_challenge) {
            header('location: challenges.php');
        }
        break;
    default:
        break;
}

if (isset($_POST['update_activities'])) {
   $fetch_image_query = mysqli_query($conn, "SELECT image FROM activities_form WHERE act_id = '$id' AND id = '$user_id'");
   $fetch = mysqli_fetch_assoc($fetch_image_query);
   $old_image = $fetch['image'];
    
   $update_sem = mysqli_real_escape_string($conn, $_POST['update_sem']);
   $update_year = mysqli_real_escape_string($conn, $_POST['update_year']);
   $update_activity = mysqli_real_escape_string($conn, $_POST['update_activity']);
   $update_remarks = mysqli_real_escape_string($conn, $_POST['update_remarks']);

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;
    
   mysqli_query($conn, "UPDATE `activities_form` SET sem = '$update_sem', year = '$update_year', activities = '$update_activity', remarks = '$update_remarks' WHERE act_id = '$id' AND id = '$user_id'") or die('query failed');

      if($update_image_size > 2000000){
         $message[] = 'Image is too large!';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `activities_form` SET image = '$update_image' WHERE act_id = '$id' AND id = '$user_id'") or die('query failed');
          
         if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
                unlink('uploaded_img/' . $old_image);
         }
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
          
         $message[] = 'Image updated successfully!';
         header('location:activities.php'); 
      }
    
} 

elseif (isset($_POST['update_certifications'])) {
   $fetch_docs_query = mysqli_query($conn, "SELECT docs FROM certifications_form WHERE cer_id = '$id' AND id = '$user_id'");
   $fetch = mysqli_fetch_assoc($fetch_docs_query);
   $old_docs = $fetch['docs'];    
    
   $update_sem = mysqli_real_escape_string($conn, $_POST['update_sem']);
   $update_year = mysqli_real_escape_string($conn, $_POST['update_year']);
   $update_certification = mysqli_real_escape_string($conn, $_POST['update_certification']);
   $update_certification_date = mysqli_real_escape_string($conn, $_POST['update_certification_dates']);
   $update_remarks = mysqli_real_escape_string($conn, $_POST['update_remarks']);

   $update_docs = $_FILES['update_docs']['name'];
   $update_docs_size = $_FILES['update_docs']['size'];
   $update_docs_tmp_name = $_FILES['update_docs']['tmp_name'];
   $update_docs_folder = 'uploaded_img/'.$update_image;
    
   mysqli_query($conn, "UPDATE `certifications_form` SET sem = '$update_sem', year = '$update_year', certifications = '$update_certification', certification_dates = '$update_certification_date', remarks = '$update_remarks' WHERE cer_id = '$id' AND id = '$user_id'") or die('query failed');

      if($update_docs_size > 2000000){
         $message[] = 'Document is too large!';
      }else{
         $docs_update_query = mysqli_query($conn, "UPDATE `certifications_form` SET docs = '$update_docs' WHERE cer_id = '$id' AND id = '$user_id'") or die('query failed');
          
         if (!empty($old_docs) && file_exists('uploaded_img/' . $old_docs)) {
                unlink('uploaded_img/' . $old_docs);
         }
         if($docs_update_query){
            move_uploaded_file($update_docs_tmp_name, $update_docs_folder);
         }
          
         $message[] = 'Document updated successfully!';
         header('location:certifications.php'); 
      }
    
} 

elseif (isset($_POST['update_competitions'])) {
   $fetch_docs_query = mysqli_query($conn, "SELECT docs FROM competitions_form WHERE comp_id = '$id' AND id = '$user_id'");
   $fetch = mysqli_fetch_assoc($fetch_docs_query);
   $old_docs = $fetch['docs'];
    
   $update_sem = mysqli_real_escape_string($conn, $_POST['update_sem']);
   $update_year = mysqli_real_escape_string($conn, $_POST['update_year']);
   $update_competition = mysqli_real_escape_string($conn, $_POST['update_competition']);
   $update_competition_date = mysqli_real_escape_string($conn, $_POST['update_competition_dates']);
   $update_remarks = mysqli_real_escape_string($conn, $_POST['update_remarks']);

   $update_docs = $_FILES['update_docs']['name'];
   $update_docs_size = $_FILES['update_docs']['size'];
   $update_docs_tmp_name = $_FILES['update_docs']['tmp_name'];
   $update_docs_folder = 'uploaded_img/'.$update_image;
    
   mysqli_query($conn, "UPDATE `competitions_form` SET sem = '$update_sem', year = '$update_year', competitions = '$update_competition', competition_dates = '$update_competition_date', remarks = '$update_remarks' WHERE comp_id = '$id' AND id = '$user_id'") or die('query failed');

      if($update_docs_size > 2000000){
         $message[] = 'Document is too large!';
      }else{
         $docs_update_query = mysqli_query($conn, "UPDATE `competitions_form` SET docs = '$update_docs' WHERE comp_id = '$id' AND id = '$user_id'") or die('query failed');
          
         if (!empty($old_docs) && file_exists('uploaded_img/' . $old_docs)) {
                unlink('uploaded_img/' . $old_docs);
         }
         if($docs_update_query){
            move_uploaded_file($update_docs_tmp_name, $update_docs_folder);
         }
          
         $message[] = 'Document updated successfully!';
         header('location:competitions.php'); 
      }
    
}

elseif (isset($_POST['update_challenges'])) {
   $fetch_image_query = mysqli_query($conn, "SELECT image FROM challenges_form WHERE cha_id = '$id' AND id = '$user_id'");
   $fetch = mysqli_fetch_assoc($fetch_image_query);
   $old_image = $fetch['image'];
    
   $update_sem = mysqli_real_escape_string($conn, $_POST['update_sem']);
   $update_year = mysqli_real_escape_string($conn, $_POST['update_year']);
   $update_challenge = mysqli_real_escape_string($conn, $_POST['update_challenge']);
   $update_plan = mysqli_real_escape_string($conn, $_POST['update_plans']);
   $update_remarks = mysqli_real_escape_string($conn, $_POST['update_remarks']);

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;
    
   mysqli_query($conn, "UPDATE `challenges_form` SET sem = '$update_sem', year = '$update_year', challenges = '$update_challenge', plans = '$update_plan', remarks = '$update_remarks' WHERE cha_id = '$id' AND id = '$user_id'") or die('query failed');

      if($update_image_size > 2000000){
         $message[] = 'Image is too large!';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `challenges_form` SET image = '$update_image' WHERE cha_id = '$id' AND id = '$user_id'") or die('query failed');
          
         if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
                unlink('uploaded_img/' . $old_image);
         }
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
          
         $message[] = 'Image updated successfully!';
         header('location:challenges.php'); 
      }
    
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo ucfirst($sourcePage); ?> Management</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/userpagestyle.css">
    
</head>

<body>

<?php include 'header_sidebar.php'; ?>

<section class="user-profile">

    <h1 class="heading">Edit <?php echo ucfirst($sourcePage); ?></h1>
    
                <?php if ($sourcePage === 'activities') : ?>
    
                    <section class="form-container">
                       <form action="" method="post" enctype="multipart/form-data">
                          <h3>Update Your Activity</h3>
                          <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                    };
                                };
                          ?>
                          <p>Semester</p>
                          <select size="1" name="update_sem" required class="box">
                              <option style="color: gray;" hidden>Select your semester</option>;
                              <option value="1">1</option>;
                              <option value="2">2</option>;
                          </select>
                          <p>Year</p>
                          <input type="text" name="update_year" required placeholder="Enter your year (YYYY/YYYY)" class="box"> 
                          <p>Activity Name</p>
                          <input type="text" name="update_activity" required placeholder="Enter your activity name" class="box">
                          <p>Remarks</p>
                          <input type="text" name="update_remarks" placeholder="Enter your remarks" class="box">
                          <p>Update Your Activity Photo</p>
                          <input type="file" name="update_image" accept="image/*" class="box">
                          <input type="submit" value="Submit" name="update_activities" class="btn">
                       </form>
                    </section>
    
                <?php elseif ($sourcePage === 'certifications') : ?>
                    
                    <section class="form-container">
                       <form action="" method="post" enctype="multipart/form-data">
                          <h3>Update Your Certification</h3>
                          <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                    };
                                };
                          ?>
                          <p>Semester</p>
                          <select size="1" name="update_sem" required class="box">
                              <option style="color: gray;" hidden>Select your semester</option>;
                              <option value="1">1</option>;
                              <option value="2">2</option>;
                          </select>
                          <p>Year</p>
                          <input type="text" name="update_year" required placeholder="Enter your year (YYYY/YYYY)" class="box"> 
                          <p>Certification Name</p>
                          <input type="text" name="update_certification" required placeholder="Enter your certification name" class="box">
                          <p>Certification Date</p>
                          <input type="text" name="update_certification_dates" required placeholder="Enter the certification date (DD/MM/YYYY)" class="box">
                          <p>Remarks</p>
                          <input type="text" name="update_remarks" placeholder="Enter your remarks" class="box">
                          <p>Update Your Certification Document</p>
                          <input type="file" name="update_docs" accept="image/*" class="box">
                          <input type="submit" value="Submit" name="update_certifications" class="btn">
                       </form>
                    </section>
    
                <?php elseif ($sourcePage === 'competitions') : ?>
                    
                    <section class="form-container">
                       <form action="" method="post" enctype="multipart/form-data">
                          <h3>Update Your Competition</h3>
                          <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                    };
                                };
                          ?>
                          <p>Semester</p>
                          <select size="1" name="update_sem" required class="box">
                              <option style="color: gray;" hidden>Select your semester</option>;
                              <option value="1">1</option>;
                              <option value="2">2</option>;
                          </select>
                          <p>Year</p>
                          <input type="text" name="update_year" required placeholder="Enter your year (YYYY/YYYY)" class="box"> 
                          <p>Competition Name</p>
                          <input type="text" name="update_competition" required placeholder="Enter your competition name" class="box">
                          <p>Competition Date</p>
                          <input type="text" name="update_competition_dates" required placeholder="Enter the competition date (DD/MM/YYYY)" class="box">
                          <p>Remarks</p>
                          <input type="text" name="update_remarks" placeholder="Enter your remarks (e.g., Achievements, Awards)" class="box">
                          <p>Update Your Competition Document</p>
                          <input type="file" name="update_docs" accept="image/*" class="box">
                          <input type="submit" value="Submit" name="update_competitions" class="btn">
                       </form>
                    </section>

                <?php elseif ($sourcePage === 'challenges') : ?>
    
                    <section class="form-container">
                       <form action="" method="post" enctype="multipart/form-data">
                          <h3>Update Your Challenge</h3>
                          <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                    };
                                };
                          ?>
                          <p>Semester</p>
                          <select size="1" name="update_sem" required class="box">
                              <option style="color: gray;" hidden>Select your semester</option>;
                              <option value="1">1</option>;
                              <option value="2">2</option>;
                          </select>
                          <p>Year</p>
                          <input type="text" name="update_year" required placeholder="Enter your year (YYYY/YYYY)" class="box"> 
                          <p>Challenge</p>
                          <input type="text" name="update_challenge" required placeholder="Enter your challenge" class="box">
                          <p>Plan</p>
                          <input type="text" name="update_plans" required placeholder="Enter your future plan for your challenge" class="box">
                          <p>Remarks</p>
                          <input type="text" name="update_remarks" placeholder="Enter your remarks" class="box">
                          <p>Update Your Challenge Photo</p>
                          <input type="file" name="update_image" accept="image/*" class="box">
                          <input type="submit" value="Submit" name="update_challenges" class="btn">
                       </form>
                    </section>   
    
                <?php endif; ?>
    
</section>

<footer class="footer">
    &copy; Copyright @ 2023 by <span>Ilhan the BROSkis</span> | All rights reserved!
</footer>

<script src="js/script.js"></script>

</body>
</html>
