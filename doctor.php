<?php
@include 'config.php';

$current_date = date("Y-m-d");
$tend = "tend";
$not_tend = "not_tend";


?>





<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="doctorStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>




<main>
  <aside id="el-scroll">
    <p>HSM</p>
  </aside>

   <section id="upper-nav">
   <div class="left-upper-nav">
   <label><i class="fa-solid fa-bars"></i></label>
   <!-- <label id="patient-rem-det-card"><i class="fa-solid fa-arrow-left"></i></label> -->
   <h2>Doctor's Page</h2>
   </div>
   <div class="right-upper-nav">
   <label><strong>Appointments History</strong><i class="fa-solid fa-angle-down"></i></label>

   <div class="notify">
 <i class="fa-solid fa-bell" id="bell"></i>
 <i class="fa-solid fa-circle" id="circle"></i>
   </div>

   <div class="user-acc">
   <div class="avatar">
    <i class="fa-solid fa-user" id="user"></i>
    <i class="fa-solid fa-circle" id="circle"></i>
      </div>
      <div class="user-name">
        <p><strong>Admin</strong></p>
        <p><small>Dismas Wanyala</small></p>
      </div>
    </div> 
   </div>
   

   </section>
   <!-- onmouseenter="changeStyle(true)" onmouseleave="changeStyle(false)" -->
   <section id="side-bar-menu" >
    <div class="top-menu">
     <label><i class="fa-solid fa-angles-up"></i></label>
    </div>

    <div class="middle-menu">
    <ul>
       <li><a href="index.html"><i class="fa-solid fa-house-medical-circle-check"></i><span> Home</span></a></li>
        <li><a href="patient.php"><i class="fa-solid fa-hospital-user"></i><span> patient</span></a></li>
        <li><a href="doctor.php" class="active"><i class="fa-solid fa-user-doctor"></i><span> Doctor</span></a></li>
        <li><a href=""><i class="fa-solid fa-list-check"></i><span> Appointments</span></a></li>
        <li><a href=""><i class="fa-solid fa-money-check-dollar"></i><span>Billing and Payment</span></a></li>
        <li><a href=""><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>
        <li><a href=""><i class="fa-solid fa-hospital"></i><span> Hospital Resources</span></a></li>
    </ul>
    </div>

    <div class="abt-stng">
       <label><i class="fa-solid fa-gear"></i></label> 
       <label><i class="fa-solid fa-info-circle"></i></label> 
    </div>

   </section>

   <section id="main-content">
   <div id="doc-intro">
    <h1>Hello Dr. <span>Dismas Wanyala</span></h1>
    <p>Here are some important task to be done.
      Manage Patients from your Dashboard.
    </p>
    <a href="#">View Profile</a>
   </div>

   <div id="doc-repo-section">
    <div class="header-sec">
      <h3>Daily Reports</h3>
      <select>
        <option>2023-06-03</option>
        <option>2023-06-02</option>
        <option>2023-06-01</option>
        <option>2023-05-31</option>
      </select>
    </div>
    
    <div class="doc-repo-cards">
     <div class="single-repo-card">
     <i class="fa-solid fa-hospital-user"></i>
     <p>Incoming patients</p>
     <label>300</label>
     </div>

     <div class="single-repo-card">
      <i class="fa-solid fa-hospital-user"></i>
      <p>Total patients</p>
      <label>300</label>
      </div>


      <div class="single-repo-card">
        <i class="fa-solid fa-clipboard-check"></i>
        <p>Appointments</p>
        <label>300</label>
        </div>

        <div class="single-repo-card">
          <i class="fa-solid fa-message"></i>
          <p>Unread Messages</p>
          <label>300</label>
          </div>
    </div>


   </div>


   <div id="search-patient-inco">
    <div class="search-wraper">
      <input type="search" placeholder="search here...">
      <i class="fa-solid fa-magnifying-glass"></i>
       </div>
  </div>



<?php
$select_incoming_patient_data = mysqli_query($conn, "SELECT * FROM patient_sub_visits WHERE visit_date='{$current_date}' AND status='{$not_tend}'");


?>

   <div class="inco-patient-list">
    <h1>Incoming Patients</h1>
    <div class="patient-list-body">
    <div class="match-header">
      <label id="s1"><strong>Patient reg No</strong></label>
      <label id="s2"><strong>Name</strong></label>
      <label id="s3"><strong>check in Reason</strong></label>
      <label id="s4"><strong>date</strong></label>
      <!-- <label id="s5"><strong>contact</strong></label>
      <label id="s6"><strong>contact</strong></label> -->
    </div> 
  
  <?php

if(mysqli_num_rows($select_incoming_patient_data) > 0){
  while($row = mysqli_fetch_assoc($select_incoming_patient_data)){
?>
  
    <div class="match-body" onclick="window.location.href='doctorpatient.php?PN=<?php echo $row['hospital_patient_no']; ?>'">
      <label id="s1"><p><?php echo $row["hospital_patient_no"]; ?></p></label>
      <?php
      $select_incoming_patient_data_name = mysqli_query($conn, "SELECT first_name,middle_name,last_name FROM patient_details WHERE hospital_patient_no='{$row["hospital_patient_no"]}'");
      if(mysqli_num_rows($select_incoming_patient_data_name) > 0){
      $row2 = mysqli_fetch_assoc($select_incoming_patient_data_name);
      ?>
     
      <label id="s2"><p><?php echo $row2["first_name"]." ".$row2["middle_name"]." ".$row2["last_name"]; ?></p></label>
      <?php
      }else{
     ?>
     <label id="s2"><p>none</p></label>
      <?php
      }
      ?>
      <label id="s3"><p><?php echo $row["visit_reason"]; ?></p></label>
      <label id="s4"><p><?php echo $row["visit_date"]; ?><span id="visit-time"> at: <?php echo $row["visit_time"]; ?></span></p></label>
      <!-- <label id="s5"><p>Dismas Wanyala</p></label>
      <label id="s6"><p>Dismas Wanyala</p></label> -->
    </div>
  
   
<?php
  }
}else{
?>
  
   
    <div id="zero-list-style">
      <label><h2>No Data Available</h2></label>
    </div>

<?php
}
?>
  </div>
  </div>


  <div class="appointment-patient-list">
    <h1>Upcomming Appointments</h1>
   <div class="appointment-card-container">
    
    <div id="appoitment-single">
      <div class="left-apnt">
        <label>
         <i class="fa-solid fa-hospital-user"></i>
         <p><strong>Binaly wells</strong></p>
        </label>
        <p><small id="ap-res">physio therapy</small></p>
        <p><small id="ap-time">sat, 2-06-2023: 12:00 - 12:30</small></p>
       </div>
       <div class="right-apnt">
         <button class="btn1">Accept</button>
         <button class="btn2">Reschedule</button>
         <button class="btn3">Reject</button>
       </div>
    </div>

    <div id="appoitment-single">
      <div class="left-apnt">
        <label>
         <i class="fa-solid fa-hospital-user"></i>
         <p><strong>Binaly wells Binaly wells Binaly wells</strong></p>
        </label>
        <p><small id="ap-res">physio therapy</small></p>
        <p><small id="ap-time">sat, 2-06-2023: 12:00 - 12:30</small></p>
       </div>
       <div class="right-apnt">
         <button class="btn1">Accept</button>
         <button class="btn2">Reschedule</button>
         <button class="btn3">Reject</button>
       </div>
    </div>


    <div id="appoitment-single">
      <div class="left-apnt">
        <label>
         <i class="fa-solid fa-hospital-user"></i>
         <p><strong>Binaly wells</strong></p>
        </label>
        <p><small id="ap-res">physio therapy</small></p>
        <p><small id="ap-time">sat, 2-06-2023: 12:00 - 12:30</small></p>
       </div>
       <div class="right-apnt">
         <button class="btn1">Accept</button>
         <button class="btn2">Reschedule</button>
         <button class="btn3">Reject</button>
       </div>
    </div>


    <div id="appoitment-single">
      <div class="left-apnt">
        <label>
         <i class="fa-solid fa-hospital-user"></i>
         <p><strong>Binaly wells</strong></p>
        </label>
        <p><small id="ap-res">physio therapy</small></p>
        <p><small id="ap-time">sat, 2-06-2023: 12:00 - 12:30</small></p>
       </div>
       <div class="right-apnt">
         <button class="btn1">Accept</button>
         <button class="btn2">Reschedule</button>
         <button class="btn3">Reject</button>
       </div>
    </div>




    <div id="zero-list-style">
      <label><h2>No Data Available</h2></label>
    </div>

   </div>
  
  
    
  
   
    
 
  </div>
   

 






   </section>
</main>
    <footer>

    </footer>


    <script> 
    
   


     







  </script>      

</body>
</html>