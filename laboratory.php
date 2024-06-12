<?php
@include_once 'config.php';
$current_date = date("Y-m-d");
$tested="tested";
$not_tested="not_tested";
$return_time = date('H:i:s', time());

if(isset($_POST["add-lab"])){
 if(isset($_GET['PN'])){
  $hospital_patient_no=mysqli_real_escape_string($conn, $_GET['PN']);
  $test_list = mysqli_real_escape_string($conn, $_POST['test_list']);
  $sample = mysqli_real_escape_string($conn, $_POST['sample']);
  $sample_no = mysqli_real_escape_string($conn, $_POST['sample_no']);
  $test_results = mysqli_real_escape_string($conn, $_POST['test_results']);
  $other_det = mysqli_real_escape_string($conn, $_POST['other_det']);

  $Send_lab_results = mysqli_query($conn, "UPDATE patient_laboratory SET test_list='{$test_list}',sample_no='{$sample_no}',sample_collected='{$sample}',test_results='{$test_results}',other_conclusion='{$other_det}',return_time='{$return_time}' WHERE hospital_patient_no='{$hospital_patient_no}' AND request_date='{$current_date}'");
if($Send_lab_results){
$Set_status_lab_results = mysqli_query($conn, "UPDATE patient_laboratory SET status='{$tested}' WHERE hospital_patient_no='{$hospital_patient_no}' AND request_date='{$current_date}'");
echo '<script> alert("success"); </script>';
}else{
  echo '<script>alert("failed");</script>';
}
  }else{
    $hospital_patient_no="";
    echo '<script>alert("failed! could not add now");</script>';
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
        <link rel="stylesheet" href="labStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />
  <style type="text/css">
:root{
   
   --main-color: royalblue;
   --secondary-color:orangered;
   --green: #27ae60;
   --black: #333;
   --white: #fff;
   --light-bg-color: #f2f3f5;
   --border-color: #e5e8ec;
  
   --color-dark: #1D2231;
   --text-grey: #8390A2;
   --coolor: #6ea1e9;
   /* color: rgb(9, 240, 163) */
 }
 #search-patient-inco .search-wraper{
   display: flex;
   align-items: center;
   border: 1px solid crimson;
   height: 40px;
   width: 40%;
   margin-top: 1rem;
 
 }
 #search-patient-inco .search-wraper i{
   font-size: 30px;
   color: crimson;
  
 }
 #search-patient-inco .search-wraper input{
   height: 100%;
   width: 100%;
   font-size: 1.2rem;
 }
 #search-patient-inco{
   margin-top: 10px;
 }
 .completed-lab-patient-list,
 .incoming-lab-patient-list{
   background-color: var(--white);
   margin-top: 10px;
 padding: .5rem;
 }
 .completed-lab-patient-list h1,
 .incoming-lab-patient-list h1{
   padding: .5rem;
 }
 .completed-lab-patient-list .completed-lab-card-container,
 .incoming-lab-patient-list .incoming-lab-card-container{
   padding: .5rem;
   max-height: 600px;
   /* background: #27ae60; */
   margin-bottom: 10px;
   overflow-y: auto;
   
 }
 #zero-list-style label h2{
   color: crimson;
   text-align: center;
   padding: .5rem;
   }
   .completed-lab-patient-list .lab-single,
   .incoming-lab-patient-list .lab-single{
     background: var(--light-bg-color);
     padding: .5rem;
     margin-bottom: .5rem;
   }
 
   .incoming-lab-patient-list .lab-single .date-label{
     display: flex;
     flex-direction: row;
     justify-content: space-between;
   }
   .incoming-lab-patient-list .lab-single .date-label .left-label{
     display: flex;
     flex-direction: row;
   }
   .incoming-lab-patient-list .lab-single .date-label .left-label i{
     color: var(--main-color);
 
   }
   .incoming-lab-patient-list .lab-single .date-label .left-label p{
     color: var(--green);
   }
   .incoming-lab-patient-list .lab-single .date-label .right-label p span{
  color: crimson;
   }
   .completed-lab-patient-list .completed-lab-card-container .patient-det,
   .incoming-lab-patient-list .incoming-lab-card-container .patient-det{
   display:flex;
   flex-wrap: wrap;
   align-items: flex-start;
   justify-content: space-between;
   }
   .completed-lab-patient-list .completed-lab-card-container .patient-det label,
   .incoming-lab-patient-list .incoming-lab-card-container .patient-det label{
     padding: .5rem;
   }
   .completed-lab-patient-list .completed-lab-card-container .patient-det label strong,
   .incoming-lab-patient-list .incoming-lab-card-container .patient-det label strong{
  color: var(--coolor);
   }
   .specifics{
     display: flex;
     flex-direction: column;
   }
   .specifics label{
 color: var(--coolor);
   }
 .specifics p{
   overflow: hidden;
   display: -webkit-box;
   -webkit-box-orient: vertical;
   -webkit-line-clamp: 3;
   white-space: wrap;
 }
 .lab-btn-op{
   display: flex;
   flex-wrap: wrap;
   align-items: flex-start;
 }
 .lab-btn-op button{
   padding: .5rem 1rem;
   color: var(--white);
 }
 .lab-btn-op button:hover{
 opacity: .7;
 }
 .btn1{
   background: var(--green);
 
 }
 .btn2{
   background: var(--main-color);
   margin-left: 1rem;
   
 }
 .btn11{
   background: var(--green);
 }
 .btn22{
   background: crimson;
   margin-left: 1rem;
 }
 
 #patient-laborder-card-edit,
 #patient-laborder-card{
   background: rgba(65,105,255, 0.3);
   padding: 1rem;
   position: fixed;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   z-index: 99999;
 margin: auto;
 display: none;
 }
 #patient-laborder-card-edit.active,
 #patient-laborder-card.active{
   display: initial;
 }
 #patient-laborder-card-edit .field-form,
 #patient-laborder-card .field-form{
   width: 50%;
   background-color: var(--white);
   height: 95%;
   margin: 0 auto;
   padding: 1rem;
   overflow-y: auto;
   /* border-radius: 10px; */
 }
 #patient-laborder-card-edit .field-form #canel-field-form,
 #patient-laborder-card .field-form #canel-field-form{
 float: right;
 padding: 1rem;
 border-radius: 10px;
 }
 #patient-laborder-card-edit .field-form #canel-field-form:hover,
 #patient-laborder-card .field-form #canel-field-form:hover{
   background: var(--border-color);
 }
 #patient-laborder-card-edit .field-form h2,
 #patient-laborder-card .field-form h2{
   color: var(--main-color);
   text-align: center;
 }
 #patient-laborder-card-edit .field-form .input-wrapper,
 #patient-laborder-card .field-form .input-wrapper{
 display: flex;
 flex-direction: column;
 /* margin-top: 10px; */
 margin: 0 auto;
 margin-top: 20px;
 width: 100%;
 /* background: #1D2231; */
 }
 #patient-laborder-card-edit .field-form .input-wrapper input,
 #patient-laborder-card .field-form .input-wrapper input{
   padding: .5rem;
   border: 1px solid var(--text-grey);
   width: 100%;
   height: 100%;
   font-size: 1.2rem;
   border-radius: 10px;
 
 }
 #patient-laborder-card-edit .field-form .input-wrapper textarea,
 #patient-laborder-card .field-form .input-wrapper textarea{
   padding: .5rem;
   border: 1px solid var(--text-grey);
   width: 100%;
   height: 80px;
   font-size: 1.2rem;
   border-radius: 10px;
   resize: none;
  
 }
 #patient-laborder-card-edit .field-form .input-wrapper label,
 #patient-laborder-card .field-form .input-wrapper label{
   font-size: 1.2rem;
   color: var(--main-color);
 }
 #patient-laborder-card-edit .field-form .input-wrapper select,
 #patient-laborder-card .field-form .input-wrapper select{
   padding: .5rem;
   border: 1px solid var(--text-grey);
   width: 100%;
   height: 100%;
   font-size: 1.2rem;
   border-radius: 5px;
 
 }
 #patient-laborder-card-edit .field-form .btn-wrapper,
 #patient-laborder-card .field-form .btn-wrapper{
 margin: 0 auto;
 margin-top: 20px;
 width: 50%;
 }
 #patient-laborder-card-edit .field-form .btn-wrapper button,
 #patient-laborder-card .field-form .btn-wrapper button{
   background: var(--main-color);
   color: var(--white);
   padding: .5rem 1rem;
   width: 100%;
   font-size: 1.5rem;
   cursor: pointer;
 
 }
 
 /* ######################################## */
 #patient-view-card-complete,
 #patient-view-card{
   background: rgba(65,105,255, 0.3);
   padding: 1rem;
   position: fixed;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   z-index: 99999;
 margin: auto;
 display: none;
 }
 #patient-view-card-complete.active,
 #patient-view-card.active{
   display: initial;
 }
 #patient-view-card-complete .field-form,
 #patient-view-card .field-form{
   width: 50%;
   background-color: var(--white);
   height: 95%;
   margin: 0 auto;
   padding: 1rem;
   overflow-y: auto;
   /* border-radius: 10px; */
 }
 #patient-view-card-complete .field-form  #canel-field-form,
 #patient-view-card .field-form #canel-field-form{
 float: right;
 padding: 1rem;
 border-radius: 10px;
 }
 #patient-view-card-complete .field-form  #canel-field-form:hover,
 #patient-view-card .field-form #canel-field-form:hover{
   background: var(--border-color);
 }
 #patient-view-card-complete .field-form h2,
 #patient-view-card .field-form h2{
   color: var(--green);
   text-align: center;
 }
 #patient-view-card-complete .field-form .det-container,
 #patient-view-card .field-form .det-container{
 display: flex;
 flex-direction: column;
 margin-top: 10px;
 }
 #patient-view-card-complete .field-form .det-container label,
 #patient-view-card .field-form .det-container label{
   padding-top: .5rem;
   padding-top: .5rem;
 }
 #patient-view-card-complete .field-form .det-container label strong,
 #patient-view-card .field-form .det-container label strong{
  color: var(--coolor);
 
   }
   #patient-view-card-complete .field-form .det-container .specifics-det,
   #patient-view-card .field-form .det-container .specifics-det{
 display: flex;
    flex-direction: column;
   }
 
 
 
 @media(max-width: 920px){
   #search-patient-inco .search-wraper{
     
       width: 90%;
   
   
   }
 }
  </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>



  <section id="patient-laborder-card">
   
    <div class="field-form">
      
  <form action="<?php $_PHP_SELF ?>" method="post">
  <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
 <h2>Laboratory Test Results</h2>

 <div class="input-wrapper">
  <label>Samples Collected</label>
  <!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
  <textarea placeholder="type list of Samples collected..." name="sample"></textarea>
 </div>

 <div class="input-wrapper">
  <label>Sample No.</label>
  <input type="text" name="sample_no" placeholder="please enter Sample Number">
 </div>

 <div class="input-wrapper">
  <label>Tests</label>
  <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
  <textarea placeholder="type list of tests conducted..." name="test_list"></textarea>
 </div>

 <div class="input-wrapper">
  <label>Tests Results/Conclusions</label>
  <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
  <textarea placeholder="type list of tests Results..." name="test_results"></textarea>
 </div>

 <div class="input-wrapper">
  <label>Other Details/Remarks</label>
  <!-- <input type="text" name="text_age" placeholder="please enter patient age"> -->
  <textarea placeholder="type any Other Additional details..." name="other_det"></textarea>
 </div>

 <div class="btn-wrapper">
<button type="submit" name="add-lab">Send</button>
 </div>

</form>

    </div>
</section>


<?php

$hospital_patient_no=mysqli_real_escape_string($conn, $_GET['PN']);
$select_single_inco_patient_edit_data = mysqli_query($conn, "SELECT * FROM patient_laboratory WHERE request_date='{$current_date}' AND status='{$tested}' AND hospital_patient_no='{$hospital_patient_no}'");


?>
<section id="patient-laborder-card-edit">
   
  <div class="field-form">
  <?php
   if(mysqli_num_rows($select_single_inco_patient_edit_data) > 0){
    $row_fetch_lab = mysqli_fetch_assoc($select_single_inco_patient_edit_data);
    ?>
<form action="<?php $_PHP_SELF ?>" method="post">
<div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
<h2>Laboratory Test Results</h2>

<div class="input-wrapper">
<label>Samples Collected</label>
<!-- <input type="text" name="text_middle" placeholder="please enter middle name"> -->
<textarea placeholder="type list of Samples collected..."><?php echo  $row_fetch_lab["sample_collected"]; ?></textarea>
</div>

<div class="input-wrapper">
<label>Sample No.</label>
<input type="text" name="text_opd" placeholder="please enter Sample Number" value="<?php echo  $row_fetch_lab["sample_no"]; ?>">
</div>

<div class="input-wrapper">
<label>Tests</label>
<!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
<textarea placeholder="type list of tests conducted..."><?php echo  $row_fetch_lab["test_list"]; ?></textarea>
</div>

<div class="input-wrapper">
  <label>Tests Results/Conclusions</label>
  <!-- <input type="text" name="text_first" placeholder="please enter first name" required> -->
  <textarea placeholder="type list of tests Results..." name="test_results"></textarea>
 </div>


<div class="input-wrapper">
<label>Other Details/Remarks</label>
<!-- <input type="text" name="text_age" placeholder="please enter patient age"> -->
<textarea placeholder="type any Other Additional details..."><?php echo  $row_fetch_lab["other_conclusion"]; ?></textarea>
</div>


<div class="btn-wrapper">
<button type="submit" name="add-lab-edit">Send</button>
</div>

</form>
<?php
   }
?>
  </div>
</section>




<section id="patient-view-card">
   
  <div class="field-form">
    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
<h2>Laboratory Test Order</h2>
<div class="det-container">
  <!-- <label><strong>Patient Name: </strong>Dismas Wanyala</label>
  <label><strong>Reg No: </strong>Dismas Wanyala</label>
  <label><strong>OPD No.: </strong>Dismas Wanyala</label>
  <label><strong>Ordered By: </strong>Dismas Wanyala</label>
  <label><strong>Date: </strong>Dismas Wanyala</label>
  <div class="specifics-det">
    <label><strong>Specifications:</strong></label>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
      quisquam debitis quasi minus numquam consequatur
       eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
    </p>
       </div>

       <div class="specifics-det">
        <label><strong>Specifications:</strong></label>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
          quisquam debitis quasi minus numquam consequatur
           eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
        </p>
           </div>

           <div class="specifics-det">
            <label><strong>Specifications:</strong></label>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
              quisquam debitis quasi minus numquam consequatur
               eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
            </p>
               </div> -->
</div>

  </div>
</section>





<section id="patient-view-card-complete">
   
  <div class="field-form">
    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
<h2>Laboratory Test Order</h2>
<div class="det-container">
  <!-- <label><strong>Patient Name: </strong>Dismas Wanyala</label>
  <label><strong>Reg No: </strong>Dismas Wanyala</label>
  <label><strong>OPD No.: </strong>Dismas Wanyala</label>
  <label><strong>Patient Visit: </strong>visit 4</label>
  <label><strong>ADDED By: </strong>Dismas Wanyala</label>
  <label><strong>Date: </strong>Dismas Wanyala</label>
  <label><strong>Sample No: </strong>Dismas Wanyala</label>
  <div class="specifics-det">
    <label><strong>Sample Collected:</strong></label>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
      quisquam debitis quasi minus numquam consequatur
       eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
    </p>
       </div>

       <div class="specifics-det">
        <label><strong>Tests conducted:</strong></label>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
          quisquam debitis quasi minus numquam consequatur
           eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
        </p>
           </div>

           <div class="specifics-det">
            <label><strong>Test Results/Conclusions:</strong></label>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
              quisquam debitis quasi minus numquam consequatur
               eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
            </p>
               </div>
               <div class="specifics-det">
                <label><strong>Other Details:</strong></label>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit cumque 
                  quisquam debitis quasi minus numquam consequatur
                   eaque ratione corrupti dolore laudantium culpa qui in aspernatur incidunt hic iusto, id distinctio!
                </p>
                   </div> -->
</div>

<!-- <div id="zero-list-style">
  <label><h2>No Data Available</h2></label>
</div> -->

</div>
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
        <div class="lab-single">
      <div class="date-label">
     <label class="left-label">
    <i class="fa-solid fa-circle"></i>
    <p><strong>Today's lab test order</strong></p>
     </label>

    <label class="right-label">
   <p>Date: <span>2023-06-14 at 15:12:03</span></p>
    </label>
      </div>   
      
    <div class="patient-det">
<label><strong>Patient Name: </strong><span><?php echo $row_fetch_lab["patient_name"]; ?></span></label>
<label><strong>Reg No: </strong><span><?php echo $row_fetch_lab["hospital_patient_no"]; ?></span></label>
<label><strong>OPD No.: </strong><span><?php echo $row_fetch_lab["odp_no"]; ?></span></label>
<label><strong>Ordered By:</strong><span> Hellen Sharpe </span></label>
     </div>
     <div class="specifics">
  <!-- <label><strong>Specifications:</strong></label> -->
  <?php
          $select_specified_test = mysqli_query($conn, "SELECT test_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data1=mysqli_fetch_array( $select_specified_test);

          $res1=$data1['test_specification'];

          $res1=explode(";",$res1);

          $count1=count($res1)-1;

          for($i=0; $i<=$count1;$i++){
         ?>
               <p>
               <?php //echo $res1[$i]; ?>
              </p>
              <?php
               }
              ?>
     </div>

     <div class="specifics">
      <!-- <label><strong>Sample to Collect:</strong></label> -->
      <?php
          $select_specified_test = mysqli_query($conn, "SELECT sample_list FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data2=mysqli_fetch_array($select_specified_test);

          $res2=$data2['sample_list'];

          $res2=explode(";",$res2);

          $count2=count($res2)-1;
          for($i=0; $i<=$count2;$i++){
         ?>
            <p>
            <?php //echo $res2[$i]; ?>
          </p>
          <?php 
          }
          ?>
         </div>

         <div class="specifics">
          <!-- <label><strong>Other Specifications:</strong></label> -->
          <?php
          $select_specified_test = mysqli_query($conn, "SELECT other_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
          $data3=mysqli_fetch_array($select_specified_test);

          $res3=$data3['other_specification'];

          $res3=explode(";",$res3);

          $count3=count($res3)-1;
          for($i=0; $i<=$count3;$i++){
         ?>
            <p>
            <?php //echo $res3[$i]; ?>
          </p>
          <?php
          }
          ?>
             </div>

             <div class="lab-btn-op">
             <button class="btn1" onclick="window.history.pushState({ id: '100' },'Page 2', '/HMS/laboratory.php?PN=<?php echo $row_fetch_lab['hospital_patient_no']; ?>'); return changeLabDet();">View details</button>
             <button class="btn2"  onclick="window.history.pushState({ id: '100' },'Page 2', '/HMS/laboratory.php?PN=<?php echo $row_fetch_lab['hospital_patient_no']; ?>');">Add test Results</button>
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
        while($row_comp = mysqli_fetch_assoc($select_comp_patient_data)){
        ?>
        <div class="lab-single">
          <div class="patient-det">
          <label><strong>patient Name: </strong><span><?php echo $row_comp["patient_name"]; ?></span></label>
          <label><strong>Reg No: </strong><span><?php echo $row_comp["hospital_patient_no"]; ?></span></label>
          <label><strong>OPD No.: </strong><span><?php echo $row_comp["odp_no"]; ?></span></label>
          <label><strong>Sample No.: </strong><span><?php echo $row_comp["sample_no"]; ?></span></label> 
           </div>
           <div class="lab-btn-op">
             <button class="btn11" onclick="window.history.pushState({ id: '100' },'Page 2', '/HMS/laboratory.php?PN=<?php echo $row_comp['hospital_patient_no']; ?>'); return changeLabDetComp();">View Details</button>
             <button class="btn22" onclick="window.history.pushState({ id: '100' },'Page 2', '/HMS/laboratory.php?PN=<?php echo $row_comp['hospital_patient_no']; ?>');">Edit</button>
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

<script>
          $('.btn2').click(function(){
        $('#patient-laborder-card').addClass('active')
        });
        
       
        $('#patient-laborder-card .field-form #canel-field-form').click(function(){
        $('#patient-laborder-card').removeClass('active')
        });


        $('.btn1').click(function(){
        $('#patient-view-card').addClass('active')
        });
        
       
        $('#patient-view-card .field-form #canel-field-form').click(function(){
        $('#patient-view-card').removeClass('active')
        });


        $('.btn22').click(function(){
        $('#patient-laborder-card-edit').addClass('active')
        });
        
       
        $('#patient-laborder-card-edit .field-form #canel-field-form').click(function(){
        $('#patient-laborder-card-edit').removeClass('active')
        });

        $('.btn11').click(function(){
        $('#patient-view-card-complete').addClass('active')
        });
        
       
        $('#patient-view-card-complete .field-form  #canel-field-form').click(function(){
        $('#patient-view-card-complete').removeClass('active')
        });
</script>

<script type="text/javascript" src="loadlab.js"></script>
<script type="text/javascript">
function changeLabDetComp(){
    const display = document.querySelector("#patient-view-card-complete .field-form .det-container"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('PN');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","LabloadComp.php?PN="+paramValue,false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
}
</script>

</body>
</html>