<?php
@include_once 'config.php';
$current_date = date("Y-m-d");
$tested="tested";
$not_tested="not_tested";


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="labStyle.css">
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
    <div id="search-patient-inco">
        <div class="search-wraper">
          <input type="search" placeholder="search here...">
          <i class="fa-solid fa-magnifying-glass"></i>
           </div>
      </div>

 
<?php
  $select_inco_patient_data = mysqli_query($conn, "SELECT * FROM patient_laboratory WHERE request_date='{$current_date}' AND status='{$not_tested}'");
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
             <button class="btn1" onclick="window.location.href='labViewSend.php?PN=<?php echo $row_fetch_lab['hospital_patient_no']; ?>'">View More</button>
             <!-- <button class="btn2" >Add Test Results</button>
             <button class="btn3">Send To Doctor</button> -->
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
   
      <div id="search-patient-inco">
        <div class="search-wraper">
          <input type="search" placeholder="search here...">
          <i class="fa-solid fa-magnifying-glass"></i>
           </div>
      </div>

      <?php
  $select_comp_patient_data = mysqli_query($conn, "SELECT * FROM patient_laboratory WHERE request_date='{$current_date}' AND status='{$tested}'");
    ?>

      <div class="completed-lab-patient-list">
        <h1>Completed Test Order</h1>
       <div class="completed-lab-card-container">
       <?php
       if(mysqli_num_rows($select_comp_patient_data) > 0){
        while($row = mysqli_fetch_assoc($select_inco_patient_data)){
        ?>
        <div id="lab-single">
          <div class="left-lab">
          <label><strong>patient Name: </strong><span><?php  echo $row["patient_name"]; ?></span></label>
          <label><strong>Reg No: </strong><span><?php  echo $row["hospita_patient_no"]; ?></span></label>
          <label><strong>OPD No.: </strong><span><?php  echo $row["odp_no"]; ?></span></label>
          <label><strong>Sample No.: </strong><span><?php  echo $row["sample_no"]; ?></span></label>

          
           </div>
           <div class="right-lab">
             <button class="btn11">View Details</button>
           </div>
        </div>
       <?php
        }}else{
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




<script type="text/javascript">

 </script>

</body>
</html>