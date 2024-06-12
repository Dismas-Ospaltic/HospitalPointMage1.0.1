<?php
@include_once 'config.php';


if(!isset($_GET['PN'])){

  header("Location: laboratory.php");
  exit();
  
  }
$patient_unique_code = mysqli_real_escape_string($conn, $_GET['PN']);
$current_date = date("Y-m-d");
$tested="tested";
$not_tested="not_tested";
$return_time = date('H:i:s', time());



if(isset($_POST["add-lab"])){
  $test_list = mysqli_real_escape_string($conn, $_POST['test_list']);
  // $sample = mysqli_real_escape_string($conn, $_POST['sample']);
  $sample_no = mysqli_real_escape_string($conn, $_POST['sample_no']);
  $test_results = mysqli_real_escape_string($conn, $_POST['test_results']);
  $other_det = mysqli_real_escape_string($conn, $_POST['other_det']);
  
$Send_lab_results = mysqli_query($conn, "UPDATE patient_laboratory SET test_list='{$test_list}',sample_no='{$sample_no}',test_results='{$test_results}',other_conclusion='{$other_det}',return_time='{$return_time }' WHERE hospital_patient_no='{$patient_unique_code}' AND request_date='{$current_date}'");
if($Send_lab_results){
  $Set_status_lab_results = mysqli_query($conn, "UPDATE patient_laboratory SET status='{$tested}' WHERE hospital_patient_no='{$patient_unique_code}' AND request_date='{$current_date}'");
echo '<script> alert("success"); </script>';
}else{
  echo '<script>alert("failed");</script>';
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
        <link rel="stylesheet" href="labviewStyle.css">
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

  <section id="add-labtest-card">
   
    <div class="field-form">
      
  <form action="<?php $_PHP_SELF ?>" method="post">
  <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
 <h2>Add Lab Tests</h2>

 <div class="input-wrapper">
  <label>Sample No.</label>
  <input type="text" name="sample_no" placeholder="please enter Sample Number To label Sample collected">
 </div>

 <div class="input-wrapper">
  <label>List Tests  (use semi-colon ; to separate lines)</label>
  <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
  <textarea placeholder="type list of test conducted..." name="test_list"></textarea>
 </div>

 <!-- <div class="input-wrapper">
  <label>Sample Collected (use semi-colon ; to separate lines)</label>
  <input type="text" name="text_middle" placeholder="please enter middle name">
  <textarea placeholder="type list of samples obtained from a patient..." name="sample"></textarea>
 </div> -->

 

 <div class="input-wrapper">
  <label>Test Results & Conclusions (use semi-colon ; to separate lines)</label>
  <!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
  <textarea placeholder="type the test results & the Conclusions..." name="test_results"></textarea>
 </div>


 <div class="input-wrapper">
  <label>Other Specifications (use semi-colon ; to separate lines)</label>
  <!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
  <textarea placeholder="type any other additional notes..." name="other_det"></textarea>
 </div>

 <div class="btn-wrapper">
<button type="submit" name="add-lab">Save</button>
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
   <label class="add-menu"><i class="fa-solid fa-bars"></i></label>
   <h2>Laboratory</h2>
   </div>
   <div class="right-upper-nav">
   <label><strong>Appointments</strong><i class="fa-solid fa-angle-down"></i></label>
   <a href="RRT"><i class="fa-solid fa-plus"></i>New Patient</a>
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
        <li><a href="doctor.php"><i class="fa-solid fa-user-doctor"></i><span> Doctor</span></a></li>
        <li><a href=""><i class="fa-solid fa-list-check"></i><span> Appointments</span></a></li>
        <li><a href="billing.php"><i class="fa-solid fa-money-check-dollar"></i><span>Billing and Payment</span></a></li>
        <li><a href="laboratory.php" class="active"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>
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
  $select_inco_patient_data = mysqli_query($conn, "SELECT * FROM patient_laboratory WHERE request_date='{$current_date}' AND status='{$not_tested}' AND hospital_patient_no='{$patient_unique_code}'");
    ?>
      <div class="incoming-lab-patient-list">
        <h1>Incoming Lab Test Order</h1>
       <div class="incoming-lab-card-container">
       <?php
       if(mysqli_num_rows($select_inco_patient_data) > 0){
        while($row_fetch_lab = mysqli_fetch_assoc($select_inco_patient_data)){
        ?>
        
        <div id="lab-single">
          <div class="left-lab">
          <label><strong>patient Name: </strong><span><?php echo $row_fetch_lab["patient_name"]; ?></span></label>
          <label><strong>Reg No: </strong><span><?php echo $row_fetch_lab["hospital_patient_no"]; ?></span></label>
          <label><strong>OPD No.: </strong><span><?php echo $row_fetch_lab["odp_no"]; ?></span></label>
          <label><strong>Sample No.: </strong><span><?php echo $row_fetch_lab["sample_no"]; ?></span></label>
          <label><strong>Ordered By: </strong><span>Hellen sharpe</span></label>
          <label><strong>Date: </strong><span><?php echo $row_fetch_lab["request_date"]; ?></span><span><?php echo "  at ".$row_fetch_lab["request"]; ?></span></label>
          <div class="specification-cont">
       
          <label><p><strong>Specified Tests: </strong></p>
          <?php
          $select_specified_test = mysqli_query($conn, "SELECT test_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data1=mysqli_fetch_array( $select_specified_test);

          $res1=$data1['test_specification'];

          $res1=explode(";",$res1);

          $count1=count($res1)-1;

          for($i=0; $i<=$count1;$i++){
         ?>
              <p>
               <?php echo $res1[$i]; ?>
              </p>
              <?php
               }
              ?>
        </label> 

        <label><p><strong>Sample Collected: </strong></p>
        <?php
          $select_specified_test = mysqli_query($conn, "SELECT sample_list FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data2=mysqli_fetch_array($select_specified_test);

          $res2=$data2['sample_list'];

          $res2=explode(";",$res2);

          $count2=count($res2)-1;
          for($i=0; $i<=$count2;$i++){
         ?>
            <p>
            <?php echo $res2[$i]; ?>
          </p>
          <?php 
          }
          ?>
        </label> 

        <label><p><strong>Other Specifications: </strong></p>
        <?php
          $select_specified_test = mysqli_query($conn, "SELECT other_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data3=mysqli_fetch_array($select_specified_test);

          $res3=$data3['other_specification'];

          $res3=explode(";",$res3);

          $count3=count($res3)-1;
          for($i=0; $i<=$count3;$i++){
         ?>
            <p>
            <?php echo $res3[$i]; ?>
          </p>
          <?php
          }
          ?>
        </label> 
                
            </div>
           </div>
           <div class="right-lab">
           
             <button class="btn2" >Add Test Results</button>
             <!-- <button class="btn2">Send To Doctor</button> -->
           </div>
        </div>
        <?php 
      } }else{
      ?>

    

        <div id="zero-list-style">
          <label><h2>No Data Available</h2></label>
        </div>
        <?php
       }
      ?>
    
       </div>
      </div>
   


 



   </section>
</main>
    <footer>

    </footer>

    <script> 
    
   
 
      $('.btn2').click(function(){
          $('#add-labtest-card').addClass('active')
          });
          
         
          $('#canel-field-form').click(function(){
          $('#add-labtest-card').removeClass('active')
          });
  
       
        //   $('.btn11').click(function(){
        //   $('#comp-detail-card').addClass('active')
        //   });
          
         
        //   $('#comp-detail-card .list-sec #canel-list-sec').click(function(){
        //   $('#comp-detail-card').removeClass('active')
        //   });
  
  
  
  
  
  
  
    </script> 

</body>
</html>