<?php
@include 'config.php';
if(isset($_GET['patient_id'])){
$patient_unique_code = mysqli_real_escape_string($conn, $_GET['patient_id']);

$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='$patient_unique_code'");



// echo '<script> alert("name: '.$row['first_name'].'");</script>';






}else{
  header("Location: patient.php");
  exit();
 
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
   
/* #upper-nav{

  display: none;
}
body{
    background: none;
}
#el-scroll{
z-index: 999;
display: none;
}  */
#no-patient-det-sec{
    text-align: center;
    color: crimson;
}
#avatar-name-age label p span{
        color: black;
              }
              #other-det label{
       padding-left: 1rem;
    }
  </style>

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
   <label id="patient-rem-det-card"><i class="fa-solid fa-arrow-left"></i></label>
   <h2>Patient Details</h2>
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
        <li><a href=""><i class="fa-solid fa-user-doctor"></i><span> Doctor</span></a></li>
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
<label>
  <p><small>Phone</small></p>
  <p><?php echo $row['contact']; ?></p>
</label>

<label>
  <p><small>email</small></p>
  <p>kizaidismas@gmail.com</p>
</label>


<label>
  <p><small>Residence</small></p>
  <p><?php echo $row['residence']; ?></p>
</label>

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

 <div class="patient-list">
  <div class="match-header">
    <label id="s1"><strong>Name</strong></label>
    <label id="s2"><strong>disease</strong></label>
    <label id="s3"><strong>check in date</strong></label>
    <label id="s4"><strong>contact</strong></label>
  </div> 

<div class="patient-list-body">
  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas Wanyala</p></label>
    <label id="s3"><p>Dismas Wanyala</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>


  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas </p></label>
    <label id="s3"><p>Dismas</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>

  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas Wanyala</p></label>
    <label id="s3"><p>Dismas Wanyala</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>

  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas Wanyala</p></label>
    <label id="s3"><p>Dismas Wanyala</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>

  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas </p></label>
    <label id="s3"><p>Dismas</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>


  <div class="match-body">
    <label id="s1"><p>Dismas Wanyala</p></label>
    <label id="s2"><p>Dismas </p></label>
    <label id="s3"><p>Dismas</p></label>
    <label id="s4"><p>Dismas Wanyala</p></label>
  </div>


</div>
</div>

<div class="footer-det">
<p>Powered by Ospaltic</p>
</div>

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
   

</body>
</html>