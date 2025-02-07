<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Orders View</h4>
            <a href="order-viewed-print.php?track=<?= $_GET['track']?>" class="btn btn-info mx-2 btn-sm  float-end">Print</a>
            <a href="orders.php" class="btn btn-primary mx-2 btn-sm float-end">Back</a>

        </div>
        <div class="card-body">
        <?php alertMessage(); ?>

        <?php
        if(isset($_GET['track'])){

            if($_GET['track']==''){

                ?>
            <div class="d-flex flex-column justify-content-center align-items-center py-5">
             <h5>No tracking number found</h5>
            <a href="orders.php" class="btn btn-primary mt-4 w-25 text-center">Go back to orders</a>
            </div>

                <?php
                return false;
            }
            
            $trackingNO= validate($_GET['track']);

        
            $query= "SELECT o.*,c.* FROM orders o,customers c WHERE c.id=o.customer_id AND tracking_no='$trackingNO' ORDER BY o.id DESC";

            $orders =mysqli_query($conn, $query);
            if($orders){
                if(mysqli_num_rows($orders) > 0){
                    $orderData = mysqli_fetch_assoc($orders);
                    $orderId = $orderData['id'];

                
                    ?>
                    <div class="card card-body shadow border-1 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Order Details</h4>

                            <label for="" class="mb-1">
                                Tracking No: <span class="fw-bold">  <?=  $orderData['tracking_no'];?></span>
                            </label>
                            <br>

                            <label for="" class="mb-1">
                                Order Date: <span class="fw-bold">  <?=  $orderData['order_date'];?></span>
                            </label>
                            <br>
                            
                            <label for="" class="mb-1">
                              Order Status <span class="fw-bold">  <?=  $orderData['order_status'];?></span>
                            </label>
                            <br>
                            
                            <label for="" class="mb-1">
                                Payment Mode: <span class="fw-bold">  <?=  $orderData['payment_mode'];?></span>
                            </label>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <h4>Customer Details</h4>

                            <label for="" class="mb-1">
                                 Full Name :  <span class="fw-bold">  <?=  $orderData['name'];?></span>
                            </label>
                            <br>

                            <label for="" class="mb-1">
                                 Email  Address :<span class="fw-bold">  <?=  $orderData['email'];?></span>
                            </label>
                            <br>
                            
                            <label for="" class="mb-1">
                              Phone number : <span class="fw-bold">  <?=  $orderData['phone'];?></span>
                            </label>
                            <br>
                            
                            
                        </div>
                    </div>
                    </div>


                    <?php  
                    $orderItemQuery= "SELECT p.image as productImage,p.name as productName,oi.quantity as orderItemQuantity,oi.price as orderItemPrice, o.*, oi.* FROM orders as o, 
                    order_items as oi, products as p WHERE oi.order_id = o.id AND p.id=oi.product_id 
                    AND o.tracking_no='$trackingNO'";

                    $orderItemsRes =mysqli_query($conn, $orderItemQuery);
                    if($orderItemsRes){
                        if(mysqli_num_rows($orderItemsRes) > 0){


                            ?>
                            <h4 class="my-3">Order Items Details</h4>
                            <table class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderItemsRes as $orderItemRow) :?>

                                    <tr>
                                        <td>
                                            <img src="<?= $orderItemRow['productImage'] != '' ? '../'.$orderItemRow['productImage'] : '../assets/images/no-img.jpg'; ?>"
                                            style="width:50px;height:50px;" alt="Img" >
                                            <?= $orderItemRow['productName'];  ?>

                                        </td>
                                        <td  width="15%" class="fw-bold text-center">
                                            <?= number_format($orderItemRow['orderItemPrice']);?>
                                        </td>
                                        <td  width="15%" class="fw-bold text-center">
                                            <?= number_format($orderItemRow['orderItemQuantity']);?>
                                        </td>
                                        <td  width="15%" class="fw-bold text-center">
                                            <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity']) ;?>
                                        </td>
                                    </tr>
                                    <?php endforeach ;?>

                                    <tr>
                                        <td class="text-end fw-bold">
                                            Total Price:
                                        </td>
                                        <td  colspan="3" class="text-end fw-bold">
                                            Rs :  <?= number_format($orderItemRow['total_amount'], 0);?>

                                        </td>
                                    </tr>


                            </tbody>
                            </table>


                                <?php


                        }else{
                            echo "<h5> no record found</h5>";
                            return false;
                        }

                    }else{
                        echo "<h5> something wrong</h5>";
                    return false;

                    }

                    ?>


                    <?php
                }

                else{
                    echo "<h5> there is no record found</h5>";
                    return false;

                }
            }else{

                echo "<h5> something wrong</h5>";
                    return false;
            }
        }else{
           
        ?>


           

            <div class="d-flex flex-column justify-content-center align-items-center py-5">
             <h5>No tracking number found</h5>
            <a href="orders.php" class="btn btn-primary mt-4 w-25 text-center">Go back to orders</a>
            </div>




            <?php

           }
           ?>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
