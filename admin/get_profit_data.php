<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get monthly profit data
// $sql = "
//     SELECT 
//         DATE_FORMAT(order_date, '%b') AS month,
//         SUM(total_amount) AS total_profit
//     FROM orders
//     WHERE order_date BETWEEN '2024-09-01' AND '2024-10-30'
//     GROUP BY month
//     ORDER BY MONTH(order_date)
// ";

// $result = $conn->query($sql);

// $data = [
//     'labels' => [],
//     'profits' => []
// ];

// while ($row = $result->fetch_assoc()) {
//     $data['labels'][] = $row['month'];
//     $data['profits'][] = (float)$row['total_profit'];
// }

// echo json_encode($data);
// $conn->close();
?>