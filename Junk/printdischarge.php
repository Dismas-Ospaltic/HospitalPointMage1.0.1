<?php 
  require ("fpdf/fpdf.php");

 
 
  
  class PDF extends FPDF
  {
    // function Header(){
      
   
    // }
    
    function body(){
      
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
      $this->MultiCell(0,10,"Patient Name: Dismas Wanyala Kizai allergens Lorem ipsum dolor sit amet consectetur,. loLorem ipsum dolor sit amet consectetur adipisicing elit. Totam iste voluptates, et voluptas pariatur");
      $this->MultiCell(0,10,"Sex: Male");
      $this->MultiCell(0,10,"Age: 30 years");
      $this->MultiCell(0,10,"Hospital reg No.: PN1");
      $this->SetFont('Arial','',12);
   
    //   $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Medical History",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      $this->MultiCell(0,10,"-allergens Lorem ipsum dolor sit amet consectetur,. loLorem ipsum dolor sit amet consectetur adipisicing elit. Totam iste voluptates, et voluptas pariatur praesentium suscipit sint ea maiores! Atque voluptatem provident pariatur tempore. Corrupti suscipit officia dolorem odio dolores!");
      $this->MultiCell(0,10,"-mental");
      $this->MultiCell(0,10,"-inver");


      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Chief Complaints ",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      $this->MultiCell(0,10,"-Acute headache");
      $this->MultiCell(0,10,"-High Fever");
      $this->MultiCell(0,10,"-Vommiting");


      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Doctor's Notes ",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      $this->MultiCell(0,10,"-blue magenta");
      $this->MultiCell(0,10,"-highened");
      $this->MultiCell(0,10,"-meddi");

      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Diagnosis",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      $this->MultiCell(0,10,"-malria");
      $this->MultiCell(0,10,"-bacterial infection");
      $this->MultiCell(0,10,"-meddi");

      $this->SetFont('Arial','B',14);
      $this->SetTextColor(9, 240, 163);
      $this->Ln(1);
      $this->Cell(50,10,"Treatment And Medication",0,1);

      $this->SetFont('Arial','',12);
      $this->SetTextColor(0, 0, 0);
      $this->MultiCell(0,10,"azodicine  1*2 - 29mg/l");
      $this->MultiCell(0,10,"azodicine  1*2 - 29mg/l");
      $this->MultiCell(0,10,"azodicine  1*2 - 29mg/l");
    
    }
    function Footer(){ 
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body();
  $pdf->Output();
?>