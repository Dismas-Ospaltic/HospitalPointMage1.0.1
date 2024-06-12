<?php
@include_once 'config.php';

$time = time();
$invoice_num = rand(time(), 10000000);
$patient_name = "Dismas Wanyala";
$residence = "Kapenguria";
$hospital_patient_num = "PN1";
$current_date = date("Y-m-d");

if(isset($_POST["save-inv"]) && isset($_POST["pname"])){
  $invoice_num = $invoice_num;
  $patient_name = $patient_name ;
  $residence = $residence;
  $hospital_patient_num = $hospital_patient_num;
  $grand_total = mysqli_real_escape_string($conn, $_POST['grand_total']);

  

  $insert="INSERT INTO hospital_invoice(patient_name,invoice_num,patient_residence,grand_total,hospital_patient_no) 
  values('{$patient_name}','{$invoice_num}','{$residence}','{$grand_total}','{$hospital_patient_num}')";
  
  $upload_new_patient_invoice= mysqli_query($conn,$insert);

  if($upload_new_patient_invoice){




//    $invoice_num = $invoice_num;
//    $hospital_patient_num = $hospital_patient_num;

   $product_name = $_POST['pname'];
   $qty =  $_POST['qty'];
   $price = $_POST['price'];
   $total = $_POST['total'];

   foreach($product_name as $key => $p_name) {

    $quantity = $qty[$key];
    $pprice = $price[$key];
    $ptotal = $total[$key];

    $sanitizedproduct_name = mysqli_real_escape_string($conn, $p_name);
    $sanitizedqty= mysqli_real_escape_string($conn, $quantity);
    $sanitizedprice = mysqli_real_escape_string($conn, $pprice);
    $sanitizedtotal = mysqli_real_escape_string($conn, $ptotal);

    $insert2="INSERT INTO invoce_product(hospital_patient_no,invoice_num,product_name,qty,price,total) values('{$hospital_patient_num}','{$invoice_num}','{$sanitizedproduct_name}','{$sanitizedqty}','{$sanitizedprice}','{$sanitizedtotal}')";
    $upload_invoice2= mysqli_query($conn,$insert2);
 

}
   if($upload_invoice2){

    //    echo '<script> alert("invoice saved successfully!");</script>';
 $select_patient_data_invo = mysqli_query($conn, "SELECT invoice_num FROM hospital_invoice WHERE invo_date ='{$current_date}'");
 if(mysqli_num_rows($select_patient_data_invo) > 0){
    $row = mysqli_fetch_assoc($select_patient_data_invo);
    $today_invo_num = $row["invoice_num"];

  echo '<div id="invoice-add-pop">
  <label>Invoice Added <a href="printinvoice.php?PN='.$hospital_patient_num.'&invoice='.$today_invo_num.'">View</a></label>
     </div>';
 }
   }else{
       echo '<script> alert("invoice failed to add 2");</script>';
   }



}
else{
    echo '<script> alert("invoice failed to add");</script>';
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
        <link rel="stylesheet" href="invoiceStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />
    <style type="text/css">
  #save-btn{
    padding: .5rem 1rem;
    color: var(--white);
    background: crimson;
    margin-top: 10px;
    font-size: 1.5rem;
    border-radius: 10px;
    /* float: right; */
 }
 #invoice-add-pop{
    margin: 0 auto;
    /* margin-top: 100px; */
    position: absolute;
    /* top:100px; */
    top: 0;
    z-index: 999;
    width: 97%;
    border-radius: 10px;
    background: var(--white);
    text-align: center;
    padding: 1rem;
    font-size: 1.5rem;
     color: var(--green);
 }

  </style>
        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>

    <main>
        <div class="header-invo">
           <label><i class="fa-solid fa-arrow-left"></i></label>
           <h1>Hospital Invoice generator</h1>
           </div>
        <div class="inv-overview">
<div class="pro-det">
<h2>Invoice Deteail</h2>
<label>
    <p>Invoice No.: <span><strong><?php echo $invoice_num; ?></strong></span></p>
</label>
</div>
<div class="cus-det">
    <h2>Customer/Patient Deteail</h2>
    <label>
        <p>Name: <span><strong><?php echo $patient_name; ?></strong></span></p>
    </label>
    <label>
        <p>Address: <span><strong><?php echo $residence; ?></strong></span></p>
    </label>
</div>
</div>

<div class="table-cont">
    <form action="<?php $_PHP_SELF ?>" method="post">
<table class="table">
<thead>
    <tr>
        <th>Product/Services</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
</thead>
<tbody id="product_tbody">
<tr>
    <td><input type="text" name="pname[]" placeholder="enter service/product name..." required></td>
    <td><input type="number" name="price[]" min="1" class="price" placeholder="enter price" required></td>
    <td><input type="number" name="qty[]" min="1" class="qty" required></td>
    <td><input type="text" name="total[]"  class="total" required></td>
    <td><input type="button" value="X" class="btn-row-remove" required></td>
</tr>
</tbody>
<tfoot>
    <tr>
        <td><input type="button" value="+ add row" id="btn-add-row"></td>
        <td colspan="2" id="text-align">Total</td>
        <td><input type="text" name="grand_total" id="grand_total" required></td>
    </tr>
</tfoot>
</table>
<input  id="save-btn" type="submit" name="save-inv" value="Save invoice">
</form>
</div>
    </main>
    <script>
        $(document).ready(function(){
            $("#btn-add-row").click(function(){
        
                var row ='<tr><td><input type="text" name="pname[]" placeholder="enter service/product name..." required></td><td><input type="number" name="price[]" min="1" class="price" placeholder="enter price" required></td><td><input type="number" name="qty[]" min="1" class="qty" required></td><td><input type="text" name="total[]"  class="total" required></td><td><input type="button" value="X" class="btn-row-remove" required></td></tr>';
                $("#product_tbody").append(row);
            });
            $("body").on("click",".btn-row-remove",function(){
                if(confirm("Remove row?")){
             $(this).closest("tr").remove();
              grand_total ();
                }
            });
            $("body").on("keyup",".price",function(){
               var price =Number($(this).val());
               var qty = Number($(this).closest("tr").find(".qty").val());
               $(this).closest("tr").find(".total").val(price*qty);
               grand_total ();
            });

            $("body").on("keyup",".qty",function(){
               var qty =Number($(this).val());
               var price = Number($(this).closest("tr").find(".price").val());
               $(this).closest("tr").find(".total").val(price*qty);
               grand_total ();
            });

            function grand_total (){
                var tot=0;
                $(".total").each(function(){
                tot += Number($(this).val());
                });
                $("#grand_total").val(tot);
            }
        });
    </script>
</body>
</html>