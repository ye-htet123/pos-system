

<?php include('includes/header.php');

// if(!isset($_SESSION['productItems'])){
//    echo '<script> window.location.href="orders-created.php" ;</script>';

// }
 ?>


<div class="modal fade"  data-bs-backdrop="static"data-bs-backdrop="false"  id="orderSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
       <div class="mb-3 p4">
        <h5 id="orderPlaceSuccessMessage"></h5>
        </div>

      
      </div>




        <div class="modal-footer">
            <a href="orders.php" class="btn btn-secondary">Close</a>
            <button type="button" onclick="printMyBillingArea()" class="btn btn-danger">Print</button>
            <button type="button" onclick="downloadPDF('<?=$_SESSION['invoice_no'];?>')" class="btn btn-warning">Download PDF</button>
        </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Order Summary 
                    <a href="orders-created.php" class="btn btn-danger float-end"> Back to create order</a>
                </h4>
            </div>
            <div class="card-body">
                <?php   alertMessage();?>

                <div id="myBillingArea">

                    <?php  if(isset($_SESSION['cphone'])){
                        $phone= validate($_SESSION['cphone']);
                        $invoiceNo= validate($_SESSION['invoice_no']);

                        $customerQuery= mysqli_query($conn, "SELECT * FROM customers WHERE phone= '$phone' LIMIT 1");
                        if($customerQuery){
                            if(mysqli_num_rows($customerQuery) > 0){
                                $cRowData = mysqli_fetch_assoc($customerQuery);


                                ?>

<table class="m-12" style="width: 100%; margin-left: 130px;">

<tr>
    <td></td>
    <td>
        <div>
            <div>
                <h5 style="margin-bottom: 15px;">Company Details</h5>
                <p style="margin: 0;">Company Name: ABC Corp</p>
                <p style="margin: 0;">Address: 5678 Oak Street</p>
                <p style="margin: 0;">Phone: (987) 654-3210</p>
            </div>
        </div>
    </td>
    <td></td>
</tr>

<tr>
    <td>
        <div>
            <div>
                <h5 style="margin-bottom: 15px;">Customer Details</h5>
                                              <p style="margin: 0;">Name: <?= $cRowData['name']   ?></p>
                                              <p style="margin: 0;">Phone: <?= $cRowData['phone']   ?></p>
                                              <p style="margin: 0;">Email: <?= $cRowData['email']   ?></p>

            </div>
        </div>
    </td>
    <td></td>
    <td>
        <div>
            <div>
            <h5 style="margin-bottom: 15px;">Invoice Details</h5>
                                              <p style="margin: 0;">Invoice Number: INV-<?= $invoiceNo; ?></p>
                                              <p style="margin: 0;">Date: <?= date(' d M Y')   ?></p>
                                              <p style="margin: 0;">Address :  12 street LanbaTaw PYAY</p>
            </div>
        </div>
    </td>
</tr>
</table>



                                  <?php
                              }else{
                              echo    "<h5> NO customer Found</h5>";
                              }
                                
                              
                          }

                      } 
                      
                      ?>

                      <?php 
                      
                      if(isset($_SESSION['productItems'])){
                              $sessionProducts =$_SESSION['productItems'];
                              ?>
                        <div class="table-responsive mb-3">
                          <table style="width:80%;" align="center" cellpadding="10">

                            <thead>

                            <tr>

                            <th align="start" style="border-bottom: 1px solid  #ccc;text-align:center;" width:"15%">ID</th>
                            <th  colspan="2"  align="start" style="border-bottom: 1px solid  #ccc;text-align:center;">Product name   </th>
                            <th align="start" style="border-bottom: 1px solid  #ccc;text-align:center;" width:"10%">Price</th>
                            <th align="start" style="border-bottom: 1px solid  #ccc;text-align:center;" width:"10%">Quantity</th>
                            <th align="start" style="border-bottom: 1px solid  #ccc;text-align:center;" width:"15%">Total Cost</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php  
                            $i =1;
                            $totalAmount = 0;
                            foreach($sessionProducts as $key => $row):

                                $totalAmount += $row['price'] * $row['quantity']


                            
                            
                            ?>
                            <tr>

                                  <td  style="border-bottom: 1px solid  #ccc;text-align:center;"><?= $i++ ; ?></td>
                                  <td   style="border-bottom: 1px solid  #ccc;text-align:center;"><img src="../<?= $row['image']; ?>" style="width:80px;height:70px;" alt="Img"></td>
                                  <td><?=$row['name'] ;?> </td>
                                  <td  style="border-bottom: 1px solid  #ccc;text-align:center;"><?= number_format($row['price'],0) ; ?></td>
                                  <td  style="border-bottom: 1px solid  #ccc;text-align:center;"><?= $row['quantity'] ; ?></td>
                                  <td  style="border-bottom: 1px solid  #ccc;text-align:center;" class="fw-bold"><?= number_format($row['price'] * $row['quantity'],0) ; ?>
                                  </td>
                                  </tr>
                            <?php  endforeach; ?>
                                <tr>

                                <td colspan="5"  align="end" style=" font-weight: bold;" >  </td>
                                <td colspan="1"  style="font-wieght: bold;text-align:center;"><b> Grand Total: </b><?= number_format($totalAmount,0);  ?></td>

                                </tr>
                                <tr>


                                <td colspan="5" >Payment Method: <?=   $_SESSION['payment_mode']; ?></td>
                                </tr>


                            </tbody>
                            </table>

                        </div>


                                                        <?php

                                                }

                                                else{
                                                echo   ' <h5 class="text-center">NO Items added</h5>';
                                                }
                                                ?>
                     </div>

                </div>


                <div class="mt-4 text-end">
                  <button class="btn btn-primary px-4 mx-5 mb-4  " id="saveOrder">

                  save
                  </button>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printMyBillingArea() {
        var divContents = document.getElementById("myBillingArea").innerHTML;
        var a = window.open('', '');
        a.document.write('<html><head><title>POS system in PHP</title></head>');
        a.document.write('<body style="font-family: fangsong;">');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const { jsPDF } = window.jspdf;

        function downloadPDF(invoiceNo) {
            var docPDF = new jsPDF();
            var elementHTML = document.querySelector("#myBillingArea");

            docPDF.html(elementHTML, {
                callback: function (doc) {
                    doc.save(invoiceNo + '.pdf');
                },
                x: 15,
                y: 15,
                width: 170,
                windowWidth: 650
            });
        }

        window.downloadPDF = downloadPDF; // Ensure function is accessible globally if needed
    });
</script>
<?php include('includes/footer.php'); ?>