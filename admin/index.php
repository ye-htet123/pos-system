<?php include('includes/header.php'); 
?>
<h1>Welcome <?php echo  $_SESSION['loggedInUser']['name']; ?> 🎉</h1>

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --dark: #2b2d42;
        --light: #f8f9fa;
        --danger: #e63946;
        --warning: #ffaa00;
        --gray: #8d99ae;
        --teal: #4895ef;
        --purple: #7209b7;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f0f4f8 0%, #e6e9ff 100%);
        min-height: 100vh;
        color: var(--dark);
        padding: 20px;
    }

    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0;
    }

    .dashboard-header h1 i {
        color: var(--primary);
        font-size: 2.2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-card:nth-child(1)::before { background: linear-gradient(90deg, var(--primary), var(--secondary)); }
    .stat-card:nth-child(2)::before { background: linear-gradient(90deg, var(--warning), #ff6b6b); }
    .stat-card:nth-child(3)::before { background: linear-gradient(90deg, var(--teal), #3a86ff); }
    .stat-card:nth-child(4)::before { background: linear-gradient(90deg, var(--success), #06d6a0); }
    .stat-card:nth-child(5)::before { background: linear-gradient(90deg, var(--purple), #f15bb5); }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.categories { background: linear-gradient(135deg, var(--primary), var(--secondary)); }
    .stat-icon.customers { background: linear-gradient(135deg, var(--warning), #ff6b6b); }
    .stat-icon.products { background: linear-gradient(135deg, var(--teal), #3a86ff); }
    .stat-icon.admins { background: linear-gradient(135deg, var(--success), #06d6a0); }
    .stat-icon.orders { background: linear-gradient(135deg, var(--purple), #f15bb5); }

    .stat-title {
        font-size: 1rem;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .stat-link {
        margin-top: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .stat-link:hover {
        gap: 0.8rem;
        text-decoration: underline;
    }

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 3rem 0 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    .section-title h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0;
    }

    .section-title h2 i {
        color: var(--primary);
    }

    .orders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .order-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    .order-id {
        font-weight: 700;
        color: var(--dark);
    }

    .order-date {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .order-details {
        flex: 1;
        margin-bottom: 1.5rem;
    }

    .order-detail {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
    }

    .detail-label {
        color: var(--gray);
    }

    .detail-value {
        font-weight: 600;
    }

    .order-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        text-align: center;
        background: #e0e7ff;
        color: var(--primary);
    }

    .order-status.completed {
        background: #dcfce7;
        color: #16a34a;
    }

    .order-status.pending {
        background: #fef9c3;
        color: #ca8a04;
    }

    .order-status.cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .section-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .orders-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid px-4">
    <div class="dashboard-header">
        <h1><i class="fas fa-chart-pie"></i> Dashboard</h1>
        <?php alertMessage(); ?>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Category</div>
                    <div class="stat-value"><?= getCount('categories'); ?></div>
                </div>
                <div class="stat-icon categories">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
            <a href="categories.php" class="stat-link">
                View Categories
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Customers</div>
                    <div class="stat-value"><?= getCount('customers'); ?></div>
                </div>
                <div class="stat-icon customers">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <a href="customers.php" class="stat-link">
                View Customers
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Products</div>
                    <div class="stat-value"><?= getCount('products'); ?></div>
                </div>
                <div class="stat-icon products">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
            <a href="products.php" class="stat-link">
                View Products
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Admins</div>
                    <div class="stat-value"><?= getCount('admins'); ?></div>
                </div>
                <div class="stat-icon admins">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
            <a href="admins.php" class="stat-link">
                View Admins
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div class="section-title">
        <h2><i class="fas fa-shopping-cart"></i> Orders Summary</h2>
        <a href="orders.php" class="btn btn-primary">
            <i class="fas fa-list me-1"></i> View All Orders
        </a>
    </div>

    <div class="orders-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Today's Orders</div>
                    <div class="stat-value">
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
                            echo '0';
                        }
                        ?>
                    </div>
                </div>
                <div class="stat-icon orders">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
            <a href="orders.php?date=<?= date('Y-m-d'); ?>&payment_status=" class="stat-link">
                View Today's Orders
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-title">Total Orders</div>
                    <div class="stat-value"><?= getCount('orders'); ?></div>
                </div>
                <div class="stat-icon orders">
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
            <a href="orders.php" class="stat-link">
                View All Orders
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>