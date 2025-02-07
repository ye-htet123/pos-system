<?php
require '../config/function.php';

if (isset($_GET['track'])) {
    $tracking_no = mysqli_real_escape_string($conn, $_GET['track']); // Secure the input

    // Check if the order with the given tracking number exists
    $query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the order exists, delete it
        $delete_query = "DELETE FROM orders WHERE tracking_no='$tracking_no'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            // Success message for deletion
            $_SESSION['status'] = "Order deleted successfully";
        } else {
            // Error message if deletion fails
            $_SESSION['status'] = "Failed to delete order";
        }
    } else {
        // Error message if order doesn't exist
        $_SESSION['status'] = "No order found with that tracking number";
    }

    // Preserve filter parameters and redirect back to orders.php
    $date = isset($_GET['date']) ? $_GET['date'] : '';
    $payment_status = isset($_GET['payment_status']) ? $_GET['payment_status'] : '';

    header("Location: orders.php?date=$date&payment_status=$payment_status");
    exit();
} else {
    $_SESSION['status'] = "Invalid request";
    header("Location: orders.php");
    exit();
}
?>
