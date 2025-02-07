<?php include('includes/header.php');?>



<div class="container-fluid px-4">


                            <div class="row">
                                            <div class="col-md-12">
                                                <h1 class="mt-4">Dashboard</h1>
                                                <?php alertMessage();?>
                                            </div>
                                        </div>


                                        <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <a href="categories.php" class="text-decoration-none">
                                            <div class="card card-body bg-primary p-3">
                                                <p class="text-sm mb-0 text-capitalize text-white">Total Category</p>
                                                <h5 class="fw-bold mb-0 text-white">
                                                    <?= getCount('categories'); ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a href="customers.php" class="text-decoration-none">
                                            <div class="card card-body bg-warning p-3">
                                                <p class="text-sm mb-0 text-capitalize text-dark">Total Customer</p>
                                                <h5 class="fw-bold mb-0 text-dark">
                                                    <?= getCount('customers'); ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a href="products.php" class="text-decoration-none">
                                            <div class="card card-body bg-info p-3">
                                                <p class="text-sm mb-0 text-capitalize text-white">Total Products</p>
                                                <h5 class="fw-bold mb-0 text-white">
                                                    <?= getCount('products'); ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>

                                <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
                                        <!-- Only visible if the logged-in user's email contains 'owner@gmail.com' -->
                                    <div class="col-md-3 mb-3">
                                        <a href="admins.php" class="text-decoration-none">
                                        
                                            <div class="card card-body bg-success p-3">
                                                <p class="text-sm mb-0 text-capitalize text-white">Total Admins</p>
                                                <h5 class="fw-bold mb-0 text-white">
                                                    <?= getCount('admins'); ?>
                                                </h5>
                                            </div>
                                         </a>
                                    </div>
                                <?php endif; ?>

                                    <div class="col-md-12 mb-3">
                                        <hr>
                                        <h5>Orders</h5>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a href="orders.php?date=<?=  date('Y-m-d'); ?>&payment_status=" class="text-decoration-none">
                                            <div class="card card-body p-3">
                                                <p class="text-sm mb-0 text-capitalize">Today Orders</p>
                                                <h5 class="fw-bold mb-0">
                                                    <?php
                                                    $todayDate = date('Y-m-d');
                                                    $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate'");
                                                    if ($todayOrders) {
                                                        if (mysqli_num_rows($todayOrders) > 0) {
                                                            $totalCountOrders = mysqli_num_rows($todayOrders);
                                                            echo $totalCountOrders;
                                                        } else {
                                                            echo "0";
                                                        }
                                                    } else {
                                                        echo 'something went wrong!';
                                                    }
                                                    ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a href="orders.php" class="text-decoration-none">
                                            <div class="card card-body p-3">
                                                <p class="text-sm mb-0 text-capitalize">Total Orders</p>
                                                <h5 class="fw-bold mb-0">
                                                    <?= getCount('orders'); ?>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                            </div>

              

                        
   </div>


        <?php include('includes/footer.php');?>