<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
        <?php if(isset($_SESSION['status'])): ?>
    <div class="alert alert-info">
        <?= $_SESSION['status']; ?>
    </div>
    <?php unset($_SESSION['status']); ?>
<?php endif; ?>


        <div class="row">
            <div class="col-md-4">
                    <h4 class="mb-0">Orders</h4>

            </div>

            <div class="col-md-8">
                <form action="#" method="GET">
                    <div class="row g-1">
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="date" 
                            value="<?= isset($_GET['date']) == true ?  $_GET['date'] : '' ;?>">
                        </div>
                        <div class="col-md-4">
                        <select name="payment_status" id="" class="form-select">
                            <option value="">Select payment status</option>
                            <option 
                            value="cash_payment"
                            <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'cash_payment' ? 'selected="selected"' : ''; ?>
                            >Cash Payment</option>
                            <option value="online_payment"
                            <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'online_payment' ? 'selected="selected"' : ''; ?>
                            >Online Payment</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                            <button  type="submit" class="btn btn-primary">Filter</button>
                            <a href="orders.php" class="btn btn-danger">Reset</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br><br>

            <?php

            if(isset($_GET['date']) || isset($_GET['payment_status'])){
                $orderDate= validate($_GET['date']);
                $paymentStatus=validate($_GET['payment_status']);
               
                

                if($orderDate != '' && $paymentStatus == ''){
                    $query= "SELECT o.*,c.* FROM orders o, customers c
                     WHERE c.id=o.customer_id AND o.order_date='$orderDate' ORDER BY O.id";

                }
                elseif($orderDate == '' && $paymentStatus != ''){
                    $query= "SELECT o.*,c.* FROM orders o, customers c 
                    WHERE c.id=o.customer_id AND o.payment_mode='$paymentStatus' ORDER BY O.id";

                }
                elseif($orderDate != '' && $paymentStatus != ''){
                    $query= "SELECT o.*,c.* FROM orders o, customers c 
                    WHERE c.id=o.customer_id AND o.order_date='$orderDate' AND o.payment_mode='$paymentStatus' ORDER BY O.id";

                }else{

                    $query= "SELECT o.*,c.* FROM orders o, customers c WHERE c.id=o.customer_id ORDER BY O.id";
    
                }

            }else{

                $query= "SELECT o.*,c.* FROM orders o, customers c WHERE c.id=o.customer_id ORDER BY O.id";

            }



            $orders= mysqli_query($conn, $query);
            if($orders){
                if(mysqli_num_rows($orders) > 0){

                    ?>
        <table class="table table-striped table-bordered align-items center justify-content-center">

                    <thead>
                        <tr>
                            <td><b>tracking_no</b></td>
                            <td><b>Customer_name</b></td>
                            <td><b>Customer_phone</b></td>
                            <td><b>Order_date</b></td>
                            <td><b>Order_status</b></td>
                            <td><b>Payment_mode</b></td>
                            <td><b>Action</b></td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $ordersItem) : ?>

                            <tr>
                                <td class="fw-bold"><?= $ordersItem['tracking_no']; ?></td>
                                <td ><?= $ordersItem['name']; ?> </td>
                                <td ><?= $ordersItem['phone']; ?></td>
                                <td ><?= date('d,M,Y', strtotime($ordersItem['order_date']) ); ?></td>
                                <td ><?= $ordersItem['order_status']; ?></td>
                                <td ><?= $ordersItem['payment_mode']; ?></td>
                                <td >
                                    <a href="order-viewed.php?track=<?= $ordersItem['tracking_no']; ?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                    <a href="order-viewed-print.php?track=<?= $ordersItem['tracking_no']; ?>" class="btn btn-info mb-0 px-2 btn-sm">Print</a>
                                    <a href="order-deleted.php?track=<?= $ordersItem['tracking_no']; ?>&date=<?= isset($_GET['date']) ? $_GET['date'] : ''; ?>&payment_status=<?= isset($_GET['payment_status']) ? $_GET['payment_status'] : ''; ?>" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Are you sure to delete this order?')">Delete</a>


                                </td>


                            </tr>
                            <?php 
                        endforeach; ?>

                    </tbody>

        </table>


<?php


                }else{
                    echo "<h5>NO record found</h5>";
                }
            }
            else{

                echo "<h5>something is wrong</h5>";


            }



?>
        </div>
        <div class="card-body">


        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>