<?php
@include 'config.php';

$current_date = date("Y-m-d");
$tested="tested";
$not_tested="not_tested";
 
$hospital_patient_no=mysqli_real_escape_string($conn, $_GET['PN']);

if($hospital_patient_no !=""){
    $select_single_inco_patient_data = mysqli_query($conn, "SELECT * FROM patient_laboratory WHERE request_date='{$current_date}' AND status='{$not_tested}' AND hospital_patient_no='{$hospital_patient_no}'");
 
    if(mysqli_num_rows($select_single_inco_patient_data) > 0){
     $row_fetch_lab = mysqli_fetch_assoc($select_single_inco_patient_data);
     
     echo "<label><strong>Patient Name: </strong>".$row_fetch_lab['patient_name']."</label>
     <label><strong>Reg No: </strong>".$row_fetch_lab['hospital_patient_no']."</label>
     <label><strong>OPD No.: </strong>".$row_fetch_lab['odp_no']."</label>
     <label><strong>Ordered By: </strong>".$row_fetch_lab['patient_name']."</label>
     <label><strong>Date: </strong>".$row_fetch_lab['request_date']." at: ".$row_fetch_lab['request']."</label>";

     
     $select_specified_test = mysqli_query($conn, "SELECT test_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
   
     $data1=mysqli_fetch_array( $select_specified_test);

     $res1=$data1['test_specification'];

     $res1=explode(";",$res1);

     $count1=count($res1)-1;

     echo "<div class='specifics-det'>
     <label><strong>Specifications:</strong></label>";

     for($i=0; $i<=$count1;$i++){
     
        echo"<p>".$res1[$i]."</p>";

         }
        echo "</div>";


 
        $select_specified_test = mysqli_query($conn, "SELECT sample_list FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
      
        $data2=mysqli_fetch_array($select_specified_test);

        $res2=$data2['sample_list'];

        $res2=explode(";",$res2);

        $count2=count($res2)-1;

        echo "<div class='specifics-det'>
        <label><strong>Sample to Collect:</strong></label>";
        for($i=0; $i<=$count2;$i++){

          
        echo "<p>".$res2[$i]."</p>";
      
        }
        echo "</div>";



        $select_specified_test = mysqli_query($conn, "SELECT other_specification FROM patient_laboratory WHERE hospital_patient_no='{$row_fetch_lab['hospital_patient_no']}' AND request_date='{$current_date}'");
        
        $data3=mysqli_fetch_array($select_specified_test);

        $res3=$data3['other_specification'];

        $res3=explode(";",$res3);

        $count3=count($res3)-1;
      
   
        echo "<div class='specifics-det'>
        <label><strong>Other Specifications:</strong></label>";
   
        for($i=0; $i<=$count3;$i++){
        
           echo"<p>".$res3[$i]."</p>";
   
            }
           echo "</div>";
       
   


     }else{
        echo "<div id='zero-list-style'>
        <label><h2>No Data Available</h2></label>
      </div>";
     }

}else{

}




?>