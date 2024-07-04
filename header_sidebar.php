<link rel="stylesheet" href="css/userpagestyle.css">

<header class="header">
   
   <section class="flex">

      <a href = "userhomepage.php" class = "logo">
            <img id = "logoImg" src = "img/lightmode_logo.png"
                         width = auto
                         height = "75" />
      </a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
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
         <a href="viewprofile.php" class="btn">View Profile</a>
         <div class="flex-btn">
            <a href="logout.php" class="option-btn">Logout</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
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
      <a href="viewprofile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="userhomepage.php"><i class="fas fa-home"></i><span style="margin-left: 1.75rem;">Home</span></a>
      <li class="dropdown_manage"> 
          <button type="button" class="manage-btn"><i class="fa fa-list-ul" style="margin-left: 1.55rem;"></i><span style="margin-left: 1.90rem;">Manage</span></button>
          <div class="manage__list">
             <a href="activities.php"><i class="fas fa-rocket" style="margin-left: 4.2rem;"></i><span style="margin-left: 2rem;">Activities</span></a>
             <a href="competitions.php"><i class="fa fa-trophy" style="margin-left: 4.05rem;"></i><span style="margin-left: 1.9rem;">Competition</span></a>
             <a href="certifications.php"><i class="fas fa-graduation-cap" style="margin-left: 4.0rem;"></i><span style="margin-left: 1.8rem;">Certification</span></a> 
          </div>
      </li>
      <a href="listofactivities.php"><i class="fas fa-tasks" style="margin-left: 1.55rem;"></i><span style="margin-left: 1.90rem;">List of Activities</span></a>
      <a href="challenges.php"><i class="fas fa-chalkboard-user" style="margin-left: 1.2rem;"></i><span style="margin-left: 1.75rem;">Challenges</span></a>
   </nav>

</div> 