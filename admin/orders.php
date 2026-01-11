<?php include('includes/header.php'); ?>
<style>
/* Modern CSS Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

:root {
    --primary: #4361ee;
    --primary-dark: #3a56d4;
    --secondary: #6c757d;
    --success: #28a745;
    --info: #17a2b8;
    --warning: #ffc107;
    --danger: #dc3545;
    --light: #f8f9fa;
    --dark: #343a40;
    --border: #dee2e6;
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --table-hover: rgba(67, 97, 238, 0.05);
}

body {
    background-color: #f5f7fb;
    color: #333;
    line-height: 1.6;
}

/* Card Styling */
.card {
    border-radius: 2px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    border: none;
    margin-bottom: 2rem;
}

.card-header {
    background: linear-gradient(120deg, #4361ee, #3a56d4);
    color: white;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.card-header h4 {
    font-weight: 600;
    margin-bottom: 0;
}

/* Status Alert */
.alert {
    border-radius: 8px;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1.5rem;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

/* Filter Section */
.filter-section {
    background-color: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-top: 1.5rem;
}

.filter-section .row {
    align-items: center;
}

.filter-section label {
    font-weight: 500;
    color: var(--dark);
    margin-bottom: 0.5rem;
    display: block;
}

.filter-section .form-control,
.filter-section .form-select {
    border-radius: 6px;
    border: 1px solid var(--border);
    padding: 0.5rem 0.75rem;
    height: calc(2.25rem + 2px);
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
}

.filter-section .btn {
    border-radius: 6px;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.filter-section .btn-primary {
    background: var(--primary);
    border-color: var(--primary);
}

.filter-section .btn-primary:hover {
    background: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
}

.filter-section .btn-danger {
    background: #e63946;
    border-color: #e63946;
}

.filter-section .btn-danger:hover {
    background: #c1121f;
    border-color: #c1121f;
    transform: translateY(-2px);
}

/* Table Styling */
.table-container {
    overflow-x: auto;
    padding: 0 1.5rem 1.5rem;
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.table thead {
    background-color: #f1f4f9;
}

.table th {
    font-weight: 600;
    color: var(--primary);
    padding: 1rem;
    border-bottom: 2px solid var(--border);
    text-align: left;
}

.table td {
    padding: 0.75rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid var(--border);
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr:hover {
    background-color: var(--table-hover);
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-completed {
    background-color: #c3fabe;
    color: #155724;
}

.status-pending {
    background-color: #ffea83;
    color: #856404;
}

.status-cancelled {
    background-color: #f8c6c5;
    color: #721c24;
}

/* Action Buttons */
.action-buttons .btn {
    padding: 0.35rem 0.75rem;
    font-size: 0.85rem;
    margin-right: 0.5rem;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.action-buttons .btn:last-child {
    margin-right: 0;
}

.action-buttons .btn-info {
    background-color: var(--info);
    border-color: var(--info);
}

.action-buttons .btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
    transform: translateY(-2px);
}

.action-buttons .btn-danger {
    background-color: var(--danger);
    border-color: var(--danger);
}

.action-buttons .btn-danger:hover {
    background-color: #bd2130;
    border-color: #b21f2d;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .status-badge {
    
    font-size: 0.5rem;
    }
    .filter-section .col-md-4 {
        margin-bottom: 1rem;
    }
    
    .filter-section .col-md-4:last-child {
        margin-bottom: 0;
    }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .action-buttons .btn {
        flex: 1;
        min-width: 80px;
        margin-right: 0;
    }
    
    .card-header .row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .card-header .col-md-4,
    .card-header .col-md-8 {
        width: 100%;
        max-width: 100%;
    }
    .table th, .table td {
        padding: 0.2rem;
        font-size: 0.5rem;
    }
    .action-buttons {
   /* display: flex;          /* arrange horizontally */
                 /* space between buttons */
    align-items: center;
    display: inline-block;
}

.action-buttons .btn {
    padding: 0;
    font-size: 0.8rem;
}

.action-buttons .btn-text {
    display: none; /* hide the text, show only icon */
}


   
   
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 2rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #ced4da;
}

/* Header spacing */
.container-fluid.px-4 {
    padding-top: 0rem;
    padding-bottom: 2rem;
}
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h4 class="mb-0">Order Management</h4>
                    <p class="mb-0 text-light opacity-75">Track and manage customer orders</p>
                </div>
                <div class="col-md-8">
                    <form action="#" method="GET">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label>Order Date</label>
                                <input type="date" class="form-control" name="date" 
                                value="<?= isset($_GET['date']) == true ?  $_GET['date'] : '' ;?>">
                            </div>
                            <div class="col-md-4">
                                <label>Payment Status</label>
                                <select name="payment_status" class="form-select">
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
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2"> <i class="fas fa-filter"></i>Apply Filters</button>
                                <a href="orders.php" class="btn btn-danger"><i class="fas fa-sync"></i>Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <?php alertMessage(); ?>

            <div class="filter-section">
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tracking No</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                        <th>Payment Mode</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $ordersItem) : ?>
                                        <tr>
                                            <td class="fw-bold"><B>ODR- </B><?= $ordersItem['tracking_no']; ?></td>
                                            <td><?= $ordersItem['name']; ?> </td>
                                            <td><?= $ordersItem['phone']; ?></td>
                                            <td><?= date('d M, Y', strtotime($ordersItem['order_date']) ); ?></td>
                                            <td>
                                                <?php 
                                                $statusClass = '';
                                                if ($ordersItem['order_status'] == 'completed') {
                                                    $statusClass = 'status-completed';
                                                } elseif ($ordersItem['order_status'] == 'pending') {
                                                    $statusClass = 'status-pending';
                                                } else {
                                                    $statusClass = 'status-cancelled';
                                                }
                                                ?>
                                                <span class="status-badge <?= $statusClass; ?>">
                                                    <?= ucfirst($ordersItem['order_status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php 
                                                $paymentMode = $ordersItem['payment_mode'];
                                                if ($paymentMode == 'cash_payment') {
                                                    echo '<span class="badge bg-primary p-2"><i class="fas fa-money-bill-wave me-1"></i> Cash</span>';
                                                } else {
                                                    echo '<span class="badge bg-success p-2"><i class="fas fa-credit-card me-1"></i> Online</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="action-buttons">
                                                <a href="order-viewed.php?track=<?= $ordersItem['tracking_no']; ?>" class="btn  btn-sm">
                                                    <i class="fas fa-eye"></i> <span class="btn-text">View</span>  
                                                </a>
                                                <a href="order-viewed-print.php?track=<?= $ordersItem['tracking_no']; ?>" class="btn  btn-sm">
                                                    <i class="fas fa-print"></i> <span class="btn-text">Print</span>
                                                </a>
                                                <a href="order-deleted.php?track=<?= $ordersItem['tracking_no']; ?>&date=<?= isset($_GET['date']) ? $_GET['date'] : ''; ?>&payment_status=<?= isset($_GET['payment_status']) ? $_GET['payment_status'] : ''; ?>" 
                                                class="btn  btn-sm" 
                                                onclick="return confirm('Are you sure to delete this order?')">
                                                <i class="fas fa-trash"></i> <span class="btn-text">Delete</span>
                                                </a>
                                            </td>
                                            

                                        </tr>
                                        <?php 
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    } else {
                        echo '<div class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <h4>No Orders Found</h4>
                                <p>Try adjusting your filters or check back later</p>
                              </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Something went wrong with the database query</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>