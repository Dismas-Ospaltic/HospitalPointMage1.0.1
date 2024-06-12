<?php 
  require ("fpdf/fpdf.php");

  //customer and invoice details

  $info=[
    "customer"=>"",
    "address"=>"",
    "city"=>"",
    "invoice_no"=>"",
    "invoice_date"=>"",
    "invoice_time"=>"",
    "total_amt"=>"",
    "words"=>"kenya shiling",
  ];

  include 'config.php';
  $select_patient_invoice_data = mysqli_query($conn, "SELECT * FROM hospital_invoice WHERE hospital_patient_no='{$_GET["PN"]}'");
  if(mysqli_num_rows($select_patient_invoice_data) > 0){
    while($row1 = mysqli_fetch_assoc($select_patient_invoice_data)){

      $info=[
        "customer"=>$row1["patient_name"],
        "address"=>$row1["patient_residence"],
        "city"=>"",
        "invoice_no"=>$row1["invoice_num"],
        "invoice_date"=>$row1["invo_date"],
        "invoice_time"=>$row1["invo_time"],
        "total_amt"=>$row1["grand_total"],
        "words"=>"kenya shiling",
      ];

    }


  }
  //invoice Products
  $products_info=[];
  $select_product_invoice_data = mysqli_query($conn, "SELECT * FROM invoce_product WHERE hospital_patient_no='{$_GET["PN"]}'");
 
  if(mysqli_num_rows($select_product_invoice_data) > 0){
    while($row = mysqli_fetch_assoc($select_product_invoice_data)){

      $products_info[]=[
        
          "name"=>$row["product_name"],
          "price"=>$row["price"],
          "qty"=>$row["qty"],
          "total"=>$row["total"]
       
     
      ];

    }


  }

  
  
  class PDF extends FPDF
  {
    
  
    function body($info,$products_info){
       //Display Company Info
       $this->SetFont('Arial','B',14);
       $this->Cell(50,10,"Hospital trans",0,1);
       $this->SetFont('Arial','',14);
       $this->Cell(50,7,"West Street,",0,1);
       $this->Cell(50,7,"Salem 636002.",0,1);
       $this->Cell(50,7,"PH : 8778731770",0,1);
       
       //Display INVOICE text
       $this->SetY(15);
       $this->SetX(-40);
       $this->SetFont('Arial','B',18);
       $this->Cell(50,10,"INVOICE",0,1);
       
       //Display Horizontal line
       $this->Line(0,48,210,48);


      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["city"],0,1);
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"DESCRIPTION",1,0);
      $this->Cell(40,9,"PRICE",1,0,"C");
      $this->Cell(30,9,"QTY",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],"LR",0);
        $this->Cell(40,9,$row["price"],"R",0,"R");
        $this->Cell(30,9,$row["qty"],"R",0,"C");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //Display amount in words
      // $this->SetY(-80);
      // $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Amount in Words ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["words"],0,1);
      

 
      
          //set footer position
          // $this->SetY(-50);
          $this->SetFont('Arial','B',12);
          $this->Cell(0,10,"for ABC COMPUTERS",0,1,"R");
          $this->Ln(8);
          $this->SetFont('Arial','',12);
          $this->Cell(0,-1,"Authorized Signature",0,1,"R");
          $this->SetFont('Arial','',9);
          
          //Display Footer Text
          $this->Cell(0,0,"This is a computer generated invoice",0,1,"L");
          
    
      

    }
  
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>