

<?php
@include_once 'config.php';
if(isset($_POST['add_patient'])){

  $patient_fname=mysqli_real_escape_string($conn, $_POST['text_first']);
  $patient_mname=mysqli_real_escape_string($conn, $_POST['text_middle']);
  $patient_lname=mysqli_real_escape_string($conn, $_POST['text_last']);
  $age=mysqli_real_escape_string($conn, $_POST['text_age']);
  $gender=mysqli_real_escape_string($conn, $_POST['text_gender']);

  $insurance_no=mysqli_real_escape_string($conn, $_POST['text_ins_no']);
  $insurance_company=mysqli_real_escape_string($conn, $_POST['text_company']);
  $out_patient_dept_no=mysqli_real_escape_string($conn, $_POST['text_opd']);
  $phone=mysqli_real_escape_string($conn, $_POST['text_phone']);
  $residence=mysqli_real_escape_string($conn, $_POST['text_residence']);

  // if(empty($age)){
  //   echo '<script> alert("please enter patients age");</script>';
  // }elseif(empty($patient_fname)){
  //   echo '<script> alert("please enter patient first name");</script>';
  // }
  // elseif(empty($patient_lname)){
  //   echo '<script> alert("please enter patient last name");</script>';
  // }

  //code to assign patient a unique Number
  $select_count_patients = mysqli_query($conn, "SELECT COUNT(*) FROM patient_details");
  $number_row = mysqli_fetch_array($select_count_patients);
  $total= $number_row[0] + 1;

 
  $patient_number_ext = "PN";
  $patient_hospital_No = $patient_number_ext.$total;


  echo '<script> alert("patient num = '. $patient_hospital_No .'");</script>';
  if(!empty($patient_fname) && !empty($patient_lname)){
  
    $insert="INSERT INTO patient_details(hospital_patient_no,first_name,middle_name,last_name,age,gender,insurance_no,insurance_company,odp_no,contact,residence) 
    values('{$patient_hospital_No}','{$patient_fname}','{$patient_mname}','{$patient_lname}','{$age}','{$gender}','{$insurance_no}','{$insurance_company}','{$out_patient_dept_no}','{$phone}','{$residence}')";
    $upload_new_patient= mysqli_query($conn,$insert);
  if($upload_new_patient){
    echo '<script> alert("patient added successfully");</script>';
  }else{
    echo '<script> alert("patient failed to add");</script>';
  }



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
        <link rel="stylesheet" href="patientStyle.css">
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
}
#main-content .search-bar-op-btn{
display: flex;
flex-direction: row;
justify-content: space-between;
}
#main-content .search-bar-op-btn .search-wraper{
   display: flex;
   align-items: center;
   /* border: 1px solid var(--border-color); */
   border: 1px solid crimson;
   height: 40px;
   width: 40%;

}
#main-content .search-bar-op-btn .search-wraper i{
   font-size: 30px;
   color: crimson;
  
}
#main-content .search-bar-op-btn .search-wraper input{
   height: 100%;
   width: 100%;
   font-size: 1.2rem;
}

#main-content .search-bar-op-btn  .op-btn-right{
display: flex;
height: 40px;
}
#main-content .search-bar-op-btn  .op-btn-right button{
   background: crimson;
   color: var(--white);
   padding: .5rem 1rem;
}
#main-content .search-bar-op-btn  .op-btn-right .sort-btn{
   border: 1px solid var(--border-color);
   margin-left: .5rem;
   width: 150px;
   position: relative;
  
}
#main-content .search-bar-op-btn  .op-btn-right .sort-btn label{
display: flex;
flex-direction: row;
align-items: center;
height: 100%;

}
#main-content .search-bar-op-btn  .op-btn-right .sort-btn .sort-list{
background: var(--white);
border: 1px solid var(--border-color);
padding: .5rem;
position: absolute;
width: 100%;
display: none;
}
#main-content .search-bar-op-btn  .op-btn-right .sort-btn .sort-list.isactive{
   display: initial;
   }
#main-content .search-bar-op-btn  .op-btn-right .sort-btn .sort-list p{
   /* background: #27ae60; */
   border-radius: 5px;
   margin-top: .5rem;
   cursor: pointer;
   color: var(--color-dark);
}
#main-content .search-bar-op-btn  .op-btn-right .sort-btn .sort-list p:hover{
   background: var(--coolor);
   color: var(--white);
}
#sort-save{
   padding-left: .5rem;
   color: var(--main-color);
}


#main-content .patient-list{
   padding: 1rem;
   background: var(--white);
    width: 100%;
    margin-top: 10px;
   max-height: 600px;
   
}
#main-content .patient-list h1{
    color: crimson;
    font-weight: 500;
    padding: .5rem;
}
#main-content .patient-list .patient-list-body .match-header{
   display: flex;
   flex-direction: row;
   border-bottom: 1px solid var(--color-dark);
   min-width: 600px;

}
#main-content .patient-list .patient-list-body .match-header label{
   color: var(--main-color);
   margin: 0 auto;


}
#s1{
   width: 15%;

}
#s2{
   width: 10%;
  
}
#s3{
   width: 20%;
   
}
#s4{
   width: 15%;
  
}
#s5{
   width: 10%;

}
#s6{
   width: 20%;

}

.patient-list .patient-list-body{
overflow-y: auto;
max-height: 550px;
}
#main-content .patient-list .match-body{
   display: flex;
   flex-direction: row;
  border-bottom: 1px solid var(--border-color);
  padding-top: .5rem;
  padding-bottom: .5rem; 
  border-radius: 5px;
  min-width: 600px;

}
#main-content .patient-list .match-body:hover{
   background: rgba(65,105,255, 0.3);
}
#main-content .patient-list .match-body label{
   margin: 0 auto;
}
#main-content .patient-list .match-header label{
   font-size: .8rem;
}
#main-content .patient-list .match-body label p{
   color: var(--color-dark);
   font-size: .7rem;
}
#s1 p, #s2 p, #s3 p, #s4 p #s5 p, #s6 p{
   overflow: hidden;
   display: -webkit-box;
   -webkit-box-orient: vertical;
   -webkit-line-clamp: 2;
   white-space: pre-wrap;
}
#zero-list-style label h2{
color: crimson;
text-align: center;
padding: .5rem;
}

#patient-reg-card{
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
#patient-reg-card.active{
   display: initial;
}
#patient-reg-card .field-form{
   width: 50%;
   background-color: var(--white);
   height: 95%;
   margin: 0 auto;
   padding: 1rem;
   overflow-y: scroll;
   /* border-radius: 10px; */
}
#patient-reg-card .field-form #canel-field-form{
 float: right;
 padding: 1rem;
 border-radius: 10px;
}
#patient-reg-card .field-form #canel-field-form:hover{
   background: var(--border-color);
}
#patient-reg-card .field-form h2{
   color: crimson;
   text-align: center;
}
#patient-reg-card .field-form .input-wrapper{
display: flex;
flex-direction: column;
/* margin-top: 10px; */
margin: 0 auto;
margin-top: 20px;
width: 100%;
/* background: #1D2231; */
}
#patient-reg-card .field-form .input-wrapper input{
   padding: .5rem;
   border: 1px solid var(--text-grey);
   width: 100%;
   height: 100%;
   font-size: 1.2rem;
   border-radius: 10px;

}
#patient-reg-card .field-form .input-wrapper label{
   font-size: 1.2rem;
   color: var(--main-color);
}
#patient-reg-card .field-form .input-wrapper select{
   padding: .5rem;
   border: 1px solid var(--text-grey);
   width: 100%;
   height: 100%;
   font-size: 1.2rem;
   border-radius: 5px;

}
#patient-reg-card .field-form .btn-wrapper{
margin: 0 auto;
margin-top: 20px;
width: 50%;
}
#patient-reg-card .field-form .btn-wrapper button{
   background: crimson;
   color: var(--white);
   padding: .5rem 1rem;
   width: 100%;
   font-size: 1.5rem;
   cursor: pointer;

}
#patient-reg-card .field-form .btn-wrapper button:hover{
   opacity: .7;
}





   #patient-op-btns{
    width: 100%;
    background: var(--white);
    border-radius: 10px;
    padding: 1rem;
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: flex-start;
   }
   #patient-op-btns button{
       color: var(--white);
       padding: .5rem 1rem;
       font-size: 1.1rem;
       margin: .5rem;
       border-radius: 5px;
     cursor: pointer;
   }
   #patient-op-btns button i{
       padding-right: .2rem;
   }
   #btn1{
       background: var(--color-dark);
   }
   #btn2{
       background: var(--green);
   }
   #btn3{
       background: var(--main-color);
   }
   #btn4{
       background: crimson;
   }
   #patient-op-btns button:hover{
    opacity: .7;
     }

     
#search-patient-hist .search-wraper{
   display: flex;
   align-items: center;
   /* border: 1px solid var(--border-color); */
   border: 1px solid crimson;
   height: 40px;
   width: 40%;

}
#search-patient-hist .search-wraper i{
   font-size: 30px;
   color: crimson;
  
}
#search-patient-hist .search-wraper input{
   height: 100%;
   width: 100%;
   font-size: 1.2rem;
}
#search-patient-hist{
   margin-top: 10px;
}
.footer-det{
   margin-top: 20px;
   margin-bottom: 40px;
   height: 50px;
}
@media(max-width: 920px){
   #main-content .search-bar-op-btn{
      flex-direction: column-reverse;
       }
       #main-content .search-bar-op-btn .search-wraper{
         
           width: 90%;
       
       }
       #main-content .search-bar-op-btn  .op-btn-right{
      
           justify-content: space-between;
         margin-bottom: 10px;
           }
           #patient-reg-card .field-form{
               width: 80%;
            
           }

}
   
   
   

  </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>
<section id="patient-reg-card">
   
    <div class="field-form">
      
  <form method="post" action="<?php $_PHP_SELF ?>">
  <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
 <h2>Add New Patient</h2>

 <div class="input-wrapper">
  <label>First Name *</label>
  <input type="text" name="text_first" placeholder="please enter first name" required>
 </div>

 <div class="input-wrapper">
  <label>Middle Name</label>
  <input type="text" name="text_middle" placeholder="please enter middle name">
 </div>

 <div class="input-wrapper">
  <label>Last Name*</label>
  <input type="text" name="text_last" placeholder="please enter last name" required>
 </div>


 <div class="input-wrapper">
  <label>Age</label>
  <input type="text" name="text_age" placeholder="please enter patient age">
 </div>


 <div class="input-wrapper">
  <label>Gender</label>
  <!-- <input type="text" placeholder="please enter last name"> -->
  <select name="text_gender">
    <option value="">--Select Gender--</option>
     <option value="male">male</option>
      <option value="female">female</option>
  </select>
 </div>

 <div class="input-wrapper">
  <label>Insurance Member No.</label>
  <input type="text" name="text_ins_no" placeholder="please enter patient Insurance Member Number">
 </div>

 <div class="input-wrapper">
  <label>Insurance Company</label>
  <input type="text" name="text_company" placeholder="please enter patient Insurance Company name">
 </div>


 <div class="input-wrapper">
  <label>Opd NO.</label>
  <input type="text" name="text_opd" placeholder="please enter patient Opd Number">
 </div>

 <div class="input-wrapper">
  <label>Contact</label>
  <input type="text" name="text_phone" placeholder="please enter patient Contact phone">
 </div>

 <div class="input-wrapper">
  <label>Residence</label>
  <input type="text" name="text_residence" placeholder="please enter patient Residence">
 </div>

 <div class="btn-wrapper">
<button type="submit" name="add_patient">Add Patient</button>
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
   <h2>Patients</h2>
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
    <div class="search-bar-op-btn">
  <div class="search-wraper">
 <input type="search" placeholder="search here...">
 <i class="fa-solid fa-magnifying-glass"></i>
  </div>

  <div class="op-btn-right">
 <button><i class="fa-solid fa-add"></i> New Patient</button>
 <div class="sort-btn">
<label><p>Sort by</p> <i class="fa-solid fa-angle-down"></i><p id="sort-save">Default</p></label>
<div class="sort-list">
    <p id="1-sort">Date</p>
    <p id="2-s">Name</p>
    <p>number of Visits</p>
</div>
 </div>
  </div>
    </div>
   
    <?php
$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details");
?>
   <div class="patient-list">
   <h1>Patient List</h1>
  <div class="patient-list-body">
  <div class="match-header">
  <label id="s1"><strong>Name</strong></label>
    <label id="s2"><strong>ODP No.</strong></label>
    <label id="s3"><strong>HSPT Unique No.</strong></label>
    <label id="s4"><strong>Insurance No.</strong></label>
    <label id="s5"><strong>contact</strong></label>
    <label id="s6"><strong>Residence</strong></label>
  </div> 

  <?php
 if(mysqli_num_rows($select_patient_data) > 0){
  ?>

<?php
  while($row = mysqli_fetch_assoc($select_patient_data)){ 
  ?>

  <div class="match-body" onclick="window.location.href='patientCard.php?patient_id=<?php echo $row['hospital_patient_no']; ?>'">
    <label id="s1"><p><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']; ?></p></label>
    <label id="s2"><p><?php echo $row['odp_no']; ?></p></label>
    <label id="s3"><p><?php echo $row['hospital_patient_no']; ?></p></label>
    <label id="s4"><p><?php echo $row['insurance_no']; ?></p></label>
    <label id="s5"><p><?php echo $row['contact']; ?></p></label>
    <label id="s6"><p><?php echo $row['residence']; ?></p></label>
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
        $('#main-content .search-bar-op-btn  .op-btn-right button').click(function(){
        $('#patient-reg-card').addClass('active')
        });
        
       
        $('#canel-field-form').click(function(){
        $('#patient-reg-card').removeClass('active')
        });




     


        $(function(){ 

            $("#main-content .search-bar-op-btn  .op-btn-right .sort-btn label").click(function (e) {
    e.stopPropagation();
    $("#main-content .search-bar-op-btn .op-btn-right .sort-btn .sort-list").addClass("isactive");

});    
$('main').click(function(){
if( $("#main-content .search-bar-op-btn .op-btn-right .sort-btn .sort-list").hasClass("isactive") ){

      $("#main-content .search-bar-op-btn .op-btn-right .sort-btn .sort-list").removeClass("isactive");
      };
    });

    $('#main-content').click(function(){
if( $("#main-content .search-bar-op-btn .op-btn-right .sort-btn .sort-list").hasClass("isactive") ){

      $("#main-content .search-bar-op-btn .op-btn-right .sort-btn .sort-list").removeClass("isactive");
      };
    });
}); 




  </script>      

</body>
</html>