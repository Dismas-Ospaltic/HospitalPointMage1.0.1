<?php 
  require ("fpdf/fpdf.php");


  class PDF extends FPDF
  {
    // function Header(){
      
   
    // }
    
    function body(){
      @include 'config.php';
      $patient_unique_code = mysqli_real_escape_string($conn,$_GET["PN"]);
      $patient_visit=mysqli_real_escape_string($conn, $_GET['patient_visit']);
    
      $select_incoming_patient_discharge_data = mysqli_query($conn, "SELECT * FROM patient_sub_visits WHERE visit='{$patient_visit}' AND hospital_patient_no='{$patient_unique_code}'");
      if(mysqli_num_rows($select_incoming_patient_discharge_data) > 0){
        while($row3 = mysqli_fetch_assoc($select_incoming_patient_discharge_data)){
           $visit_date = $row3["visit_date"];
           $visit_time = $row3["visit_time"];
         

          $select_complaint = mysqli_query($conn, "SELECT cheif_complaint,doc_notes,diagnosis,medication FROM patient_sub_visits WHERE visit='{$patient_visit}' AND hospital_patient_no='{$patient_unique_code}'");
         $data1=mysqli_fetch_array($select_complaint);

          $res1=$data1['cheif_complaint'];
          $res2=$data1['doc_notes'];
          $res3=$data1['diagnosis'];
          $res4=$data1['medication'];

          $res1=explode(";",$res1);
          $res2=explode(";",$res2);
          $res3=explode(";",$res3);
          $res4=explode(";",$res4);

          $count1=count($res1)-1;
          $count2=count($res2)-1;
          $count3=count($res3)-1;
          $count4=count($res4)-1;
      
    
        }
        // $row7 = mysqli_fetch_assoc($select_incoming_patient_discharge_data);
        // $Visit_date = $row7["visit_date"];
        // $Visit_time = $row["visit_time"];
     
      $select_incoming_patient_data = mysqli_query($conn, "SELECT first_name,middle_name,last_name,age,gender,insurance_no,insurance_company,odp_no,medical_history FROM patient_details WHERE hospital_patient_no='{$patient_unique_code}'");
      $row4 = mysqli_fetch_assoc($select_incoming_patient_data);
      $patient_name = $row4["first_name"]." ".$row4["middle_name"]." ".$row4["last_name"];
      $age = $row4["age"]." Years old";
      $gender = $row4["gender"];
      $insurance_no = $row4["insurance_no"];
      $insurance_company = $row4["insurance_company"];
  
      $odp = $row4["odp_no"];
      $med_his = $row4["medical_history"];
    
    

        $this->SetFont('Arial','B',24);
        $this->SetTextColor(9, 240, 163);
        $this->Cell(0,10,'Patient visit over view Notes',0,1,'C');
        // $this->Cell(0,10,'Heading44',0,0,'C');
      
    //   //Display Horizontal line
    //   $this->Line(0,48,210,48);

      //Billing Details
    //   $this->SetY(55);
    $this->SetTextColor(0, 0, 0);
      $this->SetX(10);
      $this->SetFont('Arial','',12);
      $this->Ln(1);
      $this->MultiCell(0,10,"Patient Name: $patient_name");
      $this->MultiCell(0,10,"Sex: $gender");
      $this->MultiCell(0,10, "Age: $age" );
      $this->MultiCell(0,10,"Hospital reg No.: $patient_unique_code");
      $this->MultiCell(0,10,"ODP No.: $odp");
      $this->MultiCell(0,10,"Visited On: $visit_date at: $visit_time");
      if(!empty($insurance_no) && !empty($insurance_company)){
        $this->MultiCell(0,10, "Insurance Company: $insurance_company" );
      $this->MultiCell(0,10,"Insurance Member No.: $insurance_no");
      }
      $this->SetFont('Arial','',12);
   
    //   $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Medical History",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);

      if(!empty($med_his)){
        $select_med_history = mysqli_query($conn, "SELECT medical_history FROM patient_details WHERE hospital_patient_no='{$patient_unique_code}'");
         $data5=mysqli_fetch_array($select_med_history);
         $res5=$data5['medical_history'];

         $res5=explode(";",$res5);

         $count5=count($res5)-1;

         for($i=0; $i<=$count5;$i++){
          $split_med_his=$res5[$i];
          $this->MultiCell(0,10, " - $split_med_his");
        }

        // $this->MultiCell(0,10,"-mental");
        // $this->MultiCell(0,10,"-inver");
      }else{
      $this->MultiCell(0,10,"No Medical History To Show");
      }


      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
       $this->Cell(50,10,"Chief Complaints ",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      for($i=0; $i<=$count1;$i++){
        $split_cheif_complaint=$res1[$i];
        $this->MultiCell(0,10, "-$split_cheif_complaint");
      }
      
      // $this->MultiCell(0,10, $gen_cheif_complaint);
      // $this->MultiCell(0,10, $gen_cheif_complaint);


      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Doctor's Notes ",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      // $this->MultiCell(0,10,$gen_doc_notes);
      // $this->MultiCell(0,10,$gen_doc_notes);
      
      for($i=0; $i<=$count2;$i++){
        $split_doc_notes=$res2[$i];

        $this->MultiCell(0,10, "- $split_doc_notes");
      }

      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Diagnosis",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      for($i=0; $i<=$count3;$i++){
        $split_diagnosis=$res3[$i];

        $this->MultiCell(0,10, "- $split_diagnosis");
      }

      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Treatment And Medication",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      for($i=0; $i<=$count4;$i++){
        $split_medication=$res4[$i];

        $this->MultiCell(0,10, "- $split_medication");
      }
    }else{
      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"No Data Available",0,1);
    }
    
    }
  //   function Footer() {
  //     $this->Cell(50,10,"No Data Available",0,1);
  // } 
  function Footer() {
    // Go to 1.5 cm from the bottom
    $this->SetY(-15);
    
    // Set font and color
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(0, 0, 0);
    
    // Page number
    $this->Cell(0, 10, 'created by osszy software', 0, 0, 'C');
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
}


    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body();
  $pdf->Output();
?>
