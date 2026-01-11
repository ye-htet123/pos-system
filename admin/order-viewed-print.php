<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0"> Print Orders
                <a href="orders.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

        <div id="myBillingArea">

            <?php  
            if(isset($_GET['track'])){

                $trackingNo=validate($_GET['track']);
                if($trackingNo == ''){


                    ?>
                        <div class="d-flex flex-column justify-content-center align-items-center py-5">
                                    <h5>Please tracking number...</h5>
                                    <a href="orders.php" class="btn btn-primary mt-4 w-25 text-center">Go back to orders</a>
                                    </div>



                                <?php
                                    }

                                    $orderQuery ="SELECT o.*,c.* FROM orders o, customers c 
                                    WHERE c.id=o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
                                    $orderQueryRes= mysqli_query($conn, $orderQuery);
                                    if(!$orderQueryRes){

                                        echo "<h5>Something went wrong</h5>";
                                        return false;
                                    }

                                    if(mysqli_num_rows($orderQueryRes) > 0){

                                        $orderDataRow =mysqli_fetch_assoc($orderQueryRes);
                                        //print_r($orderDataRow);

                                        ?>
              <style>
/* Base screen styling */
.print-table {
    margin-left: 130px;
   
}
 .col-md-12 {
        text-align: center;
    }
 .thr-column {
        text-align: right;
    }
.resp-card{
    display: none;
}
.table-context{
         
        width:50%; 
        margin-left: 120px;
 }

/* Print-specific styling */
    @media print {
        body {
            margin: auto;
            padding: auto;
            font-family: Arial, sans-serif;
            font-size: 12pt;
            background-color: #fff;
            color: #000;
        }
        .col-md-12 {
            text-align: center;
        }
       
        .col-md-6 {
            display: none;
        }
        .print-table{
            display: none;
        }
        
    }

    
    @media (max-width: 1000px){
        .col-md-6{
            text-align: center;
            margin-right: 50rem;

        }
        .col-md-6{
            text-align: center;
        }
         .resp-card{
            display: block;
        }
        .table-context{
             padding: 0.2rem;
        font-size: 0.5rem;
        margin-left: 40px;
        }
            
    }
    /* PDF specific layout */
                        .pdf-layout {
                            font-family: Arial, sans-serif;
                            font-size: 12pt;
                            background-color: #fff;
                            color: #000;
                            margin-right: 1000px;
                        }
                        .pdf-layout .col-md-6 {
                            display: none;
                        }
                        .pdf-layout .print-table {
                            display: none;
                        }
                        .pdf-layout .resp-card {
                            display: block;
                            border: none;
                        }
                        .pdf-layout .table-context {
                            width: 80%;
                            margin-left: 100px;
                        }
                        .pdf-layout img {
                            max-width: 50px;
                            max-height: 60px;
                        }
                        .pdf-layout table, .pdf-layout th, .pdf-layout td {
                            border: 1px solid #ccc;
                            border-collapse: collapse;
                            text-align: center;
                            padding: 5px;
                        }
</style>

<div class=" mb-4 resp-card d-block d-lg-none">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="margin-bottom: 15px;">Company Details</h5>
                <p style="margin: 0;">Company Name: ABC Corp</p>
                <p style="margin: 0;">Address: 5678 Oak Street</p>
                <p style="margin: 0;">Phone: (987) 654-3210</p>
                                <br>
                            </div>
                         </div>
                    <div class="row">
                        <div class="col-md-6 snd-column">
                             <div class="d-none d-md-block"> <!-- Hides on small screens -->
        <h5>Customer Details</h5>
                <p style="margin: 0;">Name: <?= $orderDataRow['name'] ?></p>
                <p style="margin: 0;">Phone: <?= $orderDataRow['phone'] ?></p>
                <p style="margin: 0;">Email: <?= $orderDataRow['email'] ?></p>
        </div>
                            <br>
                        </div>
                        <div class="col-md-6 thr-column">
                           <div class="d-none d-md-block"> <!-- Hides on small screens -->
        <h5>Invoice Details</h5>
                <p style="margin: 0;">Invoice Number: <?= $orderDataRow['tracking_no'] ?></p>
                <p style="margin: 0;">Date: <?= date('d M Y') ?></p>
                <p style="margin: 0;">Address: 12 street LanbaTaw PYAY</p>
        </div>
                            <br>
                            
                            
                        </div>
                    </div>
</div>

            <div class="d-none d-lg-block">
                    <table class="print-table" >
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
                            <div class="d-none d-md-block"> <!-- Hides on small screens -->
                            <h5>Customer Details</h5>
                                    <p style="margin: 0;">Name: <?= $orderDataRow['name'] ?></p>
                                    <p style="margin: 0;">Phone: <?= $orderDataRow['phone'] ?></p>
                                    <p style="margin: 0;">Email: <?= $orderDataRow['email'] ?></p>
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <div class="d-none d-md-block"> <!-- Hides on small screens -->
                            <h5>Invoice Details</h5>
                                    <p style="margin: 0;">Invoice Number: <?= $orderDataRow['tracking_no'] ?></p>
                                    <p style="margin: 0;">Date: <?= date('d M Y') ?></p>
                                    <p style="margin: 0;">Address: 12 street LanbaTaw PYAY</p>
                            </div>
                        </td>
                    </tr>

                     </table>
              </div>


                    <?php
                        }else{
                            echo "<h5>No data found</h5>";
                            return false;
                        }

                        $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice,O.*, oi.*, p.* FROM orders o,
                        order_items oi, products p WHERE oi.order_id=o.id AND
                        p.id=oi.product_id AND
                        o.tracking_no='$trackingNo' ";
                        $orderItemQueryRes =mysqli_query($conn, $orderItemQuery);
                        if($orderItemQueryRes){

                            if(mysqli_num_rows($orderItemQueryRes) > 0){


                                ?>

                            <div class="table-responsive mb-6">
                            <table  class="table-context"  align="center" cellpadding="10">

                                <thead>

                                <tr>

                                <th align="start" style="border-bottom: 1px solid  #ccc;text-align: center;" width:"15%">No</th>
                                <th align="start" colspan="2" style="border-bottom: 1px solid  #ccc;text-align: center;">Product name</th>
                                <th align="start" style="border-bottom: 1px solid  #ccc;text-align: center;" width:"10%">Price</th>
                                <th align="start" style="border-bottom: 1px solid  #ccc;text-align: center;" width:"10%">Quantity</th>
                                <th align="start" style="border-bottom: 1px solid  #ccc;text-align: center;" width:"15%">Total Cost</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php  
                                $i = 1;
                                $totalAmount = 0;
                                foreach($orderItemQueryRes as $key => $row):

                                // $totalAmount += $row['price'] * $row['quantity']


                                
                                
                                ?>
                                <tr>

                                    <td  style="border-bottom: 1px solid  #ccc;text-align: center;"><?= $i++ ; ?></td>
                                    <td  style="border-bottom: 1px solid  #ccc;text-align: center;"><img src="../<?= $row['image']; ?>" style="width:50px;height:60px;" alt="Img"></td>
                                    <td><?=$row['name'] ;?></td>
                                    <td  style="border-bottom: 1px solid  #ccc;text-align: center;"><?= number_format($row['orderItemPrice'],0) ; ?></td>
                                    <td  style="border-bottom: 1px solid  #ccc;text-align: center;"><?= $row['orderItemQuantity'] ; ?></td>
                                    <td  style="border-bottom: 1px solid  #ccc;text-align: center;" class="fw-bold">
                                        <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'],0) ; ?>
                                    </td>
                                    </tr>
                                <?php  endforeach; ?>
                                    <tr>

                                    <td colspan="5"  align="end" style=" font-weight: bold;" >  </td>
                                    <td colspan="1"  style="font-wieght: bold;"><b> Grand Total: </b><?= number_format($row['total_amount'],0);  ?></td>

                                    </tr>
                                    <tr>


                                    <td colspan="5" >Payment Method: <?=   $row['payment_mode']; ?></td>
                                    </tr>


                                </tbody>
                                </table>

                            </div>

                                    <?php

                            }else{

                                echo "<div class='d-flex flex-column justify-content-center align-items-center py-5'>
                                <h5>No Data found</h5>";
                                return false;
                            }
                            
                            
                            
                            
                        }else{
                            echo "<h5>Something went wrong</h5>";
                            return false;
                        }

                    }else{



                    
                    ?>


                    <div class="d-flex flex-column justify-content-center align-items-center py-5">
                        <h5>No tracking number Parameter found</h5>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25 text-center">Go back to orders</a>
                        </div>



                    <?php
                    }
                    
                    
                    
                    
                    
            ?>

        </div>

        <div class="mt-4 text-end">
            <button class="btn btn-danger px-4 mx-1"
             onclick="printMyBillingArea()">Print</button>
             
            <button class="btn btn-danger px-4 mx-1" 
            onclick="downloadPDF('<?=$orderDataRow['invoice_no'];?>')">download PDF</button>

        </div>
        </div>
    </div>
</div>

<script>
    function printMyBillingArea(){

var divContents= document.getElementById("myBillingArea").innerHTML;
var a= window.open(' ', ' ');
a.document.write('<html><title> POS system in php</title>');
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
                width: 150,
                windowWidth: 650
            });
           
        }

        window.downloadPDF = downloadPDF; // Ensure function is accessible globally if needed
    });
</script>

<?php include('includes/footer.php'); ?>