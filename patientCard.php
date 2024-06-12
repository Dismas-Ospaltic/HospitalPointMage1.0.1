<?php

@include 'config.php';
if(!isset($_GET['patient_id'])){

header("Location: patient.php");
exit();

}
$patient_unique_code = mysqli_real_escape_string($conn, $_GET['patient_id']);

$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='$patient_unique_code'");

if(isset($_POST['add_visit'])){
  $patient_visit_reason= mysqli_real_escape_string($conn, $_POST['text_reason']); 
  $past_visit_dates = mysqli_real_escape_string($conn, $_POST['visit_date']); 
  $current_date = date("Y-m-d");

  
    //code to assign number of visits
    $select_count_patient_visit = mysqli_query($conn, "SELECT COUNT(*) FROM patient_sub_visits WHERE hospital_patient_no='$patient_unique_code'");
    $number_visit_row = mysqli_fetch_array($select_count_patient_visit);
    $total_visit= $number_visit_row[0] + 1;

if($past_visit_dates != $current_date){
    $insert_visit="INSERT INTO patient_sub_visits(hospital_patient_no,visit_reason,visit) 
    values('{$patient_unique_code}','{$patient_visit_reason}','{$total_visit}')";
   $upload_patient_visits= mysqli_query($conn,$insert_visit);
   if($upload_patient_visits){
    echo '<script> alert("patient visit added successfully you can now sent to Doctor");</script>';
  }else{

    echo '<script> alert("patient visit failed to add try again or contact for support ");</script>';
  }
}else{
  echo '<script> alert("this patient today\'s visit has already been added!");</script>';
}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="patientCardStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />
  <style type="text/css">
    /* #main-content{
    background: red; 
    padding: 3rem;

}  */

#avatar-name-age label p span{
        color: black;
              }


              
  </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>
<section id="patient-visit-card">
   
   <div class="field-form">
     
 <form method="post" action="<?php $_PHP_SELF ?>">
 <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
<h2>Patient Visit To Facility</h2>
<?php
 $select_patient_visit_day = mysqli_query($conn, "SELECT visit_date FROM patient_sub_visits WHERE hospital_patient_no='$patient_unique_code'");
// if(mysqli_num_rows($select_patient_visit) > 0){
  while($row = mysqli_fetch_assoc($select_patient_visit_day)){
?>

  <input type="text" name="visit_date" placeholder="please enter middle name" value="<?php echo $row['visit_date']; ?>" >
 
<?php 
}
?>
<div class="input-wrapper">
 <label>Visit Reason</label>
 <select name="text_reason">
   <option value="">--Select Reason--</option>
    <option value="Illness or Disease">Illness or Disease</option>
     <option value="Injury or Accident">Injury or Accident</option>
     <option value="Routine Check-ups">Routine Check-ups</option>
     <option value="Chronic Condition Management">Chronic Condition Management</option>
     <option value="Surgery or Procedures">Surgery or Procedures</option>
     <option value="Maternity and Obstetrics">Maternity and Obstetrics</option>
     <option value="Emergency Care">Emergency Care</option>
     <option value="Specialist Consultation">Specialist Consultation</option>
     <option value="Mental Health Concerns">Mental Health Concerns</option>
     <option value="Diagnostic Testing">Diagnostic Testing</option>
     <option value="Rehabilitation">Rehabilitation</option>
     <option value="Palliative Care and End-of-Life Care">Palliative Care and End-of-Life Care</option>
     <option value="Other">Other</option>
 </select>
</div>

<div class="btn-wrapper">
<button type="submit" name="add_visit">Add Visit</button>
</div>

</form>

   </div>
</section>


<main>
  <aside id="el-scroll">
    <p>HSM</p>
  </aside>

   <section id="upper-nav">
   <div class="left-upper-nav">
   <label><i class="fa-solid fa-bars"></i></label>
   <label id="patient-rem-det-card"><i class="fa-solid fa-arrow-left"></i></label>
   <h2>Patient</h2>
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
        <li><a href="patient.php" class="active"><i class="fa-solid fa-hospital-user"></i><span> patient</span></a></li>
        <li><a href="doctor.php"><i class="fa-solid fa-user-doctor"></i><span> Doctor</span></a></li>
        <li><a href=""><i class="fa-solid fa-list-check"></i><span> Appointments</span></a></li>
        <li><a href=""><i class="fa-solid fa-money-check-dollar"></i><span>Billing and Payment</span></a></li>
        <li><a href="laboratory.php"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>
        <li><a href=""><i class="fa-solid fa-hospital"></i><span> Hospital Resources</span></a></li>
    </ul>
    </div>

    <div class="abt-stng">
       <label><i class="fa-solid fa-gear"></i></label> 
       <label><i class="fa-solid fa-info-circle"></i></label> 
    </div>

   </section>

   <section id="main-content">
    <p>hh</p>
   
    <?php
if(mysqli_num_rows($select_patient_data) > 0){
  $row = mysqli_fetch_assoc($select_patient_data);
?>
<section id="patient-det-card">
 <div class="main-patient-card">
<div class="left-card">
<div id="avatar-name-age">
<img src="resources/img/user.png">
<label>
  <p><strong><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?></strong></p>
  <p><?php echo $row['age']; ?> years old <span><?php echo $row['gender']; ?></span></p>
</label>
</div>
<div id="height-weight-blood">
<label>
  <p><small>Height</small></p>
  <p>185</p>
</label>
 
<label>
  <p><small>Weight</small></p>
  <p>65 kg</p>
</label>

<label>
  <p><small>Blood Type</small></p>
  <p>O+</p>
</label>

</div>
</div>
<div class="right-card">
<div id="other-det">
  <div class="other-det-container">
<label>
  <p><small>Phone</small></p>
  <p><?php echo $row['contact']; ?></p>
</label>
 
<label>
  <p><small>email</small></p>
  <p>kizaidismas@gmail.com</p>
</label>
</div>

<div class="other-det-container">
  <label>
    <p><small>Residence</small></p>
    <p><?php echo $row['residence']; ?></p>
  </label>
   
  <label>
  <p><small>Insurance Company</small></p>
  <p><?php echo $row['insurance_company']; ?></p>
  </label>
  </div>

  <div class="other-det-container">
    <label>
    <p><small>Insurance Company</small></p>
  <p><?php echo $row['insurance_company']; ?></p>
    </label>
     
    <label>
    <p><small>Insurance Member No.</small></p>
  <p><?php echo $row['insurance_no']; ?></p>
    </label>
    </div>

</div>
</div>
 </div>

 
 <div id="patient-op-btns">
<button id="btn1"><i class="fa-solid fa-add"></i>Add Visit</button>
<button id="btn2"><i class="fa-solid fa-user-doctor"></i>Send to Doctor</button>
<button id="btn3"><i class="fa-solid fa-list-1-2"></i>Fix Appointment</button>
<button id="btn4"><i class="fa-solid fa-edit"></i>Edit Patient Deteils</button>
 </div>

<div id="search-patient-hist">
  <div class="search-wraper">
    <input type="search" placeholder="search here...">
    <i class="fa-solid fa-magnifying-glass"></i>
     </div>
</div>

<?php   


$select_patient_visit = mysqli_query($conn, "SELECT visit_reason,DATE(visit_date) AS day_only,visit_time,visit FROM patient_sub_visits WHERE hospital_patient_no='$patient_unique_code' ORDER BY visit_date DESC");


?>
<div class="patient-list">
  <h1>Patient Visits History</h1>
  <div class="patient-list-body">
  <div class="match-header">
    <label id="s1"><strong>Visit</strong></label>
    <label id="s2"><strong>Visit Date</strong></label>
    <label id="s3"><strong>Reason</strong></label>
 
  
  </div> 

<?php
if(mysqli_num_rows($select_patient_visit) > 0){
 while($row = mysqli_fetch_assoc($select_patient_visit)){;
  ?>

  <div class="match-body">
    <label id="s1"><p>Visit <?php echo  $row['visit']; ?></p></label>
    
      <label id="s2"><p><?php echo  $row['day_only']; ?> at <?php echo  $row['visit_time']; ?></p></label>
  
    <label id="s3"><p><?php echo  $row['visit_reason']; ?></p></label>
 </div>

<?php 
 } 
 ?>

</div>
</div>
<div class="footer-det">
<p>Powered by Ospaltic</p>
</div>
<?php
}else{
  ?>
  <section id="no-patient-det-sec">
  <h3>No Data Available...</h3>
</section>
<?php
}
?>
</section>
<?php
}else{
?>
<section id="no-patient-det-sec">
  <h3>No Data Available...</h3>
</section>
<?php
 }
?>


   </section>
</main>
    <footer>

    </footer>
   
    <script>
     $('#btn1').click(function(){
        $('#patient-visit-card').addClass('active')
        });
        
       
        $('#canel-field-form').click(function(){
        $('#patient-visit-card').removeClass('active')
        });

   </script>
</body>
</html>