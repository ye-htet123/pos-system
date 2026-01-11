<?php include('get_profit_data.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System - Sales Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --danger: #e63946;
            --warning: #ffaa00;
            --gray: #8d99ae;
            --purple: #7209b7;
            --teal: #4895ef;
        }

        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #e6e9ff 100%);
            min-height: 100vh;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navigation Bar */
        .navbar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main Container */
        .container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title h2 {
            font-size: 2rem;
            color: var(--dark);
        }

        .page-title i {
            color: var(--primary);
            font-size: 2rem;
        }

        .date-filter {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .date-filter select, .date-filter input {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
        }

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
        }

        .icon-revenue {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .icon-profit {
            background: linear-gradient(135deg, var(--success), #3a86ff);
            color: white;
        }

        .icon-items {
            background: linear-gradient(135deg, var(--warning), #ff6b6b);
            color: white;
        }

        .icon-avg {
            background: linear-gradient(135deg, var(--purple), #f15bb5);
            color: white;
        }

        .stat-title {
            font-size: 1rem;
            color: var(--gray);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4caf50;
            font-weight: 600;
        }

        .stat-change.down {
            color: var(--danger);
        }

        /* Charts Container */
        .charts-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 2rem;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
        }

        .chart-actions {
            display: flex;
            gap: 0.8rem;
        }

        .chart-btn {
            background: #f0f4ff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .chart-btn:hover, .chart-btn.active {
            background: var(--primary);
            color: white;
        }

        .chart-wrapper {
            height: 300px;
            position: relative;
        }

        /* Product Profit Table */
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem;
            background: #f8f9ff;
            color: var(--gray);
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #fafbff;
        }

        .profit-positive {
            color: #4caf50;
            font-weight: 600;
        }

        .profit-negative {
            color: var(--danger);
            font-weight: 600;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
            border-top: 1px solid #eee;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin: 1rem 0;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .chart-row {
                grid-template-columns: 1fr;
            }
            
            .chart-card {
                min-width: 100%;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-cash-register"></i>
            <h1>RetailPro POS</h1>
        </div>
        
        <div class="nav-links">
            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
            <a href="#"><i class="fas fa-shopping-cart"></i> Sales</a>
            <a href="#"><i class="fas fa-box-open"></i> Inventory</a>
            <a href="#" class="active"><i class="fas fa-chart-line"></i> Reports</a>
            <a href="#"><i class="fas fa-users"></i> Customers</a>
            <a href="#"><i class="fas fa-cog"></i> Settings</a>
        </div>
        
        <div class="nav-actions">
            <button class="btn btn-secondary"><i class="fas fa-bell"></i></button>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> New Sale</button>
        </div>
    </nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rangeSelect = document.querySelector('select[name="range"]');
        const indate = document.querySelector('input[name="indate"]');
        const terdate = document.querySelector('input[name="terdate"]');

        function toggleDateInputs() {
            if (rangeSelect.value === "custom") {
                indate.readOnly = false;
                terdate.readOnly = false;
            } else {
                indate.readOnly = true;
                terdate.readOnly = true;
            }
        }

        function blockInput(e) {
            if (rangeSelect.value !== "custom") {
                e.preventDefault();
                alert("Please select 'Custom Range' to enter dates.");
            }
        }

        // Apply toggle on load
        toggleDateInputs();

        // Listen for changes
        rangeSelect.addEventListener("change", toggleDateInputs);

        // Show alert if not allowed
        indate.addEventListener("click", blockInput);
        terdate.addEventListener("click", blockInput);
    });
</script>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <i class="fas fa-chart-line"></i>
                <h2>Sales Reports & Analytics</h2>
            </div>
            <form method="GET" action="#" class="date-filter">
                 <select name="range">
                <option <?= !isset($_GET['range']) || $_GET['range'] === '7days' ? 'selected' : '' ?> value="7days">Last 7 Days</option>
                <option <?= isset($_GET['range']) && $_GET['range'] === '30days' ? 'selected' : '' ?> value="30days">Last 30 Days</option>
                <option <?= isset($_GET['range']) && $_GET['range'] === '90days' ? 'selected' : '' ?> value="90days">Last 90 Days</option>
                <option <?= isset($_GET['range']) && $_GET['range'] === 'year' ? 'selected' : '' ?> value="year">This Year</option>
                <option <?= isset($_GET['range']) && $_GET['range'] === 'custom' ? 'selected' : '' ?> value="custom">Custom Range</option>
            </select>
                <input type="date" value="<?= $_GET['indate'] ?? '' ?>" name="indate" readonly>
<span>to</span>
<input type="date" value="<?= $_GET['terdate'] ?? '' ?>" name="terdate" readonly>

                <button type="submit" class="btn btn-primary">Apply</button>
                                <a href="page1.php" class="btn btn-danger"><i class="fas fa-sync"></i>Reset</a>
        </form>
        </div>
        
          <?php
               $range = $_GET['range'] ?? '';
$startDate = $_GET['indate'] ?? '';
$endDate = $_GET['terdate'] ?? '';

// Set a default condition
$filterCondition = "o.order_status != 'Cancelled' AND o.order_date >= CURDATE() - INTERVAL 30 DAY";

if ($range === '7days') {
    $filterCondition = "o.order_status != 'Cancelled' AND o.order_date >= CURDATE() - INTERVAL 7 DAY";
} elseif ($range === '30days') {
    $filterCondition = "o.order_status != 'Cancelled' AND o.order_date >= CURDATE() - INTERVAL 30 DAY";
} elseif ($range === '90days') {
    $filterCondition = "o.order_status != 'Cancelled' AND o.order_date >= CURDATE() - INTERVAL 90 DAY";
} elseif ($range === 'year') {
    $filterCondition = "o.order_status != 'Cancelled' AND YEAR(o.order_date) = YEAR(CURDATE())";
} elseif ($range === 'custom' && $startDate !== '' && $endDate !== '') {
    $filterCondition = "o.order_status != 'Cancelled' AND o.order_date BETWEEN '$startDate' AND '$endDate'";
}

$filterConditionLast = "o.order_status != 'Cancelled' AND o.order_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() - INTERVAL 31 DAY";


if ($range === '7days') {
    $filterConditionLast = "o.order_status != 'Cancelled' AND o.order_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() - INTERVAL 8 DAY";
} elseif ($range === '30days') {
    $filterConditionLast = "o.order_status != 'Cancelled' AND o.order_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() - INTERVAL 31 DAY";
} elseif ($range === '90days') {
    $filterConditionLast = "o.order_status != 'Cancelled' AND o.order_date BETWEEN CURDATE() - INTERVAL 90 DAY AND CURDATE() - INTERVAL 91 DAY";
} elseif ($range === 'year') {
    $filterConditionLast = "o.order_status != 'Cancelled' AND YEAR(o.order_date) = YEAR(CURDATE() -1)";
} elseif ($range === 'custom' && $startDate !== '' && $endDate !== '') {
    $filterConditionLast = "o.order_status != 'Cancelled' AND o.order_date BETWEEN DATE_SUB('$startDate', INTERVAL 30 DAY) AND DATE_SUB('$startDate', INTERVAL 1 DAY)";
}
    
        ?>
       
        <!-- Stats Summary -->
<!-- Stats Summary -->

      
         <?php
          $sqlCut = "
    SELECT 
        DATE_FORMAT(o.order_date, '%Y-%m') AS order_month,
        SUM(oi.price * oi.quantity) AS total_revenue,
        SUM((oi.price - p.cost) * oi.quantity) AS total_profit
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN products p ON oi.product_id = p.id
    WHERE $filterCondition
    
";
            $resultCurrent = $conn->query($sqlCut);
            $rowCurrent = $resultCurrent->fetch_assoc();

            $currentTotal_revenue = (int)$rowCurrent['total_revenue'];
            $currentTotal_profit = (float)$rowCurrent['total_profit'];

            // Query total quantity and profit for last month
            $sqlLst = "
    SELECT 
        DATE_FORMAT(o.order_date, '%Y-%m') AS order_month,
        SUM(oi.price * oi.quantity) AS total_revenue,
        SUM((oi.price - p.cost) * oi.quantity) AS total_profit
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN products p ON oi.product_id = p.id
    WHERE $filterConditionLast
    
";
            $resultLast = $conn->query($sqlLst);
            $rowLast = $resultLast->fetch_assoc();

            $lastTotal_revenue = (int)$rowLast['total_revenue'];
            $lastTotal_profit = (float)$rowLast['total_profit'];

            // Calculate percentage change
            function calculatePercentageChange($current, $previous) {
                if ($previous == 0) return $current > 0 ? 100 : 0;
                return round((($current - $previous) / $previous) * 100, 1);
            }

            $revenueChange = calculatePercentageChange($currentTotal_revenue, $lastTotal_revenue);
            $profitChangef = calculatePercentageChange($currentTotal_profit, $lastTotal_profit);
            ?>



       
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Revenue</div>
                    <div class="stat-icon icon-revenue">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                        <div class="stat-value"><?= number_format($currentTotal_revenue,2) ?></div>
            <div class="stat-change <?= $revenueChange >= 0 ? 'text-success' : 'text-danger' ?>">
                    <i class="fas <?= $revenueChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                <?= $revenueChange ?>% from last <?= $range ?>                  </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Profit</div>
                    <div class="stat-icon icon-profit">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                 <div class="stat-value">$<?= number_format($currentTotal_profit, 2) ?></div>
                <div class="stat-change <?= $profitChangef >= 0 ? 'text-success' : 'text-danger' ?>">
                    <i class="fas <?= $profitChangef >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                    <?=$profitChangef ?>% from last <?= $range ?>                      </div>
            </div>
           



                        <?php
           

            // Query total quantity and profit for current month
            $sqlCurrent = "
                SELECT 
                    SUM(oi.quantity) AS total_quantity,
                    SUM((oi.price - p.cost) * oi.quantity) AS total_profit
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                JOIN orders o ON oi.order_id = o.id
                WHERE  $filterCondition
               
            ";
            $resultCurrent = $conn->query($sqlCurrent);
            $rowCurrent = $resultCurrent->fetch_assoc();

            $currentQuantity = (int)$rowCurrent['total_quantity'];
            $currentProfit = (float)$rowCurrent['total_profit'];

            // Query total quantity and profit for last month
            $sqlLast = "
                SELECT 
                    SUM(oi.quantity) AS total_quantity,
                    SUM((oi.price - p.cost) * oi.quantity) AS total_profit
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                JOIN orders o ON oi.order_id = o.id
                WHERE  $filterConditionLast
            ";
            $resultLast = $conn->query($sqlLast);
            $rowLast = $resultLast->fetch_assoc();

            $lastQuantity = (int)$rowLast['total_quantity'];
            $lastProfit = (float)$rowLast['total_profit'];

            // Calculate percentage change
            // function calculatePercentageChange($current, $previous) {
            //     if ($previous == 0) return $current > 0 ? 100 : 0;
            //     return round((($current - $previous) / $previous) * 100, 1);
            // }

            $quantityChange = calculatePercentageChange($currentQuantity, $lastQuantity);
            $profitChange = calculatePercentageChange($currentProfit, $lastProfit);
            ?>



            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Items Sold</div>
                    <div class="stat-icon icon-items">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
                        <div class="stat-value"><?= number_format($currentQuantity) ?></div>
            <div class="stat-change <?= $quantityChange >= 0 ? 'text-success' : 'text-danger' ?>">
                <i class="fas <?= $quantityChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                <?= $quantityChange ?>% from last <?= $range ?>  
    </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Avg. Profit Margin</div>
                    <div class="stat-icon icon-avg">
                        <i class="fas fa-percentage"></i>
                    </div>
                </div>
                 <div class="stat-value">$<?= number_format($currentProfit, 2) ?></div>
                <div class="stat-change <?= $profitChange >= 0 ? 'text-success' : 'text-danger' ?>">
                    <i class="fas <?= $profitChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                    <?=$profitChange ?>% from last <?= $range ?>  
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-row">
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Total Profit Overview</div>
                        <div class="chart-actions">
                            <button class="chart-btn active">Monthly</button>
                            <button class="chart-btn">Quarterly</button>
                            <button class="chart-btn">Yearly</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="profitTrendChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Profit by Category</div>
                        <div class="chart-actions">
                            <button class="chart-btn active">Profit</button>
                            <button class="chart-btn">Revenue</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="categoryProfitChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="chart-row">
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Top Performing Products (Profit)</div>
                        <div class="chart-actions">
                            <button class="chart-btn active">Top 10</button>
                            <button class="chart-btn">All</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="productProfitChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Profit Margin Distribution</div>
                        <div class="chart-actions">
                            <button class="chart-btn active">By Product</button>
                            <button class="chart-btn">By Category</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="marginDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Profit Table -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">Product Profit Details</div>
                <div>
                    <button class="btn btn-primary"><i class="fas fa-download"></i> Export Report</button>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                        <th>Cost</th>
                        <th>Profit</th>
                        <th>Margin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Premium Laptop Pro</td>
                        <td>Electronics</td>
                        <td>28</td>
                        <td>$36,372</td>
                        <td>$25,460</td>
                        <td class="profit-positive">$10,912</td>
                        <td class="profit-positive">30.0%</td>
                    </tr>
                    <tr>
                        <td>Smartphone X</td>
                        <td>Electronics</td>
                        <td>42</td>
                        <td>$37,758</td>
                        <td>$27,300</td>
                        <td class="profit-positive">$10,458</td>
                        <td class="profit-positive">27.7%</td>
                    </tr>
                    <tr>
                        <td>Designer T-Shirt</td>
                        <td>Clothing</td>
                        <td>87</td>
                        <td>$4,001</td>
                        <td>$1,740</td>
                        <td class="profit-positive">$2,261</td>
                        <td class="profit-positive">56.5%</td>
                    </tr>
                    <tr>
                        <td>Wireless Headphones</td>
                        <td>Audio</td>
                        <td>32</td>
                        <td>$4,160</td>
                        <td>$2,560</td>
                        <td class="profit-positive">$1,600</td>
                        <td class="profit-positive">38.5%</td>
                    </tr>
                    <tr>
                        <td>Business Strategy Book</td>
                        <td>Books</td>
                        <td>56</td>
                        <td>$1,399</td>
                        <td>$560</td>
                        <td class="profit-positive">$839</td>
                        <td class="profit-positive">60.0%</td>
                    </tr>
                    <tr>
                        <td>Premium Wine Collection</td>
                        <td>Beverages</td>
                        <td>18</td>
                        <td>$1,440</td>
                        <td>$720</td>
                        <td class="profit-positive">$720</td>
                        <td class="profit-positive">50.0%</td>
                    </tr>
                    <tr>
                        <td>Fitness Tracker</td>
                        <td>Wearables</td>
                        <td>24</td>
                        <td>$2,400</td>
                        <td>$1,440</td>
                        <td class="profit-positive">$960</td>
                        <td class="profit-positive">40.0%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>RetailPro POS System &copy; 2023 | Sales Reports Dashboard</p>
    </div>
             <!-- Query to get monthly profit data -->
       <?php $sql = "
            SELECT 
                DATE_FORMAT(order_date, '%b') AS month,
                SUM(total_amount) AS total_profit
            FROM orders
            WHERE order_date BETWEEN '2024-09-01' AND '2024-12-30'
            GROUP BY month
            ORDER BY MONTH(order_date)
        ";

        $result = $conn->query($sql);

        $data = [
            'labels' => [],
            'profits' => []
        ]; 
                    while ($row = $result->fetch_assoc()) {
            $data['labels'][] = $row['month'];
            $data['profits'][] = (float)$row['total_profit'];
        }

    

?>
    <script>
        

            document.addEventListener('DOMContentLoaded', function () {
        // Use PHP data directly - NO FETCH NEEDED
        const realData = <?= json_encode($data) ?>;
        renderProfitChart(realData.labels, realData.profits)

            function renderProfitChart(labels, profitData) {
                const profitTrendCtx = document.getElementById('profitTrendChart').getContext('2d');
                new Chart(profitTrendCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Profit',
                            data: profitData,
                            borderColor: '#4361ee',
                            backgroundColor: 'rgba(67, 97, 238, 0.1)',
                            borderWidth: 3,
                            pointBackgroundColor: '#fff',
                            pointBorderWidth: 3,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#2b2d42',
                                padding: 12,
                                titleFont: { size: 14 },
                                bodyFont: { size: 14 },
                                callbacks: {
                                    label: function(context) {
                                        return `Profit: $${context.parsed.y.toLocaleString()}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
    
       <?php 
// Query to get top 7 profitable products
$sqlProducts = "
    SELECT 
        p.name AS product_name,
        SUM(oi.price) AS product_profit
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    GROUP BY p.name
    ORDER BY product_profit DESC
    LIMIT 7
";

$resultProducts = $conn->query($sqlProducts);

$productData2 = [
    'labels' => [],
    'profits' => []
];

while ($row = $resultProducts->fetch_assoc()) {
    $productData2['labels'][] = $row['product_name'];
    $productData2['profits'][] = (float)$row['product_profit'];
}
?>
            // Product Profit Chart (Bar)
            const productProfitData = <?= json_encode($productData2) ?>;
renderProductProfitChart(productProfitData.labels, productProfitData.profits);

function renderProductProfitChart(labels, profitData) {
    const productProfitCtx = document.getElementById('productProfitChart').getContext('2d');
    
    // Define color arrays (same as original)
    const backgroundColors = [
        'rgba(67, 97, 238, 0.7)',
        'rgba(76, 201, 240, 0.7)',
        'rgba(114, 9, 183, 0.7)',
        'rgba(255, 170, 0, 0.7)',
        'rgba(230, 57, 70, 0.7)',
        'rgba(72, 149, 239, 0.7)',
        'rgba(67, 97, 238, 0.5)'
    ];
    
    const borderColors = [
        '#4361ee',
        '#4cc9f0',
        '#7209b7',
        '#ffaa00',
        '#e63946',
        '#4895ef',
        '#4361ee'
    ];

    new Chart(productProfitCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Profit',
                data: profitData,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#2b2d42',
                    padding: 12,
                    titleFont: { size: 14 },
                    bodyFont: { size: 14 },
                    callbacks: {
                        label: function(context) {
                            return `Profit: $${context.parsed.y.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                x: { 
                    grid: { display: false } 
                }
            }
        }
    });
}


<?php 
// Query to get top 7 profitable products
$sqlProducts2 = "
    SELECT 
        name AS cate_name,
        id AS product_profit
    FROM categories
    GROUP BY cate_name
    ORDER BY product_profit DESC
    LIMIT 7
";

$resultProducts2 = $conn->query($sqlProducts2);

$productData3 = [
    'labels' => [],
    'profits' => []
];

while ($row = $resultProducts2->fetch_assoc()) {
    $productData3['labels'][] = $row['cate_name'];
    $productData3['profits'][] = (float)$row['product_profit'];
}
?>
   

             const categoryData = <?= json_encode($productData3) ?>;
    renderCategoryProfitChart(categoryData.labels, categoryData.profits);

    function renderCategoryProfitChart(labels, profits) {
        const categoryProfitCtx = document.getElementById('categoryProfitChart').getContext('2d');
        new Chart(categoryProfitCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: profits,
                    backgroundColor: [
                        '#4361ee', '#4cc9f0', '#7209b7', '#ffaa00', '#e63946', '#4895ef',
                        '#f72585', '#06d6a0', '#ff6b6b', '#118ab2' // Extend if needed
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: {
                                size: 13
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2b2d42',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 14 },
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                return `${label}: $${value.toLocaleString()}`;
                            }
                        }
                    }
                }
            }
        });
    }
           
    <?php 
// Query to get top 7 profitable products
$sqlProducts3 = "
    SELECT 
        name AS pname,
        id AS percent
    FROM products
    GROUP BY pname
    ORDER BY percent DESC
    LIMIT 7
";

$resultProducts3 = $conn->query($sqlProducts3);

$productData4 = [
    'labels' => [],
    'profits' => []
];

while ($row = $resultProducts3->fetch_assoc()) {
    $productData4['labels'][] = $row['pname'];
    $productData4['profits'][] = (float)$row['percent'];
}
?>
            // Margin Distribution Chart (Radar)
            const marginData = <?= json_encode($productData4) ?>;
            console.log(marginData);

            const minValue = Math.floor(Math.min(...marginData.profits) / 10) * 10;
            const maxValue = Math.ceil(Math.max(...marginData.profits) / 10) * 10;

            console.log(minValue);
            console.log(maxValue);
            const marginDistributionCtx = document.getElementById('marginDistributionChart').getContext('2d');
            const marginDistributionChart = new Chart(marginDistributionCtx, {
                type: 'radar',
                data: {
                    labels: marginData.labels,
                    datasets: [{
                        label: 'Profit Margin',
                        data: marginData.profits,
                        backgroundColor: 'rgba(76, 201, 240, 0.2)',
                        borderColor: '#4cc9f0',
                        pointBackgroundColor: '#4cc9f0',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#4cc9f0',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                   
                    plugins: {
                        tooltip: {
                            backgroundColor: '#2b2d42',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 14
                            },
                            callbacks: {
                                label: function(context) {
                                    return `Margin: ${context.parsed.r}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        r: {
                            min: 0,
                            max: maxValue,
                            ticks: {
                                stepSize: 5,
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(17, 5, 5, 0.53)'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>