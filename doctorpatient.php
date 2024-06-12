<?php

@include 'config.php';
if(!isset($_GET['PN'])){

header("Location: doctor.php");
exit();

}
$current_date = date("Y-m-d");
$tend = "tend";
$not_tend = "not_tend";
$patient_unique_code = mysqli_real_escape_string($conn, $_GET['PN']);


// $select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='$patient_unique_code'");
// if(mysqli_num_rows($select_patient_data) > 0){
  // $row = mysqli_fetch_assoc($select_patient_data);
  // $patient_name =


if(isset($_POST["add-notes"])){

$patient_med_his=mysqli_real_escape_string($conn, $_POST['text_history']);
$patient_comlaint=mysqli_real_escape_string($conn, $_POST['text_complaint']);
$patient_doc_note=mysqli_real_escape_string($conn, $_POST['text_notes']);
$patient_diagnosis=mysqli_real_escape_string($conn, $_POST['text_diagnosis']);
$patient_medication=mysqli_real_escape_string($conn, $_POST['text_medication']);


$update_patient_visit = mysqli_query($conn, "UPDATE patient_sub_visits SET cheif_complaint='{$patient_comlaint}',
diagnosis='{$patient_diagnosis}',medication='{$patient_medication}',doc_notes='{$patient_doc_note}' WHERE hospital_patient_no='{$patient_unique_code}' AND visit_date='{$current_date}'");
if($update_patient_visit){
  $update_patient_visit_status = mysqli_query($conn, "UPDATE patient_sub_visits SET status='{$tend}' WHERE hospital_patient_no='{$patient_unique_code}' AND visit_date='{$current_date}'");
  if($update_patient_visit_status){
    echo '<script> alert("update for subsequent visits successfully");</script>';
  }else{
    echo '<script> alert("failled to update for subsequent visits");</script>';
  }
 
}else{
  echo '<script> alert("failled to update for subsequent visits");</script>';
}

// echo '<script> alert("'.$patient_med_his." ".$patient_diagnosis.'");</script>';
}
if(isset($_POST["send_lab"])){
  $select_patient_visit_data = mysqli_query($conn, "SELECT visit_date,visit FROM patient_sub_visits WHERE hospital_patient_no='$patient_unique_code' AND visit_date='{$current_date}'");

  if(mysqli_num_rows($select_patient_visit_data) > 0){
  $row_visit = mysqli_fetch_assoc($select_patient_visit_data);

  $test_specification=mysqli_real_escape_string($conn, $_POST['text_specification']);
  $sample_list=mysqli_real_escape_string($conn, $_POST['text_sample']);
  $sample_no=mysqli_real_escape_string($conn, $_POST['text_sample_no']);
  $oter_det=mysqli_real_escape_string($conn, $_POST['text_other_det']);
  $visit =  $row_visit ["visit"];
  $visit_date =  $row_visit["visit_date"];


  $select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='$patient_unique_code'");
  if(mysqli_num_rows($select_patient_data) > 0){
  $row_sel = mysqli_fetch_assoc($select_patient_data);
  $patient_name = $row_sel["first_name"]." ".$row_sel["middle_name"]." ".$row_sel["last_name"];
  $Hospital_reg_no = $row_sel["hospital_patient_no"];
  $odp_no = $row_sel["odp_no"];


 $select_current_order = mysqli_query($conn, "SELECT request_date FROM patient_laboratory WHERE hospital_patient_no ='{$Hospital_reg_no}' AND request_date='{$current_date}'");
 if(mysqli_num_rows($select_current_order) > 0){
  echo '<script>alert("already Sent!...");</script>';

}else{
 
  $send_lab_order = mysqli_query($conn, "INSERT INTO patient_laboratory (patient_name,hospital_patient_no,odp_no,sample_list,test_specification,other_specification,visit) VALUES('{$patient_name}','{$Hospital_reg_no}','{$odp_no}','{$sample_list}','{$test_specification}','{$oter_det}','{$visit}') ");
  if($send_lab_order){
    echo '<script>alert("Laboratory order sent Successfully.");</script>';
  }else{
    echo '<script>alert("could not send laboratory order");</script>';
  }
}



  }else{
    echo '<script>alert("could not get patient data!...");</script>';
  }

}else{
  echo '<script>alert("could not get today\'s patient visit data!... Make sure today visit is recorded");</script>';
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
        <link rel="stylesheet" href="doctorpatientStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />
  <style type="text/css">

#no-patient-det-sec{
  text-align: center;
  color: crimson;
}
#avatar-name-age label p span{
        color: black;
              }
              .disabled{
          pointer-events: none;
            opacity: .5;
            user-select: none;
            background: var(--secondary-color);
          }

  </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>

    <section id="patient-note-card">
   
        <div class="field-form">
<?php
$select_med_his_patient_data = mysqli_query($conn, "SELECT medical_history FROM patient_details WHERE hospital_patient_no='{$patient_unique_code}'");

  $row4 = mysqli_fetch_assoc($select_med_his_patient_data);

?>
          
      <form action="<?php $_PHP_SELF ?>" method="post">
      <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
     <h2>Medical Notes</h2>
     <div class="input-wrapper">
     <?php// echo  $row4["medical_history"]; ?>
      <label>medical History  (use semi-colon ; to separate lines)</label>
      <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
      <textarea placeholder="type patient's medical history.." name="text_history" ><?php  echo !empty($row4["medical_history"])?$row4["medical_history"]: ""; ?></textarea>
     </div>
   <?php
   $select_med_his_patient_current_data = mysqli_query($conn, "SELECT cheif_complaint,doc_notes,diagnosis,medication FROM patient_sub_visits WHERE hospital_patient_no='{$patient_unique_code}' AND visit_date='{$current_date}'");
   $row5 = mysqli_fetch_assoc($select_med_his_patient_current_data);
   ?>
     <div class="input-wrapper">
      <label>Cheif Complaits  (use semi-colon ; to separate lines)</label>
      <!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
      <textarea placeholder="type patient's Symptoms decriptions or concerns..." name="text_complaint"><?php  echo !empty($row5["cheif_complaint"])?$row5["cheif_complaint"]: ""; ?></textarea>
     </div>
    
     <div class="input-wrapper">
      <label>Doctors Notes  (use semi-colon ; to separate lines)</label>
      <!-- <input type="text" name="text_last" placeholder="please enter last name" required> -->
      <textarea placeholder="type Notes..." name="text_notes"><?php  echo !empty($row5["doc_notes"])?$row5["doc_notes"]: ""; ?></textarea>
     </div>
    
    
     <div class="input-wrapper">
      <label>Diagnosis  (use semi-colon ; to separate lines)</label>
      <!-- <input type="text" name="text_age" placeholder="please enter patient age"> -->
      <textarea placeholder="type probable diagnosis..." name="text_diagnosis"><?php  echo !empty($row5["diagnosis"])?$row5["diagnosis"]: ""; ?></textarea>
     </div>
    
    
    
     <div class="input-wrapper">
      <label>Medication & Treatment  (use semi-colon ; to separate lines)</label>
      <!-- <input type="text" name="text_opd" placeholder="please enter patient Opd Number"> -->
      <textarea placeholder="type the medication/treatments..." name="text_medication"><?php  echo !empty($row5["medication"])?$row5["medication"]: ""; ?></textarea>
     </div>
    
    
     <div class="btn-wrapper">
    <button name="add-notes" type="submit">Save</button>
     </div>
    
    </form>
    
        </div>
    </section>

    <section id="patient-laborder-card">
   
   <div class="field-form">
     
 <form method="post" action="<?php $_PHP_SELF ?>">
 <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
<h2>Laboratory Test Order</h2>
<div class="input-wrapper">
 <label>Specify Test (use semi-colon ; to separate lines)</label>
 <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
 <textarea placeholder="type specific list of tests to be conducted..." name="text_specification"></textarea>
</div>

<div class="input-wrapper">
 <label>Samples (use semi-colon ; to separate lines)</label>
 <!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
 <textarea placeholder="type list of Samples to be collected..." name="text_sample"></textarea>
</div>

<!-- <div class="input-wrapper">
 <label>Sample No.</label>
 <input type="text" name="text_sample_no" placeholder="please enter Sample Number if already collected">
</div> -->


<div class="input-wrapper">
 <label>Other Additional Details  (use semi-colon ; to separate lines)</label>
 <!-- <input type="text" name="text_age" placeholder="please enter patient age"> -->
 <textarea placeholder="type any Other Additional details..." name="text_other_det"></textarea>
</div>



<div class="btn-wrapper">
<button type="submit" name="send_lab">Send</button>
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
<?php
$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='$patient_unique_code'");
if(mysqli_num_rows($select_patient_data) > 0){
  $row = mysqli_fetch_assoc($select_patient_data);
?>
<div class="patient-det-dis">
<div class="patient-info">
    <div id="avatar-name-age">
        <img src="resources/img/user.png">
        <label>
          <p><strong><?php  echo $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]; ?></strong></p>
          <p><?php echo $row['age']; ?> years old <span><?php echo $row['gender']; ?></span></p>
        </label>
        </div>

        <div id="height-weight-blood">
            <label>
              <p><small>Height</small></p>
              <?php
              if(!empty($row['height'])){
              ?>
            <p><?php echo $row['height']; ?> FT</p>
            <?php
              }else{
              ?>
               <p>___</p>
              <?php 
            } 
            ?>
            </label>
             
            <label>
              <p><small>Weight</small></p>
              <?php
              if(!empty($row['weight'])){
              ?>
              <p><?php echo $row['weight']; ?> kg</p>
              <?php
              }else{
              ?>
          <p>___</p>
         <?php } ?>
            </label>
            
            <label>
              <p><small>Blood Type</small></p>
              <?php
              if(!empty($row['blood_group'])){
              ?>
              <p><?php echo $row['blood_group']; ?></p>
              <?php
              }else{
               ?>
             <p>___</p>
              <?php
              }
              ?>
            </label>
            
            </div>

</div>

<div class="med-hst">
<h3>Medical History Notes</h3>
<?php
  if(!empty($row['medical_history'])){
?>
<p>
<?php echo $row['medical_history']; ?>
</p>
<a href="#">Read more</a>
<?php
  }else{
  ?>
<h1>No Medical History Added</h1>
<?php 
  }
  ?>
</div>
</div>


<div id="patient-op-btns">
    <button id="btn1"><i class="fa-solid fa-clipboard-list"></i>View patient's Records</button>
    <button id="btn2"><i class="fa-solid fa-house-medical"></i>Order Lab Test</button>
    <button id="btn3"><i class="fa-solid fa-list-1-2"></i>Fix Appointment</button>
    <button id="btn4"><i class="fa-solid fa-edit"></i>Edit Patient Deteils</button>
</div>

<?php
$select_incoming_patient_data = mysqli_query($conn, "SELECT visit_reason,visit,status FROM patient_sub_visits WHERE visit_date='{$current_date}' AND hospital_patient_no='{$patient_unique_code}'");
if(mysqli_num_rows($select_incoming_patient_data) > 0){
  $row3 = mysqli_fetch_assoc($select_incoming_patient_data);
?>

<div class="date-visit-container">
    <h1>Today's Visit</h1>
    <p>check in Reason: <small><?php echo $row3["visit_reason"]; ?></small></p>
    <p>Visit: <small><?php echo $row3["visit"]; ?></small></p>
    <div class="patient-date-op-btn">
        <button id="btn11"><i class="fa-solid fa-add"></i>Add medical Notes</button>
        <button id="btn22" class="<?=$tend == $row3["status"]?'':'disabled'; ?>" onclick="window.location.href='printdischarge.php?PN=<?php echo $patient_unique_code; ?>&patient_visit=<?php echo $row3['visit']; ?>'"><i class="fa-solid fa-house-medical"></i>View/Print Discharge summary</button>
        <button id="btn33" class="<?=$tend == $row3["status"]?'':'disabled'; ?>"><i class="fa-solid fa-list-1-2"></i>Create Invoice</button>
    </div>
</div>
<?php
}
?>
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
    
   
 
    $('#btn11').click(function(){
        $('#patient-note-card').addClass('active')
        });
        
       
        $('#canel-field-form').click(function(){
        $('#patient-note-card').removeClass('active')
        });

     
        $('#btn2').click(function(){
        $('#patient-laborder-card').addClass('active')
        });
        
       
        $('#patient-laborder-card .field-form #canel-field-form').click(function(){
        $('#patient-laborder-card').removeClass('active')
        });






  </script>      

</body>
</html>